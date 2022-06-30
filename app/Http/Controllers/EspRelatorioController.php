<?php

namespace App\Http\Controllers;

use App\Http\Exports\EspRelatorioDetalhadoExport;
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
            /* Carga Horária a contabilizar por presença */
            $cHPorPresenca = 8;

            $buscaPorOfertaId = request('oferta');
            $relatorioDetalhado = request('detalhado');

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

            /*
            * Se tiver detalhado=sim na url:
            * /api/esp/relatorio?detalhado=sim
            * Será exibido um relatório com data/hora de cada presença.s
            */
            if ($relatorioDetalhado === 'sim') {
                $espPresencasContagemGeral = EspPresenca
                    ::select(
                        'user_id',
                        'esp_oferta_id',
                        DB::raw('count(esp_oferta_id) as count_presenca')
                    )
                    ->whereIn('esp_oferta_id', $ofertasArray)
                    ->groupBy('user_id', 'esp_oferta_id')
                    ->get();

                $espPresencas = EspPresenca
                    ::select(
                        'id',
                        'user_id',
                        'esp_oferta_id',
                        'data'
                    )
                    ->whereIn('esp_oferta_id', $ofertasArray)
                    ->get();

                foreach ($espPresencas as $presenca) {
                    $espPresencasContagemIndividual = $espPresencasContagemGeral
                        ->where('esp_oferta_id', '=', $presenca->esp_oferta_id)
                        ->where('user_id', '=', $presenca->user_id)
                        ->first()
                        ->count_presenca;

                    $espOferta = $espOfertas
                        ->where('id', '=', $presenca->esp_oferta_id)->first();

                    $espUserInfo = EspUserInfo::where('user_id', '=', $presenca->user_id)->first();

                    $user = User::where('id', '=', $presenca->user_id)->first();

                    /* Cálculo da Carga Horária */
                    $totalPresencasNecessarias = $espOferta->carga_horaria / $cHPorPresenca;
                    $chPresenca = $espPresencasContagemIndividual * $cHPorPresenca;
                    $percentualPresenca =
                        ($espPresencasContagemIndividual * 100) / $totalPresencasNecessarias;
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
                        'dataPresenca' => $presenca->data->format('d-m-Y H:i:s'),
                        'chPresenca' => $chPresenca,
                        'percentualPresenca' => number_format($percentualPresenca, 2),
                        'percentualFalta' => number_format($percentualFalta, 2),
                    ];
                }

                $export = new EspRelatorioDetalhadoExport($report);
            } else {
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

                    /* Cálculo da Carga Horária */
                    $totalPresencasNecessarias = $espOferta->carga_horaria / $cHPorPresenca;
                    $chPresenca = $presenca->count_presenca * $cHPorPresenca;
                    $percentualPresenca =
                        ($presenca->count_presenca * 100) / $totalPresencasNecessarias;
                    $percentualFalta = 100 - $percentualPresenca;

                    $report[] = [
                        'COUNT_PRESENCA' => $presenca->count_presenca,
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
                        'chPresenca' => $chPresenca,
                        'percentualPresenca' => number_format($percentualPresenca, 2),
                        'percentualFalta' => number_format($percentualFalta, 2),
                    ];
                }

                $export = new EspRelatorioExport($report);
            }

            // return response()->json($report, 200);
            return Excel::download($export, 'RelatorioPresencaEsp.xlsx');
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
