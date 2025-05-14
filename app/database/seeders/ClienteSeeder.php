<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cliente;
use Faker\Factory as Faker;

class ClienteSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 20) as $i) {
            Cliente::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'birthDate' => $faker->date('Y-m-d', '2005-01-01'),
            ]);
        }
    }
}
