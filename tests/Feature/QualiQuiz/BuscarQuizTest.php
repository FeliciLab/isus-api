<?php

namespace Tests\Feature\QualiQuiz;

use Tests\TestCase;

/**
 * Teste da rota de buscar o quiz
 *
 * @category Tests
 *
 * @author  Chicão Thiago <fthiagogv@gmail.com>
 * @license GPL-3 http://www.gnu.org/licenses/gpl-3.0.en.html
 *
 * @link https://github.com/EscolaDeSaudePublica/isus-api/
 */
class BuscarQuizTest extends TestCase
{
    private string $_token = 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.'
        . 'eyJlbWFpbCI6ImRldkBkZXYuZGV2Iiwibm9tZSI6IkRldiBkZXYiLCJjcGYiOiIx'
        . 'MjMuMTIzLjEyMy02OSJ9.CkWK7LixybXxO7vCatModnOD_X8C0uCTJU89KPex-Vo';

    private string $_tokenBuscar = 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.'
        . 'eyJlbWFpbCI6ImRldkB0ZXN0ZS5kZXYiLCJub21lIjoiRGV2IGRldiIsImNwZiI6IjEifQ.'
        . 'cAmrqKcpRAzF5gJu_iPm1TRqZd7UnbQsSiAHWXhtLro';


    /**
     * Testa o retorno de status não autorizado ao não enviar um Token
     *
     * @return void
     */
    public function testTokenNaoEnviado()
    {
        $this->get('/api/qualiquiz/quiz/1')
            ->assertUnauthorized();
    }

    /**
     * Testa se o retorno para tokens invalidos
     *
     * @return void
     */
    public function testTokenInvalido()
    {
        $this->withHeader('Authorization', 'Bearer euiadhadfaf;sdafjasdfasdf')
            ->get('/api/qualiquiz/quiz/1')
            ->assertStatus(400);
    }

    /**
     * Testa o retorno de erro para quando não se envia o id do quiz
     *
     * @return void
     */
    public function testNaoEnvioDoCodigoQuiz()
    {
        $this->get('/api/qualiquiz/quiz')
            ->assertNotFound();
    }

    /**
     * Testa o retorno de erro para quando não se envia o id do quiz
     *
     * @return void
     */
    public function testCodQuizNaoNumero()
    {
        $this->withHeader('Authorization', $this->_token)
            ->get('/api/qualiquiz/quiz/joiado')
            ->assertStatus(400)
            ->assertJson(
                [
                    'mensagem' => 'Código do quiz não é um valor numérico inteiro'
                ]
            );
    }

    /**
     * Testa se a pes. usuária realizou o quiz e retorna a pontuação
     *
     * @return void
     */
    public function testRetornarPontuacao()
    {
        $this->withHeader('Authorization', $this->_token)
            ->get('/api/qualiquiz/quiz/1')
            ->assertOk()
            ->assertJsonStructure(['resultado', 'comentarioQuestoes']);
    }

    /**
     * Testa se a pes. usuária não realizou o quiz e retorna o quiz
     *
     * @return void
     */
    public function testRetornaQuiz()
    {
        $this->withHeader('Authorization', $this->_tokenBuscar)
            ->get('/api/qualiquiz/quiz/1')
            ->assertOk()
            ->assertJsonStructure(['id', 'quiz', 'tempo_limite', 'questoes']);
    }
}
