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
    public function findConteudoByCategoriaId(string $categoriaId, string $especialidadeId)
    {
        if ($categoriaId == 1 || $categoriaId == 3) {
            if($especialidadeId){
                return MeusConteudos::where('especialidade_id', '=', $especialidadeId)
                ->get();
            }
        }
        return MeusConteudos::where('categoriaprofissional_id', '=', $categoriaId)
        ->get();
    }

}
