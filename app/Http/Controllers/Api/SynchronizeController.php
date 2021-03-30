<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Service\WordpressSyncronizeService;

class SynchronizeController extends Controller
{
    public function index(WordpressSyncronizeService $wps)
    {
        $wps->sync();
    }
}
