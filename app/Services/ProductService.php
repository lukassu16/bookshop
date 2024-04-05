<?php

namespace App\Services;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Product;

class ProductService
{
    private $attributesValuesService;

    public function __construct(AttributesValuesService $attributesValuesService)
    {
        $this->attributesValuesService = $attributesValuesService;
    }

    public function getProductDescription(Product $product)
    {
        $attributes = $this->attributesValuesService->getAttributesDescription(
            $product->attributesValues
        );

        $attrsString = '';

        foreach ($attributes as $name => $value) {
            $attrsString .= "$name: $value, ";
        }

        return "Price: $product->price,"
            . " title: $product->title, $attrsString"
            . " author: {$product->author->getFullName()}";
    }

    public function createProduct($productData)
    {
        $product = Product::create([
            "title" => $productData["title"],
            "price" => $productData["price"],
            "type" => $productData["type"],
            "author_id" => $productData["author_id"]
        ]);

        foreach ($productData["attributes"] as $attr_name => $value) {
            $attr = Attribute::where('name', $attr_name)->first();

            AttributeValue::create([
                'product_id' => $product->id,
                'attribute_id' => $attr->id,
                $attr->column_type => $value
            ]);
        }
    }
}
