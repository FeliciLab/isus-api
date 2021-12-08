<?php

declare(strict_types=1);

namespace App\Service;

use App\Model\MeusConteudos;

class MeusConteudosService
{
    /**
     * Consulta usuário pelo e-mail ou CPF, é para ter somente um usuário com um
     * e-mail ou um cpf. Então se algum deles bater, atualiza o dado.
     *
     * @param $email string
     * @param $cpf   string
     *
     * @return User|null
     */
    public function findConteudoByCategoriaId( string $categoriaId, string $especialidadeId)
    {
        if ($categoriaId == 1 || $categoriaId == 2) {
            return  MeusConteudos::where('especialidade_id', '=', $especialidadeId)
            ->select('id')
            ->first();
        }else {
            return MeusConteudos::where('categoriaprofissional_id', '=', $categoriaId)
            ->select('id')
            ->first();
        }
    }

}
