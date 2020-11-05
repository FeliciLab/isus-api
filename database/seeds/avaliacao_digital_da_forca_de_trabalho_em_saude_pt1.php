<?php

use Illuminate\Database\Seeder;
use App\Domains\QualiQualiz\Models\Quiz;
use App\Domains\QualiQualiz\Models\Questao;
use App\Domains\QualiQualiz\Models\QuizQuestao;
use App\Domains\QualiQualiz\Models\AlternativaQuestao;

class avaliacao_digital_da_forca_de_trabalho_em_saude_pt1 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $quiz = (new Quiz([
            'nome' => $this->avaliacao['quiz']['nome'],
            'area_tematica' => $this->avaliacao['quiz']['area_tematica'],
            'publico_alvo' => $this->avaliacao['quiz']['publico_alvo'],
            'descricao' => $this->avaliacao['quiz']['descricao'],
        ]));
        $quiz->save();

        foreach ($this->avaliacao['questoes'] as $index => $questao) {
            $questaoModel = new Questao([
                'questao' => $questao['questao']
            ]);
            $questaoModel->save();

            $quizQuestao = new QuizQuestao([
                'ordem' => ($index + 1),
                'quiz_id' => $quiz->id,
                'questao_id' => $questaoModel->id,
            ]);
            $quizQuestao->save();

            foreach ($questao['alternativas'] as $aIndex => $alternativa) {
                $alternativaQuestao = new AlternativaQuestao([
                    'alternativa' => $alternativa['alternativa'],
                    'pontuacao' => $alternativa['pontuacao'],
                    'questao_id' => $questaoModel->id,
                    'ordem' => ($aIndex + 1),
                ]);

                $alternativaQuestao->save();
            }
        }
    }

    public $avaliacao = [
        'quiz' => [
            'nome' => 'AVALIAÇÃO DIGITAL DA FORÇA DE TRABALHO EM SAÚDE',
            'area_tematica' => 'SUS – PARTE I',
            'publico_alvo' => 'TRABALHADORES DA SAÚDE DE NÍVEL SUPERIOR',
            'descricao' => '<p>Caro trabalhador da saúde,</p>
                <p>Este teste tem o objetivo de prover uma oportunidade para você fazer uma autoavaliação dos seus conhecimentos sobre a área temática do SUS. Ele faz parte de uma avaliação digital da força de trabalho em saúde. Os resultados serão utilizados para o desenvolvimento de programas de educação permanente dos trabalhadores em saúde. Só você e a equipe avaliadora terão acesso aos resultados. O próprio sistema dará uma devolutiva se você acertou ou não o item, bem como oferecerá comentários sobre os itens correto e errados e fará sugestões de referências para você aprofundar o tema. Assim, você já começa a aprimorar seus conhecimentos na área. Contamos com sua participação e boa sorte! Este teste tem 10 questões e aborda conhecimentos relacionados às seguintes competências:</p>
                <ul>
                <li>Aplicação dos princípios do SUS na sua prática profissional.</li>
                <li>Aplicação dos princípios e atributos da Atenção Básica na sua prática profissional.</li>
                <li>Utilização dos conceitos de Vigilância em Saúde na sua prática profissional.</li>
                <li>Atuação profissional com base nos princípios da Política Nacional de Humanização.</li>
                </ul>
                ',
        ],
        'questoes' => [
            [
                'questao' => 'Em 1986, o morador de um sítio no município “Tempos idos”, sentiu-se mal após o almoço. Sua esposa acompanhou-o até o serviço de saúde, temendo que ele só seria atendido se comprovasse um vínculo formal de emprego. Assim, de posse da carteira profissional do marido, foram em busca da assistência no “Posto” de saúde mais próximo de onde moravam. A partir de 1988, com a implantação do Sistema Único de Saúde (SUS), a exigência da carteira profissional para a prestação da assistência ao cidadão descumprirá qual princípio do SUS?',
                'url_imagem' => '',
                'alternativas' => [
                    ['alternativa' => 'Integralidade', 'pontuacao' => 0],
                    ['alternativa' => 'Equidade', 'pontuacao' => 0],
                    ['alternativa' => 'Universalidade', 'pontuacao' => 100],
                    ['alternativa' => 'Igualdade', 'pontuacao' => 0],
                ],
            ],
            [
                'questao' => 'Ana, costureira, tem queixa antiga de dores nas costas e histórico de vários atendimentos emergenciais na UPA. Incentivada pela agente comunitária de saúde busca atendimento médico na Unidade Básica de Saúde (UBS). Após várias tentativas, é atendida, recebe remédios para dor e uma guia para agendar exames de imagens na Secretaria da Saúde do município. Passados dois meses retorna para a UBS e sai de lá com mais remédios e outra guia para agendar consulta com um médico ortopedista. Após a espera de outros três meses, foi hospitalizada com gastrite crônica medicamentosa. Neste contexto, qual princípio do SUS foi negligenciado?',
                'url_imagem' => '',
                'alternativas' => [
                    ['alternativa' => 'Universalidade de acesso gratuito aos serviços de saúde em todos os níveis de assistência;', 'pontuacao' => 0],
                    ['alternativa' => 'Integralidade de assistência, conjunto articulado e contínuo das ações e serviços preventivos e curativos;', 'pontuacao' => 100],
                    ['alternativa' => 'Preservação da autonomia das pessoas na defesa de sua integridade física e moral;', 'pontuacao' => 0],
                    ['alternativa' => 'Igualdade da assistência à saúde, sem preconceitos ou privilégios de qualquer espécie.', 'pontuacao' => 0],
                ],
            ],
        ],
        [
            'questao' => 'Gabriel, enfermeiro, ex-residente em saúde, atualmente é concursado da equipe básica de saúde do município. Na sua prática profissional reconhece que o direito à saúde passa pelas diferenciações sociais e que atende à diversidade, sem qualquer tipo de exclusão ou estigmatização. Assinale a opção que apresenta o princípio da atenção básica que Gabriel aplica na sua prática profissional:',
            'url_imagem' => '',
            'alternativas' => [
                ['alternativa' => 'Integralidade', 'pontuacao' => 0],
                ['alternativa' => 'Igualdade', 'pontuacao' => 0],
                ['alternativa' => 'Universalidade', 'pontuacao' => 0],
                ['alternativa' => 'Equidade', 'pontuacao' => 100],
            ],
        ],
        [
            'questao' => 'A Política Nacional da Atenção Básica (Portaria n. 2436 de 21/09/2017) estabelece a revisão das diretrizes para organização da Atenção Básica no SUS e elenca o conjunto de ações que a equipe multiprofissional deve dirigir à população sob sua responsabilidade sanitária. Tomando como base este documento assinale a opção CORRETA sobre estas ações:',
            'url_imagem' => '',
            'alternativas' => [
                ['alternativa' => 'Envolvem principalmente ações de promoção da saúde.', 'pontuacao' => 0],
                ['alternativa' => 'As ações de saúde devem ser individuais, familiares e coletivas.', 'pontuacao' => 100],
                ['alternativa' => 'Incluem ações por meio de práticas de cuidados individuais em Policlínicas.', 'pontuacao' => 0],
                ['alternativa' => 'Não envolvem ações de vigilância em saúde.', 'pontuacao' => 0],
            ],
        ],
        [
            'questao' => 'São quatro os atributos da atenção primária á saúde. Os profissionais que atuam nas Equipes de Saúde da Família do Município de Esperança passaram a reconhecer os problemas que requerem seguimento constante e a organizarem seu processo de trabalho de modo a garantir a continuidade da atenção. Assinale a alternativa corresponde ao atributo descrito acima?',
            'url_imagem' => '',
            'alternativas' => [
                ['alternativa' => 'Coordenação do Cuidado', 'pontuacao' => 100],
                ['alternativa' => 'Primeiro contato', 'pontuacao' => 0],
                ['alternativa' => 'Longitudinalidade da Atenção', 'pontuacao' => 0],
                ['alternativa' => 'Integralidade', 'pontuacao' => 0],
            ],
        ],
        [
            'questao' => 'Os trabalhadores de saúde do Município de Bonança estão desenvolvendo ações que proporcionam o conhecimento, a detecção ou prevenção de qualquer mudança nos fatores determinantes e condicionantes de saúde individual ou coletiva, com a finalidade de recomendar e adotar as medidas de prevenção e controle das doenças ou agravos. Nesse caso, estão fazendo que tipo de Vigilância, segundo o artigo 6º, § 2º da Lei Orgânica da Saúde?',
            'url_imagem' => '',
            'alternativas' => [
                ['alternativa' => 'Vigilância Epidemiológica', 'pontuacao' => 100],
                ['alternativa' => 'Vigilância Imunológica', 'pontuacao' => 0],
                ['alternativa' => 'Vigilância Terapêutica', 'pontuacao' => 0],
                ['alternativa' => 'Vigilância Sanitária', 'pontuacao' => 0],
            ],
        ],
        [
            'questao' => 'Telma, médica de uma Unidade Básica de Saúde, está atuando de forma integrada com profissionais de diferentes especialidades no acompanhamento do estado geral e clínico da Ana, gestante de 4 meses, que na gravidez anterior perdeu o bebê no sexto mês gestacional. A médica está promovendo ainda encontros singulares com Ana e seus familiares para a busca conjunta de cuidados complementares no controle da ansiedade e da hipertensão que a gestante está desenvolvendo. Qual das opções abaixo apresenta a diretriz da Política Nacional de Humanização que a médica está utilizando?',
            'url_imagem' => '',
            'alternativas' => [
                ['alternativa' => 'Clínica Ampliada', 'pontuacao' => 100],
                ['alternativa' => 'Consulta Compartilhada', 'pontuacao' => 0],
                ['alternativa' => 'Interação com o Nasf', 'pontuacao' => 0],
                ['alternativa' => 'Integração serviço-comunidade', 'pontuacao' => 0],
            ],
        ],
    ];
}
