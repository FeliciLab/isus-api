<?php

namespace App\Http\Services;

use App\Model\User;
use App\Model\UserKeycloak;
use App\Model\UserTipoContratacao;
use App\Model\UserTitulacaoAcademica;
use App\Model\UserUnidadeServico;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class KeycloakService
{
    private $keycloakClient;
    private $keycloakUri;
    private $keycloakAdminIsusRealm;
    private $keycloakAdminIsusUser;
    private $keycloakAdminIsusPassword;
    private $keycloakAdminIsusClientId;
    private $keycloakAdminIsusGranttype;

    public function __construct()
    {
        $this->keycloakClient = new Client();
        $this->keycloakUri = env('KEYCLOAK_URI');
        $this->keycloakAdminIsusRealm = env('KEYCLOAK_ADMIN_ISUS_REALM');
        $this->keycloakAdminIsusUser = env('KEYCLOAK_ADMIN_ISUS_USER');
        $this->keycloakAdminIsusPassword = env('KEYCLOAK_ADMIN_ISUS_PASSWORD');
        $this->keycloakAdminIsusClientId = env('KEYCLOAK_ADMIN_ISUS_CLIENTID');
        $this->keycloakAdminIsusGranttype = env('KEYCLOAK_ADMIN_ISUS_GRANTTYPE');
    }

    public function login($email, $senha)
    {
        $response = $this->keycloakClient->post("{$this->keycloakUri}/auth/realms/saude/protocol/openid-connect/token", [
            'form_params' => [
                'username' => $email,
                'password' => $senha,
                'client_id' => 'isus',
                'grant_type' => $this->keycloakAdminIsusGranttype,
            ],
        ]);

        return $response;
    }

    public function logout($refreshToken)
    {
        $response = $this->keycloakClient->post("{$this->keycloakUri}/auth/realms/saude/protocol/openid-connect/logout", [
            'form_params' => [
                'refresh_token' => $refreshToken,
                'client_id' => 'isus',
            ],
        ]);

        return $response;
    }

    public function userProfile($token)
    {
        return $this->keycloakClient->post("{$this->keycloakUri}/auth/realms/saude/protocol/openid-connect/userinfo", [
            'headers' => [
                'Authorization' => "{$token}",
            ],
        ]);
    }

    public function save(UserKeycloak $userKeycloak)
    {
        $resposta = $this->keycloakClient->post("{$this->keycloakUri}/auth/admin/realms/saude/users", [
            RequestOptions::JSON => $userKeycloak->toKeycloak(),
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => "Bearer {$this->getTokenAdmin()}",
            ],
        ]);

        if ($resposta->getStatusCode() == Response::HTTP_CREATED) {
            $location = $resposta->getHeader('Location');

            $locationArray = explode('/', $location[0]);
            $idKeycloak = $locationArray[count($locationArray) - 1];

            $user = new User();
            $user->name = $userKeycloak->getName();
            $user->cpf = $userKeycloak->getCpf();
            $user->email = $userKeycloak->getEmail();
            $user->telefone = $userKeycloak->getTelefone();
            $user->password = Hash::make($userKeycloak->getPassword());
            $user->id_keycloak = $idKeycloak;
            $user->municipio_id = $userKeycloak->getCidadeId();
            $user->categoriaprofissional_id = $userKeycloak->getCategoriaProfissionalId();
            $user->save();

            if (!$user->id) {
                throw new \Exception('Usuário não criado na API');
            }

            $unidadesServicos = $userKeycloak->getUnidadesServicos();
            if (null !== $unidadesServicos) {
                foreach ($unidadesServicos as $servico) {
                    $userUnidadeServico = new UserUnidadeServico();
                    $userUnidadeServico->user_id = $user->id;
                    $userUnidadeServico->unidade_servico_id = $servico->id;
                    $userUnidadeServico->save();
                }
            }

            $titulacoesAcademica = $userKeycloak->getTitulacoesAcademicas();
            if (null !== $titulacoesAcademica) {
                foreach ($titulacoesAcademica as $titulacao) {
                    $userTitulacaoAcademica = new UserTitulacaoAcademica();
                    $userTitulacaoAcademica->user_id = $user->id;
                    $userTitulacaoAcademica->titulacao_academica_id = $titulacao->id;
                    $userTitulacaoAcademica->save();
                }
            }

            $tiposContratacoes = $userKeycloak->getTiposContratacoes();
            if (null !== $tiposContratacoes) {
                foreach ($tiposContratacoes as $tipoContratacao) {
                    $userTipoContratacao = new UserTipoContratacao();
                    $userTipoContratacao->user_id = $user->id;
                    $userTipoContratacao->tipo_contratacao_id = $tipoContratacao->id;
                    $userTipoContratacao->save();
                }
            }

            return $user;
        } else {
            throw new \Exception('Usuário não criado error keycloak');
        }
    }

    public function update(UserKeycloak $userKeycloak, $idKeycloak)
    {
        $semSenha = true;
        $dadosKeycloak = $userKeycloak->toKeycloak($semSenha);

        $resposta = $this->keycloakClient->put("{$this->keycloakUri}/auth/admin/realms/saude/users/{$idKeycloak}", [
            RequestOptions::JSON => $dadosKeycloak,
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => "Bearer {$this->getTokenAdmin()}",
            ],
        ]);

        if ($resposta->getStatusCode() == Response::HTTP_NO_CONTENT) {
            $user = User::where('id_keycloak', $idKeycloak)->first();
            $user->name = $userKeycloak->getName();
            $user->cpf = $userKeycloak->getCpf();
            $user->email = $userKeycloak->getEmail();
            $user->telefone = $userKeycloak->getTelefone();
            $user->id_keycloak = $idKeycloak;
            $user->municipio_id = $userKeycloak->getCidadeId();
            $user->categoriaprofissional_id = $userKeycloak->getCategoriaProfissionalId();
            $user->save();

            if (!$user->id) {
                throw new \Exception('Usuário não atualizado na API');
            }

            $unidadesServicos = $userKeycloak->getUnidadesServicos();
            if (null !== $unidadesServicos) {
                foreach ($user->unidadesServicos()->get() as $userUnidadeServico_) {
                    $userUnidadeServico_->delete();
                }

                foreach ($unidadesServicos as $servico) {
                    $userUnidadeServico = new UserUnidadeServico();
                    $userUnidadeServico->user_id = $user->id;
                    $userUnidadeServico->unidade_servico_id = $servico->id;
                    $userUnidadeServico->save();
                }
            }

            $titulacoesAcademica = $userKeycloak->getTitulacoesAcademicas();
            if (null !== $titulacoesAcademica) {
                foreach ($user->titulacoesAcademicas()->get() as $userTitulacoesAcademica_) {
                    $userTitulacoesAcademica_->delete();
                }

                foreach ($titulacoesAcademica as $titulacao) {
                    $userTitulacaoAcademica = new UserTitulacaoAcademica();
                    $userTitulacaoAcademica->user_id = $user->id;
                    $userTitulacaoAcademica->titulacao_academica_id = $titulacao->id;
                    $userTitulacaoAcademica->save();
                }
            }

            $tiposContratacoes = $userKeycloak->getTiposContratacoes();
            if (null !== $tiposContratacoes) {
                foreach ($user->tiposContratacoes()->get() as $userTiposContratacoes_) {
                    $userTiposContratacoes_->delete();
                }

                foreach ($tiposContratacoes as $tipoContratacao) {
                    $userTipoContratacao = new UserTipoContratacao();
                    $userTipoContratacao->user_id = $user->id;
                    $userTipoContratacao->tipo_contratacao_id = $tipoContratacao->id;
                    $userTipoContratacao->save();
                }
            }

            return $user;
        } else {
            throw new \Exception('Usuário não atualizado error keycloak');
        }
    }

    private function getTokenAdmin()
    {
        $response = $this->keycloakClient->post("{$this->keycloakUri}/auth/realms/{$this->keycloakAdminIsusRealm}/protocol/openid-connect/token", [
            'form_params' => [
                'username' => $this->keycloakAdminIsusUser,
                'password' => $this->keycloakAdminIsusPassword,
                'client_id' => $this->keycloakAdminIsusClientId,
                'grant_type' => $this->keycloakAdminIsusGranttype,
            ],
        ]);

        $body = json_decode($response->getBody());

        return $body->access_token;
    }
}
