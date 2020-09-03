<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\AlertaDeEpi\AlertaDeEpi;
use Illuminate\Http\Request;

class AlertaDeEpiController extends Controller
{
    public function enviarEmail(Request $request)
    {
        $alertaDeEpi = new AlertaDeEpi($request);

        if (!$alertaDeEpi->valido()) {
            return response()->json(['success' => false, 'errors' => $alertaDeEpi->erros()]);
        }

        $alertaDeEpi->enviarEmail();

        return response()->json(['success' => true]);
    }
}
