<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    use HasFactory;

    private $filable = [
        'product_id',
        'attribute_id',
        'string_value',
        'integer_value'
    ];
}
