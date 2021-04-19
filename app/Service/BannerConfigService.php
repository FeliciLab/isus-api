<?php

namespace App\Service;

use App\Repository\BannerConfigRepository;

/**
 * Classe que executa as regras de negócio do BannerConfig
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
}
