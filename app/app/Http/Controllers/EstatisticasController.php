<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use Illuminate\Support\Facades\DB;

class EstatisticasController extends Controller
{
    public function vendasPorDia()
    {
        try {
            $vendas = DB::table('vendas')
                ->select(DB::raw('DATE(date) as date'), DB::raw('SUM(amount) as total'))
                ->groupBy('date')
                ->orderBy('date')
                ->get();

            return response()->json($vendas);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ], 500);
        }
    }

    public function topClientes()
    {
        $clientes = Cliente::with('vendas')->get();

        $maiorVolume = null;
        $maiorMedia = null;
        $maiorFrequencia = null;

        foreach ($clientes as $cliente) {
            $soma = $cliente->vendas->sum('amount');
            $media = $cliente->vendas->count() ? $soma / $cliente->vendas->count() : 0;
            $diasUnicos = $cliente->vendas->pluck('data')->unique()->count();

            if (!$maiorVolume || $soma > $maiorVolume['amount']) {
                $maiorVolume = ['cliente' => $cliente, 'amount' => $soma];
            }

            if (!$maiorMedia || $media > $maiorMedia['media']) {
                $maiorMedia = ['cliente' => $cliente, 'media' => $media];
            }

            if (!$maiorFrequencia || $diasUnicos > $maiorFrequencia['dias']) {
                $maiorFrequencia = ['cliente' => $cliente, 'dias' => $diasUnicos];
            }
        }

        return response()->json([
            'maior_volume_vendas' => $maiorVolume,
            'maior_media_por_venda' => $maiorMedia,
            'maior_frequencia_compras' => $maiorFrequencia,
        ]);
    }
}
