<?php

namespace App\Http\Services;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use App\Model\UserKeycloak;

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
        return $this->keycloakClient->post("{$this->keycloakUri}/auth/admin/realms/saude/users", [
            RequestOptions::JSON => $userKeycloak->toKeycloak(),
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => "Bearer {$this->getTokenAdmin()}"
            ]
        ]);
    }
}
