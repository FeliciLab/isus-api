<?php

namespace App\Http\Controllers\Api;

use App\Model\MeusConteudos;

class MeusConteudosController extends Controller
{
    private $meusConteudos;

    public function __construct(MeusConteudos $meusConteudos)
    {
        $this->meusConteudos = $meusConteudos;
    }
}
