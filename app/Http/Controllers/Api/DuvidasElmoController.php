<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\DuvidasElmo\DuvidasElmo;
use Illuminate\Http\Request;

class DuvidasElmoController extends Controller
{
    public function enviarEmail(Request $request)
    {
        $duvidasElmo = new DuvidasElmo($request);

        if (!$duvidasElmo->valido()) {
            return response()->json(['success' => false, 'errors' => $duvidasElmo->erros()]);
        }

        $duvidasElmo->enviarEmail();

        return response()->json([
            'success' => true,
            'message' => 'Mensagem enviada com sucesso!',
            ]);
    }
}
