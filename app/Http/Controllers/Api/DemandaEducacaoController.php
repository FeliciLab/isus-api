<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\DemandaEducacao\DemandaEducacao;
use Illuminate\Http\Request;

class DemandaEducacaoController extends Controller
{
    public function enviarEmail(Request $request)
    {
        $demandaEducacao = new DemandaEducacao($request);

        if (!$demandaEducacao->valido()) {
            return response()->json(['success' => false, 'errors' => $demandaEducacao->erros()]);
        }

        $demandaEducacao->enviarEmail();

        return response()->json(['success' => true]);
    }
}
