<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TesteClienteController extends Controller
{
    public function index()
    {
        $clientes = [
            [
                'info' => [
                    'nomeCompleto' => 'Ana Beatriz',
                    'detalhes' => [
                        'email' => 'ana.b@example.com',
                        'nascimento' => '1992-05-01',
                    ],
                ],
                'duplicado' => [
                    'nomeCompleto' => 'Ana Beatriz',
                ],
                'estatisticas' => [
                    'vendas' => [
                        ['data' => '2024-01-01', 'valor' => 150],
                        ['data' => '2024-01-02', 'valor' => 50],
                    ],
                ],
            ],
            [
                'info' => [
                    'nomeCompleto' => 'Carlos Eduardo',
                    'detalhes' => [
                        'email' => 'cadu@example.com',
                        'nascimento' => '1987-08-15',
                    ],
                ],
                'duplicado' => [
                    'nomeCompleto' => 'Carlos Eduardo',
                ],
                'estatisticas' => [
                    'vendas' => [],
                ],
            ],
        ];

        return response()->json([
            'data' => [
                'clientes' => $clientes,
            ],
            'meta' => [
                'registroTotal' => count($clientes),
                'pagina' => 1,
            ],
            'redundante' => [
                'status' => 'ok',
            ],
        ]);
    }
}
