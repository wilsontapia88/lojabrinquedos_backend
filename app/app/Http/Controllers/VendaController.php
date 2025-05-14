<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class VendaController extends Controller
{
    public function store(Request $request, Cliente $cliente)
    {
        try {
        $request->validate([
            'date' => 'required|date',
            'amount' => 'required|numeric'
        ]);

        $venda = $cliente->vendas()->create([
            'date' => $request->date,
            'amount' => $request->amount,
            'cliente_id' => $cliente->id
        ]);

        return response()->json($venda, 201);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ], 500);
        }

    }
}
