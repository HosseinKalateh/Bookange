<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => Category::factory(),
            'publisher_id' => Publisher::factory(),
            'name'         => $this->faker->name,
            'picture'      => $this->faker->imageUrl(),
            'description'  => $this->faker->text,
            'price'        => $this->faker->randomFloat,
            'ISBN'         => $this->faker->randomNumber,
            'number_of_pages' => $this->faker->randomNumber(2),
            'published_at' => now(),
        ];
    }
}
