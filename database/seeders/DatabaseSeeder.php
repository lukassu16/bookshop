<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Attribute;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $bookAttribute = Attribute::create([
            'name' => 'genre',
            'label' => 'Genre',
            'column_type' => 'string'
        ]);

        $comicAttribute = Attribute::create([
            'name' => 'series',
            'label' => 'Series',
            'column_type' => 'string'
        ]);

        $shortStoryCollAttribute = Attribute::create([
            'name' => 'theme',
            'label' => 'Theme',
            'column_type' => 'string'
        ]);

        foreach ([
            'book' => $bookAttribute,
            'comic' => $comicAttribute,
            'short_story_collection' => $shortStoryCollAttribute
        ] as $type => $atr) {
            $products = Product::factory()
                ->count(3)
                ->create([
                    'type' => $type
                ]);

            foreach ($products as $product) {
                $product->attributes()->attach($atr);
            }
        }
    }
}
