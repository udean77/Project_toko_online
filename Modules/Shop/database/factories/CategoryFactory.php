<?php

namespace Modules\Shop\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Shop\Models\Category::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [];
    }
}

