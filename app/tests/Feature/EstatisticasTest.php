<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use App\Models\Cliente;
use App\Models\Venda;
use Tests\TestCase;

class EstatisticasTest extends TestCase
{
    use RefreshDatabase;

    public function test_vendas_por_dia()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $cliente = Cliente::factory()->create();
        Venda::create(['cliente_id' => $cliente->id, 'date' => '2024-01-01', 'amount' => 100.00]);
        Venda::create(['cliente_id' => $cliente->id, 'date' => '2024-01-01', 'amount' => 200.00]);
        Venda::create(['cliente_id' => $cliente->id, 'date' => '2024-01-02', 'amount' => 150.00]);

        $response = $this->getJson('/api/estatisticas/vendas-por-dia');
        $response->assertStatus(200);
        $response->assertJsonFragment(['date' => '2024-01-01', 'total' => '300.00']);
    }

    public function test_top_clientes()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $cliente1 = Cliente::factory()->create(['name' => 'Cliente A']);
        $cliente2 = Cliente::factory()->create(['name' => 'Cliente B']);

        // Cliente A: 3 vendas (total 300, dias 2)
        Venda::create(['cliente_id' => $cliente1->id, 'date' => '2024-01-01', 'amount' => 100]);
        Venda::create(['cliente_id' => $cliente1->id, 'date' => '2024-01-01', 'amount' => 50]);
        Venda::create(['cliente_id' => $cliente1->id, 'date' => '2024-01-02', 'amount' => 150]);

        // Cliente B: 1 venda (valor 500)
        Venda::create(['cliente_id' => $cliente2->id, 'date' => '2024-01-01', 'amount' => 500]);

        $response = $this->getJson('/api/estatisticas/top-clientes');

        $response->assertStatus(200)->assertJsonStructure([
            'maior_volume_vendas',
            'maior_media_por_venda',
            'maior_frequencia_compras'
        ]);
    }
}
