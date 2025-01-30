<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\TagTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 50; $i++) {

            $tag = Tag::factory()->create();

            $locales = ['ar', 'en'];

            foreach ($locales as $locale) {
                TagTranslation::factory()->create([
                    'tag_id' => $tag->id,
                    'locale' => $locale,
                ]);
            }
        }
    }
}
