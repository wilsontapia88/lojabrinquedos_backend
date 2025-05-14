<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cliente;
use App\Models\Venda;
use Faker\Factory as Faker;

class VendaSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $clientes = Cliente::all();

        foreach ($clientes as $cliente) {
            foreach (range(1, rand(1, 10)) as $i) {
                Venda::create([
                    'cliente_id' => $cliente->id,
                    'date' => $faker->dateTimeBetween('-30 days', 'now'),
                    'amount' => $faker->randomFloat(2, 20, 500),
                ]);
            }
        }
    }
}
