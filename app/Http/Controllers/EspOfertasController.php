<?php

namespace App\Http\Controllers;

use App\Model\Esp\EspOferta;

class EspOfertasController extends Controller
{
    /**
     * Listar as Ofertas
     * 1. Apenas as que estão ativas
     * 2. Ordenar por data de criação decrescente.
     */
    public function index()
    {
        $espOfertas = EspOferta::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['ofertas' => $espOfertas], 200);
    }
}
