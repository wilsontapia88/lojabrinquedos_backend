<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use App\Models\Cliente;
use App\Models\Venda;
use Tests\TestCase;

class VendaTest extends TestCase
{
    use RefreshDatabase;

    public function test_registrar_venda_para_cliente()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $cliente = Cliente::factory()->create();

        $response = $this->postJson("/api/clientes/{$cliente->id}/vendas", [
            'cliente_id' => $cliente->id,
            'date' => '2024-01-01',
            'amount' => 100.00
        ]);
        $response->assertStatus(201);
        $this->assertDatabaseHas('vendas', [
            'cliente_id' => $cliente->id,
            'amount' => 100.00
        ]);
    }
}
