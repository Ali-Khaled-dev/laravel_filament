<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ArticleTranslationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4),
            'short_descreption' => $this->faker->word(),
            'descreption' => $this->faker->word(),
            'slug' => str_replace(' ', '-', $this->faker->words(3, true)),
            'meta_keywords' => $this->faker->word(),
        ];
    }
}
