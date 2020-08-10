<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\KeycloakService;
use App\Model\Estado;
use App\Model\User;
use Exception;
use GuzzleHttp\Client;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function save()
    {
        $keyCloakService = new KeycloakService();
        $keyCloakService->save();
    }
}
