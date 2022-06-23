<?php

namespace App\Http\Controllers;

use App\Model\Esp\EspUserInfo;
use Exception;
use Illuminate\Http\Request;

class EspUserInfoController extends Controller
{
    public function index(int $idUser)
    {
        $espUserInfo = EspUserInfo::where('user_id', $idUser)->first();

        return response()->json(['user_info' => $espUserInfo], 200);
    }

    public function updateUserInfo(Request $resquest, int $idUser)
    {
        try {
            $resquest->validate([
                'area_esp' => 'required',
            ]);

            $requestBody = $resquest->all();

            $espUserInfo = EspUserInfo::where('user_id', $idUser)
                ->first();

            if (!$espUserInfo) {
                $espUserInfo = new EspUserInfo();
            }

            $espUserInfo->user_id = $idUser;
            $espUserInfo->area_esp = $requestBody['area_esp'];
            $espUserInfo->area_outros = $requestBody['area_outros'];
            $espUserInfo->save();

            return response()->json($espUserInfo, 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
