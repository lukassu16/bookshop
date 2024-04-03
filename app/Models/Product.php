<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Parental\HasChildren;


class Product extends Model
{
    use HasFactory, HasChildren;

    protected $fillable = ['type'];

    protected $childTypes = [
        'book' => Book::class,
        'comic' => Comic::class,
        'short_story_collection' => ShortStoryCollection::class,
    ];
}
