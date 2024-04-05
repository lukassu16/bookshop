<?php

namespace App\Services;

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
}
