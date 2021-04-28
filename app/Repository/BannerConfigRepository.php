<?php

namespace App\Repository;

use App\Model\BannerConfig;

class BannerConfigRepository
{
    public BannerConfig $model;

    public function __construct()
    {
        $this->model = new BannerConfig();
    }

    public function buscar(int $id)
    {
        return $this->model->find($id);
    }

    public function tudoOrdenado()
    {
        return $this->model->orderByRaw('ordem + 0')
            ->where('ativo', true)
            ->get();
    }

    public function salvarNovo(array $dados)
    {
        return BannerConfig::create($dados);
    }

    public function atualizar(BannerConfig $model, array $dados)
    {
        $model->fill($dados);

        return $model->save();
    }
}
