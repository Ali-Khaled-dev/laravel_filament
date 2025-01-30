<?php

namespace Database\Seeders;

use App\Models\Artical;
use App\Models\Article;
use App\Models\ArticleTranslation;
use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 50; $i++) {

            $article = Article::factory()->create();

            $locales = ['ar', 'en'];

            foreach ($locales as $locale) {
                ArticleTranslation::factory()->create([
                    'article_id' => $article->id,
                    'locale' => $locale,
                ]);
            }
        }
    }
}
