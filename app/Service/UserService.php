<?php

declare(strict_types=1);

namespace App\Service;

use App\Model\User;
use App\Model\UserEspecialidade;
use App\Model\UserKeycloak;
use App\Model\UserTipoContratacao;
use App\Model\UserTitulacaoAcademica;
use App\Model\UserUnidadeServico;
use Illuminate\Support\Facades\Hash;

/**
 * Classe que contém as regras de negócio relacionada ao usuário salvo no banco
 * do iSUS. Este usuário é para ser considerado um cache.
 *
 * @category ISUS_User
 *
 * @author  Chicão Thiago <fthiagogv@gmail.com>
 * @license GPL3 http://www.gnu.org/licenses/gpl-3.0.en.html
 *
 * @link https://github.com/EscolaDeSaudePublica/isus-api
 */
class UserService
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
    public function fetchUserByEmailOrCpf(string $email, string $cpf)
    {
        return User::where('email', '=', $email)
            // ->where('cpf', '=', $cpf)
            ->select('id')
            ->first();
    }

    /**
     * Atualiza/cria um usuário.
     *
     * @param $user         User
     * @param $userKeycloak UserKeycloak
     * @param $idKeycloak   string
     *
     * @return bool
     */
    public function upsertUser(
        User $user,
        UserKeycloak $userKeycloak,
        string $idKeycloak
    ): bool {
        $user->name = $userKeycloak->getName();
        $user->cpf = $userKeycloak->getCpf();
        $user->email = $userKeycloak->getEmail();
        $user->telefone = $userKeycloak->getTelefone();
        $user->password = Hash::make($userKeycloak->getPassword());
        $user->id_keycloak = $idKeycloak;
        $user->municipio_id = $userKeycloak->getCidadeId();
        $user->categoriaprofissional_id = $userKeycloak
            ->getCategoriaProfissionalId();

        return $user->save();
    }

    /**
     * Verifica se uma dada especialidade já foi salva no banco para um usuário.
     *
     * @param $user          User
     * @param $especialidade Object
     *
     * @return bool
     */
    public function hasUserSpeciality(User $user, $especialidade): bool
    {
        return UserEspecialidade::where('user_id', $user->id)
            ->where('epecialidade_id', $especialidade->id)
            ->select('id')
            ->first() !== null;
    }

    /**
     * Atualiza ou insere a especialidade de um usuário.
     *
     * @param $user         User
     * @param $userKeycloak UserKeycloak
     *
     * @return bool
     */
    public function upsertUserSpecialities(User $user, UserKeycloak $userKeycloak)
    {
        $especialidades = $userKeycloak->getEspecialidades();
        if (null === $especialidades) {
            return false;
        }

        foreach ($especialidades as $especialidade) {
            if ($this->hasUserSpeciality($user->id, $especialidade->id)) {
                continue;
            }

            $userEspecialidade = new UserEspecialidade();
            $userEspecialidade->user_id = $user->id;
            $userEspecialidade->especialidade_id = $especialidade->id;
            $userEspecialidade->save();
        }

        return true;
    }

    /**
     * Verifica se na base de dados já existe o relacionamento.
     *
     * @param $user    User
     * @param $servico Object
     *
     * @return UserUnidadeServico|null
     */
    public function hasUserUnityService(User $user, $servico)
    {
        return UserUnidadeServico::where('user_id', $user->id)
                ->where('unidade_servico_id', $servico->id)
                ->select('id')
                ->first();
    }

    /**
     * Atualiza ou insere o relacionamento com unidade de serviço.
     *
     * @param $user         User
     * @param $userKeycloak UserKeycloak
     *
     * @return bool
     */
    public function upsertUserUnityService(User $user, UserKeycloak $userKeycloak)
    {
        $unidadesServicos = $userKeycloak->getUnidadesServicos();
        if (null === $unidadesServicos) {
            return false;
        }

        foreach ($unidadesServicos as $servico) {
            if ($this->hasUserUnityService($user, $servico)) {
                continue;
            }

            $userUnidadeServico = new UserUnidadeServico();
            $userUnidadeServico->user_id = $user->id;
            $userUnidadeServico->unidade_servico_id = $servico->id;
            $userUnidadeServico->save();
        }

        return true;
    }

    /**
     * Verifica se o relaciomaneto já existe.
     *
     * @param $user      User
     * @param $titulacao Object
     *
     * @return bool
     */
    public function hasAcademicTitles($user, $titulacao)
    {
        return UserTitulacaoAcademica::where('user_id', $user->id)
            ->where('titulacao_academica_id', $titulacao->id)
            ->select('id')
            ->first() !== null;
    }

    /**
     * Insere ou não titulações academicas.
     *
     * @param $user         User
     * @param $userKeycloak UserKeycloak
     *
     * @return bool
     */
    public function upsertUserAcademicTitles(User $user, UserKeycloak $userKeycloak)
    {
        $titulacoesAcademica = $userKeycloak->getTitulacoesAcademicas();
        if (null === $titulacoesAcademica) {
            return false;
        }

        foreach ($titulacoesAcademica as $titulacao) {
            if ($this->hasAcademicTitles($user, $titulacao)) {
                continue;
            }

            $userTitulacaoAcademica = new UserTitulacaoAcademica();
            $userTitulacaoAcademica->user_id = $user->id;
            $userTitulacaoAcademica->titulacao_academica_id = $titulacao->id;
            $userTitulacaoAcademica->save();
        }

        return true;
    }

    /**
     * Verifica se existe o relacionamento.
     *
     * @param $user            User
     * @param $tipoContratacao Object
     *
     * @return bool
     */
    public function hasHiresTypes(User $user, $tipoContratacao)
    {
        UserTipoContratacao::where('user_id', $user->id)
            ->where('tipo_contratacao_id', $tipoContratacao->id)
            ->select('id')
            ->first() !== null;
    }

    /**
     * Insere ou não tipos de contratações.
     *
     * @param $user         User
     * @param $userKeycloak UserKeycloak
     *
     * @return bool
     */
    public function upsertUserHiresTypes(User $user, UserKeycloak $userKeycloak)
    {
        $tiposContratacoes = $userKeycloak->getTiposContratacoes();
        if (null === $tiposContratacoes) {
            return false;
        }

        foreach ($tiposContratacoes as $tipoContratacao) {
            if ($this->hasHiresTypes($user, $tipoContratacao)) {
                continue;
            }

            $userTipoContratacao = new UserTipoContratacao();
            $userTipoContratacao->user_id = $user->id;
            $userTipoContratacao->tipo_contratacao_id = $tipoContratacao->id;
            $userTipoContratacao->save();
        }

        return true;
    }

    /**
     * Insere ou atualiza uma pessoa usuário e as tabelas de relacionamentso.
     *
     * @param $userKeycloak UserKeycloak
     * @param $idKeycloak   string
     *
     * @return User
     */
    public function upsertUserAndRelationships(
        UserKeycloak $userKeycloak,
        string $idKeycloak
    ) {
        $user = $this->fetchUserByEmailOrCpf(
            $userKeycloak->getEmail(),
            $userKeycloak->getPassword()
        );

        if (!$user) {
            $user = new User();
        }

        $this->upsertUser($user, $userKeycloak, $idKeycloak);
        if (!$user->id) {
            throw new \Exception('Usuário não criado na API');
        }

        $this->upsertUserSpecialities($user, $userKeycloak);
        $this->upsertUserUnityService($user, $userKeycloak);
        $this->upsertUserAcademicTitles($user, $userKeycloak);
        $this->upsertUserHiresTypes($user, $userKeycloak);

        return $user;
    }
}
