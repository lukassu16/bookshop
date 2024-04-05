<?php

namespace App\Services;

use App\Models\Product;

class AttributesValuesService
{
    public function getAttributesDescription($values)
    {
        $attributes = [];

        foreach ($values as $value) {
            $attributes[$value->attribute->label] = $value->{$value->attribute->column_type};
        }

        return $attributes;
    }
}
