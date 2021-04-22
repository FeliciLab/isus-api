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

    public function tudoOrdenado()
    {
        return $this->model->orderBy('ordem')->get();
    }
}
