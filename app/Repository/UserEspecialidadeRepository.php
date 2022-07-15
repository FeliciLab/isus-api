<?php

namespace App\Repository;

use App\Model\User;
use App\Model\UserEspecialidade;
use Illuminate\Support\Collection;

class UserEspecialidadeRepository
{
    /**
     * Verifica se dados do Array $user['especialidades'] é
     * igual ao especialidade_id da tabela users_especialidade.
     * Se for igual mantém, se for diferente ele remove as entradas extras.
     *
     * @param User $user
     * @param Collection $especialidades
     *
     * @return mixed
     */
    public function removerEspecialidadesSobressalentes(User $user, Collection $especialidades)
    {
        return UserEspecialidade::where('user_id', $user->id)
            ->whereNotIn(
                'especialidade_id',
                $especialidades->map(
                    function ($item) {
                        return $item->id;
                    }
                )
            )
            ->delete();
    }

    public function coletarEspecialidadesUsuario(User $user)
    {
        return UserEspecialidade::select('id', 'user_id', 'especialidade_id')
            ->where('user_id', $user->id)
            ->get();
    }
}
