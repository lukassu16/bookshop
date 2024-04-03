<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Parental\HasParent;
use Illuminate\Database\Eloquent\Model;

class ShortStoryCollection extends Product
{
    use HasFactory, HasParent;
}
