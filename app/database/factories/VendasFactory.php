<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use App\Models\Vendas;

class VendasFactory extends Factory
{
    public function definition()
    {
        return [
            'customer_id' => Customer::inRandomOrder()->value('id') ?? Customer::factory(),
            'amount' => $this->faker->numberBetween(100, 1000),
            'date' => Carbon::now()->subDays(rand(0, 30))->format('Y-m-d'),
        ];
    }
}
