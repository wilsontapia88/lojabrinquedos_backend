<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Cliente;

class ClienteTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_cliente()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $response = $this->postJson('/api/clientes', [
            'name' => 'João Silva',
            'email' => 'joao@example.com',
            'birthDate' => '1990-01-01'
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('clientes', ['email' => 'joao@example.com']);
    }

    public function test_listar_clientes()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        Cliente::factory()->count(3)->create();

        $response = $this->getJson('/api/clientes');
        $response->assertStatus(200)->assertJsonStructure(['data']);
    }

    public function test_update_cliente()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $cliente = Cliente::factory()->create([
            'email' => 'cliente@teste.com',
            'birthDate' => '2000-01-01',
        ]);

        $response = $this->putJson("/api/clientes/{$cliente->id}", [
            'name' => 'Nome Atualizado',
            'email' => 'cliente@teste.com',
            'birthDate' => '2000-01-01',
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('clientes', [
            'id' => $cliente->id,
            'name' => 'Nome Atualizado',
        ]);
    }

    public function test_delete_cliente()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $cliente = Cliente::factory()->create();

        $response = $this->deleteJson("/api/clientes/{$cliente->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('clientes', ['id' => $cliente->id]);
    }
}
