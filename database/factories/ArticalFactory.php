<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Artical;
use App\Models\Author;
use App\Models\Tag;

class ArticalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Artical::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4),
            'short_descreption' => $this->faker->word(),
            'descreption' => $this->faker->word(),
            'meta_keyword' => $this->faker->word(),
            'tag_id' => Tag::factory(),
            'author_id' => Author::factory(),
        ];
    }
}
