<?php

namespace App\Http\Controllers;

use App\Model\Sagu\SaguOferta;
use Illuminate\Http\Request;

class SaguOfertasController extends Controller
{
    /**
     * Listar as Ofertas
     * 1. Apenas as que estão ativas
     * 2. Ordenar por data de criação decrescente
     */
    public function index()
    {
        $saguOfertas = SaguOferta::where('is_active', true)->orderBy('created_at', 'desc');

        return response()->json(['data' => $saguOfertas], 200);
    }
}
