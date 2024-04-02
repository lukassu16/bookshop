<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (['book', 'comic', 'short_story_collection'] as $type) {
            Product::factory()
                ->count(3)
                ->create([
                    'type' => $type
                ]);
        }
    }
}
