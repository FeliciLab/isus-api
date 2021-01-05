<?php

declare(strict_types=1);

namespace App\Domains\QualiQuiz\Service;

use App\Domains\QualiQuiz\Repository\RelatorioQuizRepository;
use App\Domains\QualiQuiz\Utils\CallbacksUtils;

/**
 * Classe responsável pela regra de negócio do relatório.
 *
 * @category Service
 *
 * @author  Chicão Thiago <fthiagogv@gmail.com>
 * @license GPL-3 http://www.gnu.org/licenses/gpl-3.0.en.html
 *
 * @link https://github.com/EscolaDeSaudePublica/isus-api/issues/137
 */
class RelatorioQuizService
{
    private $_headersRespostas = [
        'identificacao' => 'Identificação',
        'cod_quiz' => 'Cod. Quiz',
        'questao' => 'Questão',
        'opcao_marcada' => 'Opção Marcada',
        'acerto' => 'Acerto',
        'data_resposta' => 'Data da Resposta',
    ];

    /**
     * Função para uso no stream para download do relatório.
     *
     * @return function
     */
    public function callbackGerarRelatorioQuizRespostasTudo()
    {
        return (new CallbacksUtils())->callbackCsvStream(
            (new RelatorioQuizRepository)->buscarTudoRelatorioRespostas(),
            $this->_headersRespostas
        );
    }

    /**
     * Gera relatório completo das respostas do quiz.
     *
     * @param string $codQuiz Código do quiz
     *
     * @return callable
     */
    public function gerarRelatorioQuizRespostasPeloCodQuiz(
        string $codQuiz = ''
    ): callable {
        return (new CallbacksUtils())->callbackCsvStream(
            (new RelatorioQuizRepository)->buscarRelatorioRespostarCodQuiz($codQuiz),
            $this->_headersRespostas
        );
    }
}
