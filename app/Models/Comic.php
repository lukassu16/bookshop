<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Parental\HasParent;
use Illuminate\Database\Eloquent\Model;

class Comic extends Product
{
    use HasFactory, HasParent;

    public static function getAvailableOptions(): array
    {
        return ['series'];
    }
}
