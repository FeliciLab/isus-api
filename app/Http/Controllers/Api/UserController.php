<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\UnidadesServicoCategoria;
use App\Model\User;
use App\Model\UserKeycloak;
use App\Service\KeycloakService;
use App\Service\MeusConteudosService;
use App\Service\UserService;
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

        $validacao = $this->validarRequisicaoSaveUser($dados);

        if ($validacao->fails()) {
            return response()->json(
                [
                    'sucesso' => false,
                    'erros' => $validacao->errors(),
                ],
                Response::HTTP_BAD_REQUEST
            );
        }

        $userKeycloak = new UserKeycloak($dados);

        $keyCloakService = new KeycloakService();

        $user = $keyCloakService->save($userKeycloak);

        if (!empty($user->id_keycloak)) {
            return response()->json(
                [
                    'sucesso' => true,
                    'mensagem' => 'Usuário cadastrado com sucesso',
                ]
            );
        }
    }

    public function projetosPorProfissional(Request $request)
    {
        $usuario = User::where('id_keycloak', $request->usuario->sub)->first();
        $meusConteudosServ = new MeusConteudosService();

        if ($usuario) {
            if (null === $usuario->categoriaprofissional_id) {
                $categProfissional = '0';
                $especialidadeUsuario = '0';
            } elseif (count($usuario->especialidades) == 0 && $usuario->categoriaprofissional_id) {
                $especialidadeUsuario = '0';
                $categProfissional = $usuario->categoriaProfissional()->first('id')->id;
            } else {
                $especialidadeUsuario = $usuario->especialidades()->first('especialidade_id')->especialidade_id;
                $categProfissional = $usuario->categoriaProfissional()->first('id')->id;
            }

            $projetosDoProfissional = $meusConteudosServ->findConteudoByCategoriaId($categProfissional, $especialidadeUsuario);

            return response()->json(
                [
                    'sucesso' => true,
                    'projetosDoProfissional' => $projetosDoProfissional,
                ]
            );
        }

        return response()->json(
            [
                'sucesso' => false,
                'mensagem' => 'Usuário não existe',
            ]
        );
    }

    /**
     * Consulta os dados do perfil da persona e retorna o perfil completo ou um
     * pre-cadastro.
     *
     * @param $request         Request
     * @param $keyCloakService KeycloakService
     * @param $userService     UserService
     *
     * @return JsonResponse
     */
    public function perfil(
        Request $request,
        KeycloakService $keyCloakService,
        UserService $userService
    ) {
        $userProfile = $keyCloakService->fetchUserProfile(
            $request->header('authorization')
        );

        $user = $userService->fetchUserRegisteredCorrectly($userProfile);

        // Caso quando o usuário existe no iSUS
        if ($user) {
            return response()->json(
                [
                    'data' => $user->dadosUsuario(),
                    'cadastrado' => true,
                ]
            );
        }

        return response()->json(
            [
                'data' => $userService->preRegisterUser($userProfile),
                'cadastrado' => false,
            ]
        );
    }

    public function update(
        Request $request,
        KeycloakService $keyCloakService
    ) {
        $dados = $request->all();

        $validacao = $this->validarRequisicaoUpdate($dados);

        if ($validacao->fails()) {
            return response()->json(
                ['sucesso' => false, 'erros' => $validacao->errors()],
                Response::HTTP_BAD_REQUEST
            );
        }

        $userKeycloak = new UserKeycloak($dados);

        // Atualiza tbm para o iSUS
        // Sinto que faltou um clean code 🚀
        $user = $keyCloakService->update($userKeycloak, $request->usuario->sub);

        if (empty($user->id_keycloak)) {
            return response()->json(
                ['sucesso' => false, 'mensagem' => 'Falha ao atualizar'],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }

        return response()->json(['sucesso' => true, 'mensagem' => 'Usuário atualizado com sucesso']);
    }

    public function cpfCadastrado($cpf)
    {
        $dados = ['cpf' => $cpf];
        $validacao = Validator::make(
            $dados,
            [
                'cpf' => 'required|cpf|min:11|max:11',
            ]
        );

        if ($validacao->fails()) {
            return response()->json(['sucesso' => true, 'mensagem' => $validacao->errors()]);
        }

        $keycloakService = new KeycloakService();
        $userService = new UserService();

        $cpfCadastradoKeyCloak = $keycloakService
            ->keyCloakRetornaUsuarioPorUsername($cpf);

        $cpfCadastradoIsusApi = $userService->verificarCpfExiste($cpf);

        if ($cpfCadastradoKeyCloak) {
            return response()->json(['cpf_existe' => true, 'mensagem' => 'CPF já cadastrado no ID Saúde']);
        }

        if ($cpfCadastradoIsusApi) {
            return response()->json(['cpf_existe' => true, 'mensagem' => 'CPF já cadastrado no iSUS']);
        }

        return response()->json(['cpf_existe' => false]);
    }

    public function emailCadastrado($email)
    {
        $dados = ['email' => $email];

        $validacao = Validator::make(
            $dados,
            [
                'email' => 'required|email',
            ]
        );

        if ($validacao->fails()) {
            return response()->json(['sucesso' => true, 'mensagem' => $validacao->errors()]);
        }

        $keycloakService = new KeycloakService();
        $userService = new UserService();

        // Verifica se existe um usuário com aquele email no idSaude
        $userKeyCloak = $keycloakService->keyCloakRetornaUsuarioPorEmail($email);
        if ($userKeyCloak) {
            return response()->json(['email_existe' => true, 'mensagem' => 'EMAIL já cadastrado no ID Saúde']);
        }

        // Verifica se existe um usuário com aquele email no idSaude
        $userISUS = $userService->verificarEmailExiste($email);
        if ($userISUS) {
            return response()->json(['email_existe' => true, 'mensagem' => 'EMAIL já cadastrado no iSUS']);
        }

        return response()->json(['email_existe' => false]);
    }

    public function delete(Request $request)
    {
        try {
            $idKeycloak = $request->usuario->sub;

            $keycloakService = new KeycloakService();

            if ($keycloakService->delete($idKeycloak)) {
                return response()->json(['sucesso' => true, 'mensagem' => 'Usuário excluído com sucesso']);
            }
        } catch (Exception $error) {
            return response()->json(
                ['sucesso' => false, 'erros' => 'Não foi possível excluir usuário'],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    private function projetosPorMacroUnidades($macroUnidadeDeSaude)
    {
        $projetosPorMacrounidades = [];
        $unidadeServicoCategoria = $macroUnidadeDeSaude->unidadesServicoCategoria()->first();
        $categoria = $unidadeServicoCategoria->categoria()->first();

        if (null !== $categoria) {
            if (in_array($categoria->term_id, UnidadesServicoCategoria::WORDPRESS_CATEGORIAS_VALIDAS)) {
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
        }

        return $projetosPorMacrounidades;
    }

    private function validarRequisicaoSaveUser($dados)
    {
        return Validator::make(
            $dados,
            [
                'email' => 'required|email',
                'cpf' => 'required|cpf|min:11|max:11',
                'nomeCompleto' => 'required',
                'senha' => 'min:8|required|required_with:repetirsenha|same:repetirsenha',
                'repetirsenha' => 'min:8|required',
                'telefone' => 'required|min:9|max:11',
                'cidadeId' => 'required',
                'cidade' => 'required',
                'termos' => 'accepted',
            ]
        );
    }

    private function validarRequisicaoUpdate($dados)
    {
        return Validator::make(
            $dados,
            [
                'email' => 'required|email',
                // 'cpf' => 'required|cpf|min:11|max:11', // removendo cpf para ajustes no idSaude
                'nomeCompleto' => 'required',
                'telefone' => 'required|min:9|max:11',
                'cidadeId' => 'required',
                'cidade' => 'required',
                'termos' => 'accepted',
            ]
        );
    }
}
