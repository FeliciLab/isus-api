<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\KeycloakService;
use App\Model\Estado;
use App\Model\User;
use App\Model\UserKeycloak;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
            $resposta = $keyCloakService->save($userKeycloak);
            if ($resposta->getStatusCode() == Response::HTTP_CREATED) {
                return response()->json([ 'sucesso' => true, 'mensagem' =>  "Usuário cadastrado com sucesso"]);
            }
        } catch (Exception $error) {
            return response()->json([ 'sucesso' => false, 'erros' =>  "Não foi possível cadastrar o usuário"]);
        }
    }

    private function validarRequisicao($dados)
    {
        return Validator::make($dados, [
            'enabled' => 'required|boolean',
            'username' => 'required',
            'email' => ['required', 'email'],
            'firstName' => 'required',
            'lastName' => 'required',
            'password' => 'required',
            'phone' => 'required|min:9|max:11',
            'cpf' => 'required|min:11|max:11',
            'rg' => 'required',
            'estadoId' => 'required',
            'estado' => 'required',
            'cidadeId' => 'required',
            'cidade' => 'required',
            'termos' => 'required|boolean',
            'categoriaProfissional' => 'required',
            'titulacaoAcademica' => 'required',
            'tipoContratacao' => 'required',
            'instituicao' => 'required'
        ]);
    }
}
