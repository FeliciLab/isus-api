<?php

namespace App\Http\Controllers;

use App\Http\Exports\EspRelatorioExport;
use App\Model\Esp\EspOferta;
use App\Model\Esp\EspPresenca;
use App\Model\Esp\EspUserInfo;
use App\Model\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class EspRelatorioController extends Controller
{
    public function index()
    {
        try {

            $report = [];
            $ofertasArray = [];

            $buscaPorOfertaId = request('oferta');

            if ($buscaPorOfertaId) {
                $espOfertas = EspOferta
                    ::where('id', $buscaPorOfertaId)
                    ->get();
            } else {
                $espOfertas = EspOferta
                    ::where('is_active', true)
                    ->get();
            }

            /* Preenche o $ofertasArray */
            foreach ($espOfertas as $oferta) {
                $ofertasArray[] = $oferta->id;
            }

            $espPresencas = EspPresenca
                ::select(
                    'user_id',
                    'esp_oferta_id',
                    DB::raw('count(esp_oferta_id) as count_presenca')
                )
                ->whereIn('esp_oferta_id', $ofertasArray)
                ->groupBy('user_id', 'esp_oferta_id')
                ->get();

            foreach ($espPresencas as $presenca) {
                $espOferta = $espOfertas->where('id', '=', $presenca->esp_oferta_id)->first();

                $espUserInfo = EspUserInfo::where('user_id', '=', $presenca->user_id)->first();

                $user = User::where('id', '=', $presenca->user_id)->first();

                /*
                * Regra Presença carga horária:
                * Cada unidade de presença (cada presenca) contabiliza 8h.
                */
                $totalPresencasNecessarias = $espOferta->carga_horaria / 8;
                $chPresenca = $presenca->count_presenca * 8;
                $percentualPresenca =
                    ($presenca->count_presenca * 100) / $totalPresencasNecessarias;
                $percentualFalta = 100 - $percentualPresenca;

                $report[] = [
                    'ofertaNome' => $espOferta->nome,
                    'ofertaCargaHoraria' => $espOferta->carga_horaria,
                    'ofertaInicio' => $espOferta->inicio,
                    'ofertaFim' => $espOferta->fim,
                    'ofertaAtiva' => $espOferta->is_active
                        ? 'ATIVA'
                        : 'INATIVA',
                    'userNome' => $user->name,
                    'userCpf' => $user->cpf,
                    'areaEsp' => $espUserInfo->area_esp,
                    'areaOutros' => $espUserInfo->area_outros,
                    // 'countPresenca' => $presenca->count_presenca,
                    'chPresenca' => $chPresenca,
                    'percentualPresenca' => number_format($percentualPresenca, 2),
                    'percentualFalta' => number_format($percentualFalta, 2),
                ];
            }

            $export = new EspRelatorioExport($report);

            // return Excel::download($export, 'RelatorioPresencaEsp.xlsx');
            return response()->json($report, 200);
        } catch (Exception $e) {

            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
