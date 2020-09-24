<?php

namespace Database\Factories\Entity\Categories;

use App\Entity\Categories\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $name = $this->faker->unique()->name,
            'slug' => Str::slug($name),
            'order' => $this->faker->numberBetween(1, 10)
        ];
    }
}
