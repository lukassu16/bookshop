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

    protected $fillable = ['type'];

    protected $childTypes = [
        'book' => Book::class,
        'comic' => Comic::class,
        'short_story_collection' => ShortStoryCollection::class,
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function attributes(): BelongsToMany
    {
        return $this->belongsToMany(Attribute::class, 'attribute_product', 'attribute_id', 'product_id');
    }

    public function getDescription()
    {
        $paramsString = '';

        return "Price: $this->price, title: $this->title, author: {$this->author->getFullName()}, $paramsString";
    }
}
