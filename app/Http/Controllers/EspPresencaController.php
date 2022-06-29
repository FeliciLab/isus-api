<?php

namespace App\Http\Controllers;

use App\Model\Esp\EspPresenca;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class EspPresencaController extends Controller
{
    /**
     * Lista as presencas de um usuário referentes a uma oferta
     * Ordenando por dada desc.
     *
     * @param int $idUser
     * @param int $idOferta
     */
    public function index(int $idUser, int $idOferta)
    {
        $presencas = EspPresenca::where('user_id', $idUser)
            ->where('esp_oferta_id', $idOferta)
            ->select('id', 'data')
            ->orderBy('data', 'desc')
            ->get();

        return response()->json([
            'user_id' => $idUser,
            'esp_oferta_id' => $idOferta,
            'presencas' => $presencas,
        ], 200);
    }

    /**
     * Marca a presença de um usuário para uma oferta
     * Caso a presença já exista para aquele usuário na data e turno, atualiza a presença.
     *
     * @param Request $resquest
     * @param int $idUser
     * @param int $idOferta
     */
    public function marcarPresenca(Request $resquest, int $idUser, int $idOferta)
    {
        try {
            // Validação dos campos
            $resquest->validate([
                'data' => 'required',
            ]);

            $requestBody = $resquest->all();

            // Sincroniza o TZ do Cliente com TZ do Laravel
            // Fomato: ISO-8601 em UTC (2022-06-29T18:22:36.000000Z)
            $data = Carbon::create($requestBody['data'])
                ->setTimezone('America/Fortaleza')
                ->toDateTime();

            $dataInicio = Carbon::create($requestBody['data'])
                ->setTimezone('America/Fortaleza')
                ->startOfDay();

            $dataFim = Carbon::create($requestBody['data'])
                ->setTimezone('America/Fortaleza')
                ->endOfDay();

            $novaPresenca = new EspPresenca();
            $novaPresenca->user_id = $idUser;
            $novaPresenca->esp_oferta_id = $idOferta;
            $novaPresenca->data = $data;

            $presencaExistente = EspPresenca::where('user_id', $idUser)
                ->where('esp_oferta_id', $idOferta)
                ->whereBetween('data', [$dataInicio, $dataFim])
                ->first();

            if (!$presencaExistente) {
                $novaPresenca->save();

                return response()->json(['data' => $novaPresenca], 200);
            } else {

                // Atualiza para o último horário salvo
                $presencaExistente->data = $data;
                $presencaExistente->save();

                return response()->json(['data' => $presencaExistente], 200);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
