<?php

namespace App\Http\Controllers;

use App\Model\Sagu\SaguPresenca;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SaguPresencaController extends Controller
{
    /**
     * Lista as presencas de um usuário referentes a uma oferta
     * Ordenando por dada desc
     */
    public function index(int $idUser, int $idOferta)
    {
        $presencas = SaguPresenca::where('user_id', $idUser)
            ->where('oferta_id', $idOferta)
            ->select('id', 'data', 'turno')
            ->orderBy('data', 'desc')
            ->get();

        return response()->json([
            'user_id' => $idUser,
            'oferta_id' => $idOferta,
            'presencas' => $presencas
        ], 200);
    }

    /**
     * Marca a presença de um usuário para uma oferta
     * Caso a presença já exista para aquele usuário na data e turno, atualiza a presença
     */
    public function marcarPresenca(Request $resquest, int $idUser, int $idOferta)
    {
        try {
            // Validação dos campos
            $resquest->validate([
                'turno' => [
                    'required',
                    Rule::in(['manhã', 'tarde'])
                ],
                'data' => 'required'
            ]);

            $requestBody = $resquest->all();

            $data = Carbon::create($requestBody['data'])->toDateString(); // dd-mm-YYYY

            $presenca = new SaguPresenca();
            $presenca->user_id = $idUser;
            $presenca->oferta_id = $idOferta;
            $presenca->data = $data;
            $presenca->turno = $requestBody['turno'];

            $presencaExist = SaguPresenca::where('user_id', $idUser)
                ->where('oferta_id', $idOferta)
                ->where('turno', $requestBody['turno'])
                ->where('data', $data)
                ->first();

            if (!$presencaExist) {
                $presenca->save();
                return response()->json(['data' => $presenca], 200);
            } else {
                $presencaExist->save();
                return response()->json(['data' => $presencaExist], 200);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
