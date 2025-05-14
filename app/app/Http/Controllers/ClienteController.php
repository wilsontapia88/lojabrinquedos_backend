<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Cliente;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        $query = Cliente::query();

        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->has('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        return response()->json([
            'data' => $query->with('vendas')->get()
        ]);
    }

    public function store(Request $request)
    {
        $fields = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:clientes',
            'birthDate' => 'required|date',
        ]);

        if ($fields->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $fields->errors()
            ], 422);
        }

        $data = $fields->validated();

        $cliente = Cliente::create($data);

        return response()->json($cliente, 201);
    }

    public function show(Cliente $cliente)
    {
        return response()->json($cliente->load('vendas'));
    }

    public function update(Request $request, Cliente $cliente)
    {

        $fields = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:clientes,email,' . $cliente->id,
            'birthDate' => 'required|date',
        ]);

        if ($fields->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $fields->errors()
            ], 422);
        }

        $validated = $fields->validated();
        $cliente->update($validated);

        return response()->json($cliente);
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->delete();

        return response()->json(['message' => 'Cliente deletado'], 204);
    }
}
