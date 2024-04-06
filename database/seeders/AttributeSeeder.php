<?php

namespace Database\Seeders;

use App\Models\Attribute;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Attribute::factory()
            ->create([
                'label' => 'Genre',
                'name' => 'genre',
                'column_type' => 'string_value'
            ]);

        Attribute::factory()
            ->create([
                'label' => 'Theme',
                'name' => 'theme',
                'column_type' => 'string_value'
            ]);

        Attribute::factory()
            ->create([
                'label' => 'Series',
                'name' => 'series',
                'column_type' => 'string_value'
            ]);
    }
}
