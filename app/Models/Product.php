<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Parental\HasChildren;


class Product extends Model
{
    use HasFactory, HasChildren;

    protected $fillable = [
        'title',
        'price',
        'type',
        'author_id'
    ];

    protected $childTypes = [
        'book'  => Book::class,
        'comic' => Comic::class,
        'short_story_collection' => ShortStoryCollection::class,
    ];

    public static function getAvailableOptions(): array
    {
        return [];
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function attributesValues()
    {
        return $this->hasMany(AttributeValue::class);
    }
}
