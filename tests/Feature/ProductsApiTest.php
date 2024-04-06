<?php

namespace Tests\Feature;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Author;
use App\Models\Book;
use App\Models\Product;
use Database\Seeders\AttributeSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductsApiTest extends TestCase
{
    use RefreshDatabase;

    public $expectedAttrs = [];

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(AttributeSeeder::class);
    }

    /**
     * @test
     * @dataProvider typesProvider
     */
    public function index_method_return_all_products($type): void
    {
        $this->createProductWithAttrs($type);

        $response = $this->get('/api/v1/items');

        $expectedAttrs = array_merge(
            ['title', 'price', 'author_fullname'],
            $this->expectedAttrs
        );

        $response->assertStatus(200)
            ->assertJsonStructure(
                [
                    'data' => [
                        '*' => $expectedAttrs
                    ]
                ]
            );
    }

    /**
     * @test
     * @dataProvider typesProvider
     */
    public function description_of_product_is_returned_on_show_route($type)
    {
        $this->createProductWithAttrs($type);

        $product = Product::where('type', $type)->first();

        $response = $this->get("/api/v1/items/{$product->id}/description");

        $this->assertStringContainsString($product->price, $response->content());
        $this->assertStringContainsString($product->title, $response->content());
        $this->assertStringContainsString($product->author->getFullName(), $response->content());
        $this->assertStringContainsString($product->price, $response->content());
    }

    /** 
     * @test 
     */
    public function product_is_store_after_sending_request()
    {
        $author = Author::factory()->create();

        $price = 85;
        $title = 'some_title';

        $requestData = [
            'title' => $title,
            'price' => $price,
            'type' => 'book',
            'author_id' => $author->id,
            'attributes' => [
                'genre' => 'some_genre'
            ]
        ];

        $this->post("/api/v1/items/", $requestData);

        $product = Product::where('title', 'some_title')->first();
        $this->assertEquals($product->price, $price);
    }

    public function createProductWithAttrs($type)
    {
        $product = Product::factory()->count(1)->create([
            'type' => $type
        ]);

        $class = 'App\\Models\\' . ucfirst($type);
        $attrs = Attribute::whereIn('name', $class::getAvailableOptions())->get();
        foreach ($attrs as $attr) {
            AttributeValue::create([
                'product_id' => $product[0]->id,
                'attribute_id' => $attr->id,
                $attr->column_type => ($attr->column_type == 'integer_value')
                    ? rand(0, 100)
                    : 'test_value'
            ]);

            $this->expectedAttrs[] = $attr->label;
        }
    }

    static function typesProvider()
    {
        return [
            ['type' => 'book'],
            ['type' => 'comic'],
        ];
    }
}
