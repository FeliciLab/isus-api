<?php

namespace App\Service;

use App\Model\BannerConfig;
use App\Repository\BannerConfigRepository;

/**
 * Classe que executa as regras de negócio do BannerConfig.
 */
class BannerConfigService
{
    protected BannerConfigRepository $repository;

    public function __construct()
    {
        $this->repository = new BannerConfigRepository();
    }

    public function buscarConfiguracoes()
    {
        return $this->repository->tudoOrdenado();
    }

    public function salvar(array $dados, BannerConfig $modelo = null)
    {
        if (!$modelo) {
            return $this->repository->salvarNovo($dados);
        }

        return $this->repository->atualizar($modelo, $dados);
    }
}
