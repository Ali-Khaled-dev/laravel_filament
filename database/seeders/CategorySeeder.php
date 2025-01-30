<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CategoryTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 50; $i++) {

            $category = Category::factory()->create();

            $locales = ['ar', 'en'];

            foreach ($locales as $locale) {
                CategoryTranslation::factory()->create([
                    'category_id' => $category->id,
                    'locale' => $locale,
                ]);
            }
        }

    }
}
