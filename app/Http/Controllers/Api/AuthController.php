<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\KeycloakService;
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
        if($validacao->fails()) {
            return response()->json([ 'sucesso' => false, 'erros' =>  $validacao->errors()]);
        }
        $keyCloakService = new KeycloakService();
        try {
            $resposta = $keyCloakService->login($dados['email'], $dados['senha']);

            if ($resposta->getStatusCode() == Response::HTTP_UNAUTHORIZED) {
                return response()->json([ 'sucesso' => false, 'erros' =>  "Erro ao realizar o login do usuário"], Response::HTTP_UNAUTHORIZED);
            } else if ($resposta->getStatusCode() == Response::HTTP_OK) {
                return response()->json([ 'sucesso' => true, 'mensagem' => json_decode($resposta->getBody())], Response::HTTP_OK);
            } else {
                return response()->json([ 'sucesso' => false, 'mensagem' => "Erro ao realizar o login do usuário"], Response::HTTP_BAD_REQUEST);
            }
        } catch (Exception $error) {
            return response()->json([ 'sucesso' => false, 'erros' =>  "Não foi possível realizar o login do usuário"]);
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
