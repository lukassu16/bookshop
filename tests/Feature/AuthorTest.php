<?php

namespace Tests\Feature;

use Database\Seeders\AuthorSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthorTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(AuthorSeeder::class);
    }

    /**
     * @test
     */
    public function index_method_returns_all_authors(): void
    {
        $response = $this->get('/api/v1/authors');

        $response->assertStatus(200)
            ->assertJsonStructure(
                [
                    'data' => [
                        '*' => [
                            'first_name',
                            'last_name',
                            'place_of_birth'
                        ]
                    ]
                ]
            );
    }
}
