<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Parental\HasParent;

class Book extends Product
{
    use HasFactory, HasParent;

    public static function getAvailableOptions(): array
    {
        return ['genre'];
    }
}
