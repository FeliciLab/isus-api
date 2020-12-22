<?php

declare(strict_types=1);

namespace App\Domains\QualiQuiz\Service;

use App\Domains\QualiQuiz\Models\Resposta;
use App\Domains\QualiQuiz\Repository\RespostaRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * Contém a regra de negócio para salvar a resposta na base de dados.
 *
 * @category QualiQuiz
 *
 * @author  Chicão Thiago <fthiagogv@gmail.com>
 * @license GPL3 http://www.gnu.org/licenses/gpl-3.0.en.html
 *
 * @link https://github.com/EscolaDeSaudePublica/isus-api
 */
class RespostaQuizService
{
    /**
     * Inicialize.
     */
    public function __construct()
    {
        $this->repository = new RespostaRepository();
    }

    /**
     * Verifica se a resposta existe no banco.
     *
     * @param $resposta     array      Matriz com as respostas
     * @param $autenticacao Collection dados de autenticação
     *
     * @return bool
     */
    public function verificarExisteResposta(
        array $resposta,
        Collection $autenticacao
    ): bool {
        return $this
            ->repository
            ->verificarRespostaExiste(
                $resposta['quizId'],
                $resposta['questaoId'],
                $autenticacao->get('email')
            ) !== null;
    }

    /**
     * Regra de negócio que salvar na base de dados a resposta.
     *
     * @param $respostas    Collection
     * @param $autenticacao Collection
     * @param $token        string
     *
     * @return array
     */
    public function registrarRespostas(
        Collection $respostas,
        Collection $autenticacao,
        string $token
    ): array {
        $respostasInserir = [];
        foreach ($respostas as $resposta) {
            if (env('QQUIZ_BLOQUEAR_OUTRAS_RESPOSTAS')
                && $this->verificarExisteResposta($resposta, $autenticacao)
            ) {
                return [
                    'msg' => 'Existe uma questão já respondida para esta pessoa'
                        . 'usuária. '
                        . 'Remova elas, ou verifica sua consistência.',
                    'status' => 409,
                ];
            }

            $respostasInserir[] = [
                'questao_id' => $resposta['questaoId'],
                'quiz_id' => $resposta['quizId'],
                'questao_alternativa_id' => $resposta['alternativaId'],
                'identificacao' => $autenticacao->get('email'),
                'tipo_identificacao' => Resposta::DEFAULT_TYPE,
                'tempo' => $resposta['tempo'],
                'token' => $token,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        if ($this->repository->salvarReposta($respostasInserir)) {
            return [
                'msg' => 'Salvo com sucesso.',
                'status' => 200,
            ];
        }

        return [
            'msg' => 'Houve falha ao salvar na base de dados.',
            'status' => 400,
        ];
    }
}
