<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    public function definition(): array
    {
        $categories = Category::all()->pluck('id')->toArray();

        return [
            'title' => $this->faker->unique()->sentence,
            'author' => $this->faker->name,
            'description' => $this->faker->paragraph,
            'year' => $this->faker->year,
            'quantity' => $this->faker->numberBetween(1, 999),
            'category_id' => $this->faker->randomElement($categories),
        ];
    }
}