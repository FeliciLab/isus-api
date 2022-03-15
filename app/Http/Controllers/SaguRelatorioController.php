<?php

namespace App\Http\Controllers;

use App\Http\Exports\SaguRelatorioExport;
use App\Model\Sagu\SaguOferta;
use App\Model\Sagu\SaguPresenca;
use App\Model\Sagu\SaguUserInfo;
use App\Model\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class SaguRelatorioController extends Controller
{
    public function index()
    {
        $report = [];
        $ofertasArray = [];

        $buscaPorOfertaId = request('oferta');

        if ($buscaPorOfertaId) {
            $saguOfertas = SaguOferta
                ::where('id', $buscaPorOfertaId)
                ->get();
        } else {
            $saguOfertas = SaguOferta
                ::where('is_active', true)
                ->get();
        }

        /* Preenche o $ofertasArray */
        foreach ($saguOfertas as $oferta) {
            $ofertasArray[] = $oferta->id;
        }

        $saguPresencas = SaguPresenca
            ::select(
                'user_id',
                'oferta_id',
                DB::raw('count(oferta_id) as count_presenca')
            )
            ->whereIn('oferta_id', $ofertasArray)
            ->groupBy('user_id', 'oferta_id')
            ->get();

        foreach ($saguPresencas as $presenca) {
            $saguOferta = $saguOfertas->where('id', '=', $presenca->oferta_id)->first();

            $saguUserInfo = SaguUserInfo::where('user_id', '=', $presenca->user_id)->first();

            $user = User::where('id', '=', $presenca->user_id)->first();

            /*
            * Regra Presença carga horária:
            * Cada unidade de presença (cada turno) contabiliza 6h.
            * Ex: Manha = 6 horas / Tarde = 6 horas
            */
            $totalPresencasNecessarias = $saguOferta->carga_horaria / 6;
            $chPresenca = $presenca->count_presenca * 6;
            $percentualPresenca =
                ($presenca->count_presenca * 100) / $totalPresencasNecessarias;
            $percentualFalta = 100 - $percentualPresenca;

            $report[] = [
                'ofertaNome' => $saguOferta->nome,
                'ofertaCargaHoraria' => $saguOferta->carga_horaria,
                'ofertaInicio' => $saguOferta->inicio,
                'ofertaFim' => $saguOferta->fim,
                'ofertaAtiva' => $saguOferta->is_active
                    ? 'ATIVA'
                    : 'INATIVA',
                'userNome' => $user->name,
                'userCpf' => $user->cpf,
                'componente' => $saguUserInfo->componente,
                'programaResidencia' => $saguUserInfo->programa_residencia,
                'municipioResidencia' => $saguUserInfo->municipio_residencia
                    ? $saguUserInfo->municipio_residencia
                    : '',
                'countPresenca' => $presenca->count_presenca,
                'chPresenca' => $chPresenca,
                'percentualPresenca' => number_format($percentualPresenca, 2),
                'percentualFalta' => number_format($percentualFalta, 2),
            ];
        }

        $export = new SaguRelatorioExport($report);

        return Excel::download($export, 'RelatorioPresenca.xlsx');
    }
}
