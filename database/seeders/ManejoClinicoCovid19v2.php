<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Domains\QualiQuiz\Models\Quiz;
use App\Domains\QualiQuiz\Models\Questao;
use App\Domains\QualiQuiz\Models\QuizQuestao;
use App\Domains\QualiQuiz\Models\AlternativaQuestao;
use App\Domains\QualiQuiz\Models\Explicacao;

class ManejoClinicoCovid19v2 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $quiz = (new Quiz(
            [
                'cod_quiz' => $this->avaliacao['quiz']['cod_quiz'],
                'nome' => $this->avaliacao['quiz']['nome'],
                'tempo_limite' => $this->avaliacao['quiz']['tempo_limite'],
                'area_tematica' => $this->avaliacao['quiz']['area_tematica'],
                'publico_alvo' => $this->avaliacao['quiz']['publico_alvo'],
                'descricao' => $this->avaliacao['quiz']['descricao'],
                'ativo' => true,
                'id' => 4
            ]
        ));
        $quiz->save();

        foreach ($this->avaliacao['questoes'] as $index => $questao) {
            $questaoModel = new Questao(
                [
                    'questao' => $questao['questao']
                ]
            );
            $questaoModel->save();

            $quizQuestao = new QuizQuestao(
                [
                    'ordem' => ($index + 1),
                    'quiz_id' => $quiz->id,
                    'questao_id' => $questaoModel->id
                ]
            );

            $quizQuestao->save();

            $idAlternativaCorreta = false;
            foreach ($questao['alternativas'] as $aIndex => $alternativa) {
                $alternativaQuestao = new AlternativaQuestao(
                    [
                        'alternativa' => $alternativa['alternativa'],
                        'pontuacao' => $alternativa['pontuacao'],
                        'questao_id' => $questaoModel->id,
                        'ordem' => ($aIndex + 1),
                    ]
                );

                $alternativaQuestao->save();
                if ($questao['explicacao']['alternativa'] === $aIndex) {
                    $idAlternativaCorreta = $alternativaQuestao->id;
                }
            }

            $explicacao = new Explicacao(
                [
                    'questao_id' => $questaoModel->id,
                    'alternativa_correta_id' => $idAlternativaCorreta,
                    'descricao' => $questao['explicacao']['descricao']
                ]
            );
            $explicacao->save();
        }
    }

    public $avaliacao = [
        'quiz' => [
            'cod_quiz' => ' ',
            'nome' => 'Manejo clínico de paciente com Covid-19 v2',
            'area_tematica' => 'Covid-19',
            'publico_alvo' => 'Profissionais da Saúde',
            'tempo_limite' => 10,
            'descricao' => 'Nesta avaliação, você testará os seus conhecimentos sobre os protocolos de atendimento a pacientes sob suspeita ou acometidos de infecção pelo coronavírus SARS-CoV-2.'
        ],
        'questoes' => [
            [
                'questao' => 'Paciente 56 anos, procura a Unidade de Pronto Atendimento com quadro de febre, tosse seca persistente, iniciado há 8 dias. Desde ontem passou a apresentar dispneia. No momento da consulta encontra-se orientado, normotenso, mas, com frequência respiratória de 28mrm e saturação de O&#8322=88%. Não há tomografia disponível na Unidade. Realizou teste rápido de antígeno que foi positivo (infecção pelo SARS-CoV-2). Qual a melhor conduta nesse contexto clínico?',
                'url_imagem' => '',
                'alternativas' => [
                    ['alternativa' => 'Iniciar hidroxicloroquina e conduzir ambulatorialmente', 'pontuacao' => 0],
                    ['alternativa' => 'Internar e administrar dexametasona por via endovenosa.', 'pontuacao' => 100],
                    ['alternativa' => 'Internar se marcadores laboratoriais estiverem alterados.', 'pontuacao' => 0],
                    ['alternativa' => 'Manter acompanhamento domiciliar e iniciar heparina.', 'pontuacao' => 0],
                ],
                'explicacao' => [
                    'alternativa' => 1,
                    'descricao' => '<iframe width="100%" height="311" src="https://sus.ce.gov.br/isus/wp-content/uploads/sites/5/2021/08/01_B_Ok.mp4" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <p>Paciente com indicação de internação hospitalar sobretudo pela baixa oxigenação (SaO2 menor ou igual a 92%). Nesse caso, outro critério poderia ser a tomografia de alta resolução de tórax com mais de 50% de acometimento, com o padrão típico para a Covid 19, mas, lembramos que os critérios de internação atuais devem servir de guia para o profissional e a decisão deve se basear em outras condições como vulnerabilidade social, instabilidade hemodinâmica etc. O uso de corticóide em pacientes internados com hipóxia (como é o caso do  “nosso” paciente) está embasado pela literatura, sobretudo a partir do estudo RECOVERY, publicado em 2021 que demonstrou redução da mortalidade com uso de dexametasona 6 mg em pacientes no condição supra descrita.</p>'
                ]
            ],
            [
                'questao' => 'Paciente de 38 anos, sexo masculino, diabético, está internado na UPA com quadro de Síndrome Respiratória Aguda Grave por Covid-19. Apresenta febre persistente por mais de 48h, linfopenia, elevação de LDH e PCR e saturação de O2=87%. Nesse caso, qual destes itens melhor justifica o tratamento com corticosteróides?',
                'url_imagem' => '',
                'alternativas' => [
                    ['alternativa' => 'Elevação de LDH e PCR e linfopenia.', 'pontuacao' => 0],
                    ['alternativa' => 'Febre alta persistente por mais de 48h.', 'pontuacao' => 0],
                    ['alternativa' => 'Hipoxemia com necessidade de O2.', 'pontuacao' => 100],
                    ['alternativa' => 'Presença de comorbidade de risco.', 'pontuacao' => 0],
                ],
                'explicacao' => [
                    'alternativa' => 2,
                    'descricao' =>'<iframe width="100%" height="311" src="https://sus.ce.gov.br/isus/wp-content/uploads/sites/5/2021/08/VID_02.mp4" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen ></iframe>
                    <p>Tendo em vista o quadro de hiperinflamação responsável pela maioria das complicações em pacientes com Covid-19, vários imunomoduladores têm sido testados com a finalidade de modificar desfechos sobretudo em pacientes internados. O uso amplo de corticoides em outras condições semelhantes e sua conhecida ação anti-inflamatória ensejaram a realização de uma série de estudos na tentativa de identificar redução de mortalidade ou da necessidade de uso de ventilação mecânica em pacientes infectados por SARS-CoV-2, caso do RECOVERY que concluiu que uso de dexametasona na dose de 6 mg melhoraria o prognóstico em pacientes internados por Covid-19, sobretudo no grupo com necessidade de oxigenoterapia , sendo essa a principal indicação do uso desse fármaco.</p>'
                ]
            ],
            [
                'questao' => 'Durante uma consulta em Posto de Saúde, um paciente com sintomas leves de Covid-19, iniciados há três dias, questiona ao médico sobre quando os filhos, que moram com ele e estão assintomáticos, podem sair da quarentena. Qual seria a melhor resposta para essa questão?',
                'url_imagem' => '',
                'alternativas' => [
                    ['alternativa' => 'Imediatamente, se realizarem sorologia e esta for negativa.', 'pontuacao' => 0],
                    ['alternativa' => 'Após cinco dias do último contato com teste de antígeno negativo.', 'pontuacao' => 0],
                    ['alternativa' => 'Imediatamente, já que o paciente encontra-se com sintomas leves. ', 'pontuacao' => 0],
                    ['alternativa' => 'Após 14 dias do último contato direto com o paciente.', 'pontuacao' => 100],
                ],
                'explicacao' => [
                    'alternativa' => 3,
                    'descricao' => '<iframe width="100%" height="311" src="https://sus.ce.gov.br/isus/wp-content/uploads/sites/5/2021/08/VID_03.mp4" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen ></iframe>
                    <p>As orientações atuais do CDC e do protocolo estadual de manejo clínico para Covid-19, preconizam quarentena de quatorze dias para contactantes diretos de pacientes acometidos por esta enfermidade. O período justifica-se pelo tempo de incubação da doença. Uma outra opção para término de quarentena nesta situação seria a realização de RT- PCR por swab entre o 7-10 dia do contato se esse for não detectável (essa última recomendação com menor evidência em relação ao prazo de 14 dias, mas, com razoável segurança).</p>'
                ]
            ],
            [
                'questao' => 'Paciente, 67 anos, encontra-se com tosse seca, febre e adinamia há 7 dias. Procurou emergência hoje por conta do aparecimento de desconforto respiratório. A saturação se encontra em 94-95% e a frequência respiratória está em 24 mrm. O paciente aguarda resultado de RT-PCR para COVID -19. O médico então resolve solicitar tomografia de tórax de alta resolução. Qual o achado tomográfico mais provável no caso acima que aumentaria a suspeição de Covid-19?',
                'url_imagem' => '',
                'alternativas' => [
                    ['alternativa' => 'Consolidações bilaterais periféricas.', 'pontuacao' => 0],
                    ['alternativa' => 'Perfusão em mosaico bilateral difusa.', 'pontuacao' => 0],
                    ['alternativa' => 'Opacidades em vidro fosco bilaterais.', 'pontuacao' => 100],
                    ['alternativa' => 'Espessamento septal em áreas centrais.', 'pontuacao' => 0],
                ],
                'explicacao' => [
                    'alternativa' => 2,
                    'descricao' => '<iframe width="100%" height="311" src="https://sus.ce.gov.br/isus/wp-content/uploads/sites/5/2021/08/VID_04.mp4" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen ></iframe>
                    <p>A tomografia de tórax de alta resolução tem se constituído em ferramenta importante para o diagnóstico, estratificação e critério de internamento para o paciente com Covid-19. O padrão de vidro fosco bilateral e periférico somado ao quadro clínico semelhante tem sensibilidade em torno de 97% para o diagnóstico de infecção pelo SARS-CoV 2. Em situações onde há presença de desconforto respiratório ou demora nos resultados de RT PCR, a TCAR pode ser de valiosa ajuda na suspeição diagnóstica de Covid-19.</p>'
                ]
            ],
            [
                'questao' => '<p>Homem de 46 anos foi admitido na emergência com quadro de tosse e dispneia há 4 dias. Tem diagnóstico confirmado de COVID-19 com início dos sintomas há 13 dias. Ao exame achava-se com SpO2 de 84% em ar ambiente, evoluindo para 90% com máscara de reservatório 10l/min.</p> <p>Sua gasometria arterial evidenciava: </p> <p>pH: 7.45</p> <p>PaCO2: 33</p> <p>HCO3: 22</p> <p>BE: 0</p> <p>PaO2: 56</p> <p>SaO2: 90</p> <p>A frequência respiratória era de 28 irpm sem uso de musculatura acessória. A TC mostrava opacidades bilaterais e basais compatíveis com pneumonia viral. Qual das opções de suporte ventilatório abaixo é a mais recomendável de imediato?</p>',
                'url_imagem' => '',
                'alternativas' => [
                    ['alternativa' => 'Aumentar o fluxo de O2 na máscara de reservatório.', 'pontuacao' => 0],
                    ['alternativa' => 'Adotar posição prona em respiração espontânea.', 'pontuacao' => 0],
                    ['alternativa' => 'Aplicar CPAP com Capacete Elmo', 'pontuacao' => 100],
                    ['alternativa' => 'Proceder intubação traqueal eletiva', 'pontuacao' => 0],
                ],
                'explicacao' => [
                    'alternativa' => 2,
                    'descricao' => '<iframe width="100%" height="311" src="https://sus.ce.gov.br/isus/wp-content/uploads/sites/5/2021/08/VID_05.mp4" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen ></iframe>
                    <p>Trata-se de paciente com insuficiência respiratória hipoxêmica grave com necessidade de escalonamento da oxigenoterapia. Nesses casos, a aplicação de CPAP por dispositivo tipo capacete tem se mostrado factível e associada a boa resposta clínica e gasométrica e pode ser um passo a ser dado na prevenção da IOT.</p>
                    <p><strong>Link complementar</strong>: <a href="https://sus.ce.gov.br/elmo/">https://sus.ce.gov.br/elmo/</a></p>'
                ]
            ],
        ],
    ];
}
