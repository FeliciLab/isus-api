<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Service\WordpressSyncronizeService;
use App\Service\WppSyncService;
class SynchronizeController extends Controller
{
    public function index(WppSyncService $wps) {
        $wps->sync();
    }
}
