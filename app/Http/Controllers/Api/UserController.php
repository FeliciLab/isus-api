<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\KeycloakService;
use App\Model\UnidadeServico;
use App\Model\User;
use App\Model\UserKeycloak;
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
        if ($validacao->fails()) {
            return response()->json(['sucesso' => false, 'erros' =>  $validacao->errors()]);
        }
        $userKeycloak = new UserKeycloak($dados);
        $keyCloakService = new KeycloakService();
        $user = $keyCloakService->save($userKeycloak);

        if (!empty($user->id_keycloak)) {
            return response()->json(['sucesso' => true, 'mensagem' =>  'Usuário cadastrado com sucesso']);
        }
    }

    public function projetosPorProfissional(Request $request)
    {
        $usuario = User::where('id_keycloak', $request->usuario->sub)->first();

        if ($usuario) {
            $unidadesDoUsuario = $usuario->unidadesServicos()->get()->pluck('unidade_servico_id');
            $macroUnidadesDeSaude = UnidadeServico::pegarMacroUnidadeDeServico($unidadesDoUsuario);
            $projetosDoProfissional = [];
            foreach ($macroUnidadesDeSaude as $macroUnidadeDeSaude) {
                $projetosPorMacrounidades = $this->projetosPorMacroUnidades($macroUnidadeDeSaude);
                $projetosDoProfissional = array_merge($projetosDoProfissional, $projetosPorMacrounidades);
            }

            return response()->json([[
                'sucesso' => true,
                'projetosDoProfissional' => array_unique($projetosDoProfissional, SORT_REGULAR),
            ]]);
        }

        return response()->json([
            'sucesso' => false,
            'mensagem' => 'Usuário não existe',
        ]);
    }

    public function perfil(Request $request)
    {
        $usuario = User::where('id_keycloak', $request->usuario->sub)->first();
        $dadosUsuario = $usuario->dadosUsuario();

        return response()->json([
            'sucesso' => true,
            'data' =>  $dadosUsuario,
        ]);
    }

    private function projetosPorMacroUnidades($macroUnidadeDeSaude)
    {
        $projetosPorMacrounidades = [];

        $unidadeServicoCategoria = $macroUnidadeDeSaude->unidadesServicoCategoria()->first();
        $categoria = $unidadeServicoCategoria->categoria()->first();

        if (null !== $categoria) {
            $categoriasProjetos = $categoria->categoriaProjetos()->get();
            foreach ($categoriasProjetos as $categoriaProjeto) {
                $projeto = $categoriaProjeto->projeto()->first();
                $projetosPorMacrounidades[] = [
                    'id' => $projeto->id,
                    'slug' => $projeto->slug,
                    'post_date' => $projeto->data,
                    'post_title' => $projeto->post_title,
                    'post_content' => $projeto->content,
                    'image' => $projeto->image,
                    'anexos' => $projeto->anexos()->get(),
                ];
            }
        }

        return $projetosPorMacrounidades;
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
            'termos' => 'accepted',
        ]);
    }
}
