<?php

namespace App\Services;

use App\Models\Product;

class AttributesValuesService
{
    public function getAttributesDescription($values)
    {
        $attrsString = '';

        foreach ($values as $value) {
            $attrsString .= "{$value->attribute->label}: {$value->{$value->attribute->column_type}}, ";
        }

        return $attrsString;
    }
}
