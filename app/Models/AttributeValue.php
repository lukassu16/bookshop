<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'attribute_id',
        'string_value',
        'integer_value'
    ];

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}
