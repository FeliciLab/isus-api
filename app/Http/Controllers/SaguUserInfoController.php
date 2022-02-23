<?php

namespace App\Http\Controllers;

use App\Model\Sagu\SaguUserInfo;
use Illuminate\Http\Request;

class SaguUserInfoController extends Controller
{
    public function index(int $idUser)
    {
        $saguUserInfos = SaguUserInfo::where('user_id', $idUser)->first();

        return response()->json(['data' => $saguUserInfos], 200);
    }
}
