<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Service\KeycloakService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function auth(Request $request)
    {
        $dados = $request->all();
        $validacao = $this->validarRequisicao($dados);
        if ($validacao->fails()) {
            return response()->json(
                ['sucesso' => false, 'erros' =>  $validacao->errors()],
                Response::HTTP_BAD_REQUEST
            );
        }

        $keyCloakService = new KeycloakService();

        try {
            $resposta = $keyCloakService->login($dados['email'], $dados['senha']);
        } catch (\GuzzleHttp\Exception\ClientException $exception) {
            if ($exception->getCode() === Response::HTTP_UNAUTHORIZED) {
                return response()->json(
                    [
                        'sucesso' => false,
                        'erros' =>  'Usuário ou senha inválidos'
                    ],
                    Response::HTTP_UNAUTHORIZED
                );
            }

            return response()->json(
                [
                    'sucesso' => false,
                    'erros' => $exception->getMessage()
                ],
                $exception->getCode()
            );
        } catch (\GuzzleHttp\Exception\ServerException $exception) {
            return response()->json(
                [
                    'sucesso' => false,
                    'erros' => 'Problema interno. Contate o time de suporte para solucionar avaliar o problema.'
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        } catch (Exception $error) {
            return response()->json(['sucesso' => false, 'erros' =>  'Usuário ou senha inválidos'], Response::HTTP_BAD_REQUEST);
        }

        if ($resposta->getStatusCode() === Response::HTTP_OK) {
            return response()->json(['sucesso' => true, 'mensagem' => json_decode($resposta->getBody())], Response::HTTP_OK);
        }

        return response()->json(['sucesso' => false, 'mensagem' => 'Erro ao realizar o login do usuário'], Response::HTTP_BAD_REQUEST);
    }

    public function logout(Request $request)
    {
        $dados = $request->all();
        $keyCloakService = new KeycloakService();
        try {
            $resposta = $keyCloakService->logout($dados['refresh_token']);

            if ($resposta->getStatusCode() == Response::HTTP_NO_CONTENT) {
                return response()->json(['sucesso' => true, 'mensagem' =>  'Logout de usuário realizado com sucesso'], Response::HTTP_OK);
            } else {
                return response()->json(['sucesso' => true, 'mensagem' =>  'Erro ao realizar logout de usuário'], Response::HTTP_BAD_REQUEST);
            }
        } catch (Exception $error) {
            return response()->json(['sucesso' => false, 'erros' =>  'Não foi possível realizar o logout do usuário']);
        }
    }

    public function refreshToken(Request $request)
    {
        $dados = $request->all();
        $validacao = Validator::make($dados, [
            'refresh_token' => 'required',
        ]);
        if ($validacao->fails()) {
            return response()->json(['sucesso' => false, 'erros' =>  $validacao->errors()]);
        }
        $keyCloakService = new KeycloakService();

        try {
            $resposta = $keyCloakService->refreshToken($dados['refresh_token']);
            $novoJwt = json_decode($resposta->getBody());
            if ($resposta->getStatusCode() == Response::HTTP_OK) {
                return response()->json(['sucesso' => true, 'mensagem' => $novoJwt], Response::HTTP_OK);
            } else {
                return response()->json(['sucesso' => false, 'mensagem' =>  ' Erro ao realizar o refresh token'], Response::HTTP_BAD_REQUEST);
            }
        } catch (Exception $error) {
            return response()->json(['sucesso' => false, 'erros' =>  'Não foi possível gerar um novo refresh token']);
        }
    }

    private function validarRequisicao($dados)
    {
        return Validator::make($dados, [
            'email' => 'required|email',
            'senha' => 'required',
        ]);
    }
}
