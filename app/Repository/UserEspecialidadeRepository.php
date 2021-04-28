<?php

namespace App\Repository;

use App\Model\User;
use App\Model\UserEspecialidade;
use Illuminate\Support\Collection;

class UserEspecialidadeRepository
{
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
