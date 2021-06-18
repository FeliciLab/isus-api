<?php

namespace App\Service;

use App\Model\DefinicoesConteudos\DefinicoesConteudo;
use App\Repository\DefinicoesConteudosOpcoesRepository;
use Database\Seeders\DefinicoesConteudoSeeder;

class DefinicoesConteudosOpcoesService
{
    /**
     * @var DefinicoesConteudosOpcoesRepository
     */
    private $repository;

    public function __construct()
    {
        $this->repository = new DefinicoesConteudosOpcoesRepository();
    }

    public function deletarOpcoes(array $ids)
    {
        return $this->repository->deletarMuitos($ids);
    }
}
