<?php

namespace App\Repository;

use App\Model\User;
use App\Model\UserUnidadeServico;
use Illuminate\Support\Collection;

class UserUnidadesServicoRepository
{
    public function removerUnidadesServicosSobressalentes(User $user, Collection $unidadesServicoes)
    {
        return UserUnidadeServico::where('user_id', $user->id)
            ->whereNotIn(
                'unidade_servico_id',
                $unidadesServicoes->map(
                    function ($item) {
                        return $item->id;
                    }
                )
            )
            ->delete();
    }

    public function coletaUnidadesServicosUsuario(User $user)
    {
        return UserUnidadeServico::where('user_id', $user->id)
            ->select('id', 'user_id', 'unidade_servico_id')
            ->get();
    }
}
