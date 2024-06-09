<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customer_id' => \App\Models\Customer::factory(),
            'order_date' => $this->faker->date(),
            'status' => $this->faker->randomElement(['pending', 'processing', 'shipped']),
            'price' => $this->faker->numberBetween(1000, 10000),
        ];
    }
}
