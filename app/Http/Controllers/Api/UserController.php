<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\KeycloakService;
use App\Model\User;
use App\Model\UserKeycloak;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function save(Request $request)
    {
        $dados = $request->all();
        $validacao = $this->validarRequisicao($dados);
        if($validacao->fails()) {
            return response()->json([ 'sucesso' => false, 'erros' =>  $validacao->errors()]);
        }
        $userKeycloak = new UserKeycloak($dados);
        $keyCloakService = new KeycloakService();
        try {
            $user = $keyCloakService->save($userKeycloak);

            if (!empty($user->id_keycloak)) {
                return response()->json([ 'sucesso' => true, 'mensagem' =>  "Usuário cadastrado com sucesso"]);
            }
        } catch (Exception $error) {
            return response()->json([ 'sucesso' => false, 'erros' =>  "Não foi possível cadastrar o usuário"]);
        }
    }

    private function validarRequisicao($dados)
    {
        return Validator::make($dados, [
            'email' => 'required|email|unique:users',
            'nomeCompleto' => 'required',
            'senha' => 'min:8|required|required_with:repetirsenha|same:repetirsenha',
            'repetirsenha' => 'min:8|required',
            'telefone' => 'required|min:9|max:11',
            'cpf' => 'required|min:11|max:11|unique:users',
            'cidadeId' => 'required',
            'cidade' => 'required',
            'termos' => 'accepted'
        ]);
    }
}
