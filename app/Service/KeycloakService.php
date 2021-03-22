<?php

namespace App\Service;

use App\Model\User;
use App\Model\UserEspecialidade;
use App\Model\UserKeycloak;
use App\Model\UserTipoContratacao;
use App\Model\UserTitulacaoAcademica;
use App\Model\UserUnidadeServico;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Http\Response;

class KeycloakService
{
    private $keycloakClient;
    private $keycloakUri;
    private $keycloakAdminIsusRealm;
    private $keycloakAdminIsusUser;
    private $keycloakAdminIsusPassword;
    private $keycloakAdminIsusClientId;
    private $keycloakAdminIsusGranttype;
    private $keycloakRoutes = [
        'users-management' => '/auth/admin/realms/saude/users/'
    ];

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

    /**
     * Controi as rotas do keycloak a partir de uma "name-tag"
     *
     * @param $routeName string
     *
     * @return string
     */
    public function getRoute(string $routeName): string
    {
        return $this->keycloakUri . $this->keycloakRoutes[$routeName];
    }

    /**
     * Retorna os headers utilizados nas requisições
     *
     * @param $hasHeader array
     *
     * @return array
     */
    public function getHeaders(array $includeHeaders=[])
    {
        $headers = [
            'Authorization' => "Bearer {$this->getTokenAdmin()}",
        ];

        if (array_search('json', $includeHeaders)) {
            $headers['Content-Type'] = 'application/json';
        }

        return [
            'headers' => $headers
        ];
    }

    public function login($email, $senha)
    {
        return $this->keycloakClient->post("{$this->keycloakUri}/auth/realms/saude/protocol/openid-connect/token", [
            'form_params' => [
                'username' => $email,
                'password' => $senha,
                'client_id' => 'isus',
                'grant_type' => $this->keycloakAdminIsusGranttype,
            ],
        ]);
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

    public function refreshToken($refreshToken)
    {
        $response = $this->keycloakClient->post("{$this->keycloakUri}/auth/realms/saude/protocol/openid-connect/token", [
            'form_params' => [
                'refresh_token' => $refreshToken,
                'client_id' => 'isus',
                'grant_type' => 'refresh_token',
            ],
        ]);

        return $response;
    }

    public function verificarSeExisteDadoNaPropriedade($propriedade, $valor)
    {
        $respostaUsuarios = $this->keyCloakUsers();
        $usuarios = json_decode($respostaUsuarios->getBody());

        foreach ($usuarios as $usuario) {
            if (isset($usuario->attributes) &&
                isset($usuario->attributes->$propriedade) &&
                $valor == $usuario->attributes->$propriedade[0]) {
                return true;
            }
        }

        return false;
    }

    public function keyCloakUsers()
    {
        $response = $this->keycloakClient->get("{$this->keycloakUri}/auth/admin/realms/saude/users?max=999999", [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => "Bearer {$this->getTokenAdmin()}",
            ],
        ]);

        return $response;
    }

    public function keyCloakRetornaUsuarioPorUsername($username)
    {
        $response = $this->keycloakClient->get("{$this->keycloakUri}/auth/admin/realms/saude/users?username=" . $username, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => "Bearer {$this->getTokenAdmin()}",
            ],
        ]);

        return json_decode($response->getBody());
    }

    /**
     * Coleta os dados do usuário
     *
     * @param $userId string Id da persona
     *
     * @return array
     */
    public function getUserData(string $userId)
    {
        return json_decode(
            $this->keycloakClient->get(
                $this->getRoute('users-management') . $userId,
                $this->getHeaders()
            )->getBody(),
            true
        );
    }

    /**
     * Buscar perfil do usuário através do token
     *
     * @param $token string
     *
     * @return array
     */
    public function fetchUserProfile($token): array
    {
        return json_decode($this->userProfile($token)->getBody(), true);
    }

    public function userProfile($token)
    {
        return $this->keycloakClient->post(
            "{$this->keycloakUri}/auth/realms/saude/protocol/openid-connect/userinfo",
            [
                'headers' => [
                    'Authorization' => "{$token}",
                ],
            ]
        );
    }

    public function getIdKeycloakFromHeader($resposta)
    {
        $location = $resposta->getHeader('Location');
        $locationArray = explode('/', $location[0]);

        return $locationArray[count($locationArray) - 1];
    }

    public function save(UserKeycloak $userKeycloak)
    {
        $resposta = $this->keycloakClient->post(
            "{$this->keycloakUri}/auth/admin/realms/saude/users",
            [
                RequestOptions::JSON => $userKeycloak->toKeycloak(),
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => "Bearer {$this->getTokenAdmin()}",
                ],
            ]
        );

        if ($resposta->getStatusCode() !== Response::HTTP_CREATED) {
            throw new \Exception('Usuário não criado error keycloak');
        }

        $user = (new UserService())->upsertUserAndRelationships(
            $userKeycloak,
            $this->getIdKeycloakFromHeader($resposta)
        );

        $this->enviarEmailCadastro($user);

        return $user;
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

            $especialidades = $userKeycloak->getEspecialidades();
            if (null !== $especialidades) {
                foreach ($user->especialidades()->get() as $userEspecialidade_) {
                    $userEspecialidade_->delete();
                }

                foreach ($especialidades as $especialidade) {
                    $userEspecialidade = new UserEspecialidade();
                    $userEspecialidade->user_id = $user->id;
                    $userEspecialidade->especialidade_id = $especialidade->id;
                    $userEspecialidade->save();
                }
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

    public function delete($idKeycloak)
    {
        $resposta = $this->keycloakClient->delete("{$this->keycloakUri}/auth/admin/realms/saude/users/{$idKeycloak}", [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => "Bearer {$this->getTokenAdmin()}",
            ],
        ]);

        if ($resposta->getStatusCode() == Response::HTTP_NO_CONTENT) {
            $user = User::where('id_keycloak', $idKeycloak)->first();

            return $user->remover();
        } else {
            throw new \Exception('Usuário não atualizado error keycloak');
        }
    }

    private function enviarEmailCadastro($user)
    {
        \Mail::send('email.bemvindo', ['usuario' => $user], function ($mensagem) use ($user) {
            $mensagem->from(env('MAIL_USERNAME'), 'iSUS')
            ->to($user->email)
            ->subject('Seja bem-vindo(a) ao iSUS');
        });
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
