<?php

declare(strict_types=1);

namespace App\Service;

use App\Model\Especialidade;
use App\Model\User;
use App\Model\UserEspecialidade;
use App\Model\UserKeycloak;
use App\Model\UserTipoContratacao;
use App\Model\UserTitulacaoAcademica;
use App\Model\UserUnidadeServico;
use App\Repository\UserEspecialidadeRepository;
use App\Repository\UserUnidadesServicoRepository;
use Illuminate\Support\Arr;
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
     * Consulta usuário pelo e-mail, é para ter somente um usuário com um e-mail.
     *
     * @param $email string
     * @param $cpf   string
     *
     * @return User|null
     */
    public function verificarEmailExiste(string $email)
    {
        return User::where('email', '=', $email)->first();
    }

    /**
     * @param string $cpf
     *
     * @return User->id|null
     */
    public function verificarCpfExiste(string $cpf)
    {
        return User::where('cpf', '=', $cpf)
            ->select('id')
            ->first();
    }

    /**
     * @param string $cpf
     * @param string $idKeycloak
     */
    public function verificarCpfExisteParaOutrem(string $cpf, string $idKeycloak)
    {
        return User::select('id')
            ->where('cpf', $cpf)
            ->where('id_keycloak', '!=', $idKeycloak)
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
    ): User {
        $user->name = $userKeycloak->getName();
        $user->cpf = $userKeycloak->getCpf();
        $user->email = $userKeycloak->getEmail();
        $user->telefone = $userKeycloak->getTelefone();
        $user->password = Hash::make($userKeycloak->getPassword());
        $user->id_keycloak = $idKeycloak;
        $user->municipio_id = $userKeycloak->getCidadeId();
        $user->categoriaprofissional_id = $userKeycloak->getCategoriaProfissionalId() ?? $user->categoriaprofissional_id;
        $user->save();

        return $user;
    }

    /**
     * Atualiza ou insere a especialidade de um usuário.
     *
     * @param $user         User
     * @param $userKeycloak UserKeycloak
     *
     * @return bool
     */
    public function upsertUserSpecialities(User $user, UserKeycloak $userKeycloak): bool
    {
        $userEspecialidadeRepository = new UserEspecialidadeRepository();
        $especialidades = $userKeycloak->getEspecialidades();
        if (null === $especialidades->first()) {

            // Possibilita apagar a especialidade previamente escolhida.
            UserEspecialidade::where('user_id', $user->id)->delete();

            return false;
        }

        // "removerEspecialidadesSobressalentes" verifica e remove
        // especialidades que não fazem parte do que foi informado
        // pelo $user
        $userEspecialidadeRepository
            ->removerEspecialidadesSobressalentes(
                $user,
                $especialidades
            );

        $especialidadesUsuario = $userEspecialidadeRepository->coletarEspecialidadesUsuario($user);

        foreach ($especialidades as $especialidade) {
            if ($especialidadesUsuario->where('especialidade_id', $especialidade->id)->first()) {
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
     * Atualiza ou insere o relacionamento com unidade de serviço.
     *
     * @param $user         User
     * @param $userKeycloak UserKeycloak
     *
     * @return bool
     */
    public function upsertUserUnityService(User $user, UserKeycloak $userKeycloak)
    {
        $userUnidadesServicoRepository = new UserUnidadesServicoRepository();
        $unidadesServicos = $userKeycloak->getUnidadesServicos();
        if (null === $unidadesServicos->first()) {

            // Possibilita apagar a unidade de serviço previamente escolhida.
            UserUnidadeServico::where('user_id', $user->id)->delete();

            return false;
        }

        $userUnidadesServicoRepository
            ->removerUnidadesServicosSobressalentes(
                $user,
                $unidadesServicos
            );

        $userUnidadeServico = $userUnidadesServicoRepository
            ->coletaUnidadesServicosUsuario($user);

        foreach ($unidadesServicos as $servico) {
            if ($userUnidadeServico->where('unidade_servico_id', $servico->id)->first()) {
                continue;
            }

            $unidadeServicoUsuario = new UserUnidadeServico();
            $unidadeServicoUsuario->user_id = $user->id;
            $unidadeServicoUsuario->unidade_servico_id = $servico->id;
            $unidadeServicoUsuario->save();
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
     * @param User $user
     *
     * @return User
     */
    public function upsertUserAndRelationships(
        User $user,
        UserKeycloak $userKeycloak,
        string $idKeycloak
    ) {
        if (!$user) {
            $user = new User();
        }

        $user = $this->upsertUser($user, $userKeycloak, $idKeycloak);
        if (!$user->id) {
            throw new \Exception('Usuário não criado na API');
        }

        $this->upsertUserSpecialities($user, $userKeycloak);
        $this->upsertUserUnityService($user, $userKeycloak);
        $this->upsertUserAcademicTitles($user, $userKeycloak);
        $this->upsertUserHiresTypes($user, $userKeycloak);

        return $user;
    }

    /**
     * Verifica se o usuário existe na base de dados através do sub.
     *
     * @param $userKeycloak array
     *
     * @return User|null
     */
    public function fetchUserRegisteredCorrectly(array $userKeycloak)
    {
        if (!isset($userKeycloak['sub'])) {
            return;
        }

        $user = User::where('id_keycloak', $userKeycloak['sub'])->first();

        if (!$user || !isset($user, $user->municipio_id, $user->telefone, $user->cpf)) {
            return;
        }

        return $user;
    }

    /**
     * Efetua um pre-registro do usuário na base do isus para posteriormente
     * ser atualizado pelo cadastro.
     *
     * @param $userKeycloak array
     *
     * @return User
     */
    public function preRegisterUser(array $userKeycloak)
    {
        $userIsus = User::where('id_keycloak', $userKeycloak['sub'])->first();

        if ($userIsus) {
            return $userIsus;
        }

        $user = (new KeycloakService())->getUserData($userKeycloak['sub']);

        $userData = [
            'email' => $userKeycloak['email'],
            'id_keycloak' => $userKeycloak['sub'],
            'cpf' => $userKeycloak['preferred_username'], // username no idSaude é o CPF
            'name' => $userKeycloak['given_name'] . ' ' . $userKeycloak['family_name'],
        ];

        if (Arr::get($user, 'attributes.CIDADE_ID.0', false)) {
            $userData['municipio_id'] = Arr::get($user, 'attributes.CIDADE_ID.0');
        }

        if (Arr::get($user, 'attributes.TELEFONE.0', false)) {
            $userData['telefone'] = Arr::get($user, 'attributes.TELEFONE.0');
        }

        if (Arr::get($user, 'attributes.TERMOS.0', false)) {
            $userData['termos'] = Arr::get($user, 'attributes.TERMOS.0') === 'true';
        }

        return User::create($userData);
    }
}
