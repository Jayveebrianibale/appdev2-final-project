<?php

namespace Database\Factories;

use App\Models\Chair;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChairFactory extends Factory
{
    protected $model = Chair::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'price' => $this->faker->numberBetween(100, 1000),
            'quantity_available' => $this->faker->numberBetween(1, 50),
        ];
    }
}