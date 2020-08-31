<?php

namespace App\Http\Services;

use App\Model\User;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use App\Model\UserKeycloak;
use App\Model\UserUnidadeServico;
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
        $this->keycloakUri = env("KEYCLOAK_URI");
        $this->keycloakAdminIsusRealm = env("KEYCLOAK_ADMIN_ISUS_REALM");
        $this->keycloakAdminIsusUser = env("KEYCLOAK_ADMIN_ISUS_USER");
        $this->keycloakAdminIsusPassword = env("KEYCLOAK_ADMIN_ISUS_PASSWORD");
        $this->keycloakAdminIsusClientId = env("KEYCLOAK_ADMIN_ISUS_CLIENTID");
        $this->keycloakAdminIsusGranttype = env("KEYCLOAK_ADMIN_ISUS_GRANTTYPE");
    }

    public function login($email, $senha)
    {
        $response = $this->keycloakClient->post("{$this->keycloakUri}/auth/realms/saude/protocol/openid-connect/token", [
            'form_params' => [
                'username' => $email,
                'password' => $senha,
                'client_id' => 'isus',
                'grant_type' => $this->keycloakAdminIsusGranttype
            ]
        ]);

        return $response;
    }

    public function logout($refreshToken)
    {
        $response = $this->keycloakClient->post("{$this->keycloakUri}/auth/realms/saude/protocol/openid-connect/logout", [
            'form_params' => [
                'refresh_token' => $refreshToken,
                'client_id' => 'isus'
            ]
        ]);

        return $response;
    }

    public function userProfile($token)
    {
        return $this->keycloakClient->post("{$this->keycloakUri}/auth/realms/saude/protocol/openid-connect/userinfo", [
            'headers' => [
                'Authorization' => "{$token}"
            ]
        ]);
    }

    private function getTokenAdmin()
    {

        $response = $this->keycloakClient->post("{$this->keycloakUri}/auth/realms/{$this->keycloakAdminIsusRealm}/protocol/openid-connect/token", [
            'form_params' => [
                'username' => $this->keycloakAdminIsusUser,
                'password' => $this->keycloakAdminIsusPassword,
                'client_id' => $this->keycloakAdminIsusClientId,
                'grant_type' => $this->keycloakAdminIsusGranttype
            ]
        ]);

        $body =  json_decode($response->getBody());
        return $body->access_token;
    }

    public function save(UserKeycloak $userKeycloak)
    {
        $resposta = $this->keycloakClient->post("{$this->keycloakUri}/auth/admin/realms/saude/users", [
            RequestOptions::JSON => $userKeycloak->toKeycloak(),
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => "Bearer {$this->getTokenAdmin()}"
            ]
        ]);

        if ($resposta->getStatusCode() == Response::HTTP_CREATED) {

            $location = $resposta->getHeader('Location');

            $locationArray = explode('/', $location[0]);
            $idKeycloak = $locationArray[count($locationArray)-1];

            $user = new User();
            $user->name = $userKeycloak->getName();
            $user->cpf = $userKeycloak->getCpf();
            $user->email = $userKeycloak->getEmail();
            $user->password = Hash::make($userKeycloak->getPassword());
            $user->id_keycloak = $idKeycloak;
            $user->municipio_id = $userKeycloak->getCidadeId();
            $user->categoriaprofissional_id = $userKeycloak->getCategoriaProfissionalId();
            $user->save();

            if (!$user->id) {
                throw new \Exception('Usuário não criado na API');
            }

            $unidadesServicos = $userKeycloak->getUnidadesServicos();
            foreach ($unidadesServicos as $servico) {
                $userUnidadeServico = new UserUnidadeServico();
                $userUnidadeServico->user_id = $user->id;
                $userUnidadeServico->unidade_servico_id = $servico->id;
                $userUnidadeServico->save();
            }

            return $user;
        } else {
            throw new \Exception('Usuário não criado error keycloak');
        }
    }
}
