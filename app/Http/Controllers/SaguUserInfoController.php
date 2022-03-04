<?php

namespace App\Http\Controllers;

use App\Model\Sagu\SaguUserInfo;
use Exception;
use Illuminate\Http\Request;

class SaguUserInfoController extends Controller
{
    public function index(int $idUser)
    {
        $saguUserInfo = SaguUserInfo::where('user_id', $idUser)->first();

        return response()->json(['user_info' => $saguUserInfo], 200);
    }

    public function updateUserInfo(Request $resquest, int $idUser)
    {
        try {
            $resquest->validate([
                'componente' => 'required',
                'programaResidencia' => 'required',
            ]);

            $requestBody = $resquest->all();

            $saguUserInfo = SaguUserInfo::where('user_id', $idUser)
                ->first();

            if (!$saguUserInfo) {
                $saguUserInfo = new SaguUserInfo();
            }

            $saguUserInfo->user_id = $idUser;
            $saguUserInfo->componente = $requestBody['componente'];
            $saguUserInfo->programa_residencia = $requestBody['programaResidencia'];
            $saguUserInfo->municipio_residencia = $requestBody['residenciaMunicipio'];

            $saguUserInfo->save();

            return response()->json($saguUserInfo, 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
