<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Domains\QualiQuiz\Models\Quiz;
use App\Domains\QualiQuiz\Models\Questao;
use App\Domains\QualiQuiz\Models\QuizQuestao;
use App\Domains\QualiQuiz\Models\AlternativaQuestao;
use App\Domains\QualiQuiz\Models\Explicacao;

class AbordagemInicialPacienteSindromeGripal extends Seeder
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
                'id' => 2
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
            'cod_quiz' => 'AIPSG',
            'nome' => 'Abordagem Inicial do Paciente com Síndrome Gripal',
            'area_tematica' => 'Saúde da Criança',
            'publico_alvo' => 'Enfermeiros (as) e médicos (as) das Unidades de Pronto Atendimento (UPAs) e das Unidades de Atenção Primária à Saúde (UAPS)',
            'tempo_limite' => 10,
            'descricao' => 'Capacidade para manejo inicial da Síndrome Gripal em nível da atenção primária à saúde (APS).'
        ],
        'questoes' => [
            [
                'questao' => '<p>Criança com três anos de idade é levada para Unidade de Pronto Atendimento com história de febre alta de início súbito, acompanhada de coriza, tosse, dor de garganta e mialgia há 24h.</p>
                <p>Nega comorbidades.</p>
                <p>Exame Físico: EGR, eupneico, hidratado.</p>
                <p>PA: 90 x 50 mmHg.</p>
                <p>SatO2: 98%.</p>
                <p>Temperatura axilar: 39oC.</p>
                <p>Leve hiperemia de orofaringe.</p>
                <p>Murmúrio vesicular fisiológico, sem ruídos adventícios.</p>
                <p>FR: 28 irpm.</p>
                <p>Bulhas normofonéticas, sem sopros.</p>
                <p>FC: 110 bpm.</p>
                <p><strong>Além de solicitar teste para Covid-19, qual a abordagem inicial mais adequada para esse paciente?</strong></p>',
                'url_imagem' => '',
                'alternativas' => [
                    ['alternativa' => 'Acompanhamento ambulatorial, prescrever sintomáticos/hidratação e Oseltamivir, orientar sinais de alarme e reavaliar com 24-48h.', 'pontuacao' => 100],
                    ['alternativa' => 'Acompanhamento ambulatorial, prescrever sintomáticos/hidratação e solicitar teste Influenza e iniciar oseltamivir, se exame positivo.', 'pontuacao' => 0],
                    ['alternativa' => 'Prescrever corticoide oral, azitromicina e oseltamivir e indicar internamento hospitalar.', 'pontuacao' => 0],
                    ['alternativa' => 'Prescrever sintomáticos/hidratação, solicitar Rx de tórax e, se alterado, prescrever azitromicina e oseltamivir e indicar internamento.', 'pontuacao' => 0],
                ],
                'explicacao' => [
                    'alternativa' => 0,
                    'descricao' => '<p><em>Trata-se uma criança com quadro de síndrome gripal (*) e, como ela tem fatores de risco para influenza (criança < 5 anos), enquadra-se na classificação do GRUPO B do diagrama de abordagem inicial da síndrome gripal1. Nesse caso, a conduta inicial mais adequada é: fazer acompanhamento ambulatorial, com sintomáticos/hidratação, prescrever Oseltamivir (idealmente iniciar até 48h do início dos sintomas), orientar sinais de alarme e reavaliar em 24-48h.</em></p>
                    <p><em>(*) Síndrome gripal: Indivíduo que apresente febre de início súbito, mesmo que referida, acompanhada de tosse ou dor de garganta e pelo menos um dos seguintes sintomas: cefaleia, mialgia ou artralgia, na ausência de outro diagnóstico específico. Em crianças com menos de 2 anos de idade, considera-se também como caso de síndrome gripal: febre de início súbito (mesmo que referida) e sintomas respiratórios (tosse, coriza e obstrução nasal), na ausência de outro diagnóstico específico.</em></p>
                    <p><em>Referência bibliográfica:</em></p>
                    <p>1 - Diagrama Abordagem Inicial da síndrome gripal. Escola de Saúde Pública do Ceará, 2022.</p>
                    <p>2 - Nota Técnica Oseltamivir. Escola de Saúde Pública do Ceará, 2021.</p>'
                ]
            ],
            [
                'questao' => '<p>Gestante, 31 anos, com 12 semanas de gestação, referindo ter recebido 2 doses de vacina para COVID e vacina para influenza, chega à Unidade de Pronto Atendimento com história de mialgia, coriza, odinofagia e náuseas há 48h.</p>
                <p>Nega comorbidades.</p>
                <p>Exame Físico: EGR, eupneica, desidratada.</p>
                <p>PA: 90 x 60 mmHg.</p>
                <p>SatO2: 98%.</p>
                <p>Temperatura axilar: 37oC.</p>
                <p>Leve hiperemia de orofaringe.</p>
                <p>Murmúrio vesicular fisiológico, sem ruídos adventícios.</p>
                <p>FR: 20 irpm.</p>
                <p>Bulhas normofonéticas, sem sopros.</p>
                <p>FC: 90 bpm.</p>
                <p><strong>Assinale a alternativa correta em relação à suspeita diagnóstica e atendimento inicial da paciente?</strong></p>',
                'url_imagem' => '',
                'alternativas' => [
                    ['alternativa' => 'Como recebeu duas doses de vacina para covid e vacina para influenza, o quadro deve ser devido a um resfriado comum sendo orientado acompanhamento ambulatorial com sintomáticos e hidratação sem necessidade de nenhum teste.', 'pontuacao' => 0],
                    ['alternativa' => 'Acompanhamento ambulatorial, realizar teste para covid-19, prescrever sintomáticos/hidratação e iniciar oseltamivir, orientar sinais de alarme e reavaliar com 24-48h.', 'pontuacao' => 0],
                    ['alternativa' => 'Acompanhamento ambulatorial, realizar teste para covid-19 e influenza, prescrever sintomáticos/hidratação/corticoide oral e iniciar oseltamivir se teste para influenza positivo, orientar sinais de alarme e reavaliar com 24-48h.', 'pontuacao' => 100],
                    ['alternativa' => 'Realizar teste para covid-19 e influenza, iniciar hidratação/antibióticos/oseltamivir e indicar internamento hospitalar por presença de sinais de alarme.', 'pontuacao' => 0],
                ],
                'explicacao' => [
                    'alternativa' => 2,
                    'descricao' =>'<p><em>Trata-se uma gestante com quadro de síndrome gripal e, portanto, com fator de risco para influenza (gestante), além de presença de sinal de alarme (desidratação). Dessa forma, enquadra-se na classificação do GRUPO B do diagrama de abordagem inicial da síndrome gripal<sup>1</sup>.</em></p>
                    <p><em>Nesse caso, a conduta inicial mais adequada é: realizar teste para covid-19, fazer acompanhamento ambulatorial com sintomáticos/hidratação, prescrever Oseltamivir, orientar sinais de alarme e reavaliar em 24-48h.</em></p>
                    <p><em>Referência bibliográfica:</em></p>
                    <p>1 - Diagrama Abordagem Inicial da síndrome gripal. Escola de Saúde Pública do Ceará, 2022.</p>
                    <p>2 - Nota Técnica Oseltamivir. Escola de Saúde Pública do Ceará, 2021.</p>'
                ]
            ],
            [
                'questao' => '<p>Paciente, 37 anos, masculino, motorista de ônibus, sem comorbidades, apresentando há 3 dias tosse seca, dor de garganta, febre, mialgia, coriza e obstrução nasal, procurou a UAPS no seu bairro.</p>
                <p>Foi atendido pelo médico de família e comunidade que verificou temperatura axilar 38ºC, FR 18mpm, SpO2 95%, hiperemia na orofaringe, pulmões limpos.</p>
                <p><strong>Qual a melhor conduta nesse caso?</strong></p>',
                'url_imagem' => '',
                'alternativas' => [
                    ['alternativa' => 'Solicitar teste para Covid e influenza, prescrever sintomáticos/hidratação e Oseltamivir, orientar sinais de alarme e reavaliar com 24-48h no ambulatório.', 'pontuacao' => 0],
                    ['alternativa' => 'Acompanhamento ambulatorial, solicitar teste para Covid, prescrever sintomáticos e hidratação, orientar sobre sinais de alarme e medidas de prevenção de transmissão.', 'pontuacao' => 100],
                    ['alternativa' => 'Solicitar teste para Covid e influenza, considerar RX de tórax, prescrever azitromicina além de sintomáticos/hidratação e orientar medidas de prevenção de transmissão.', 'pontuacao' => 0],
                    ['alternativa' => 'Solicitar teste para Covid, considerar TC de tórax, prescrever azitromicina, corticoide oral e Oseltamivir, além de sintomáticos/hidratação, e reavaliar com 24-48h no ambulatório.', 'pontuacao' => 0],
                ],
                'explicacao' => [
                    'alternativa' => 1,
                    'descricao' => '<p><em>Trata-se de um adulto sem fatores de risco com quadro de síndrome gripal (*)</em>, SRAG ausente e sem disfunção orgânica, atendido em uma UAPS.</p>
                    <p>Considerando o perfil (Grupo A) do paciente, a melhor conduta, segundo Fluxograma elaborado pela ESP (2022), é a que está descrita no item correto B, ou seja, acompanhamento ambulatorial, solicitar teste para Covid, prescrever sintomáticos e hidratação, orientar sobre sinais de alarme e medidas de prevenção de transmissão.</p>
                    <p><em>O item a está incorreto, porque só se deve pedir teste para influenza em pacientes com SRAG presente sem disfunção orgânica (grupo C) ou com disfunção orgânica (grupo D). Além disso, para pacientes do grupo A não se deve prescrever Oseltamivir e nem é necessário reavaliar com 24-48hs.</em></p>
                    <p><em>O item c não está correto, pois em pacientes do grupo A não é recomendado solicitar teste para influenza, nem é necessário solicitar RX de tórax nem uso de antibióticos.</em></p>
                    <p><em>Finalmente, o item d está incorreto porque em pacientes do grupo A não é necessário solicitar</em> TC de tórax, nem prescrever azitromicina, corticoide oral e Oseltamivir e não precisa reavaliar com 24-48hs.</p>
                    <p><em>(*) Síndrome gripal: Indivíduo que apresente febre de início súbito, mesmo que referida, acompanhada de tosse ou dor de garganta e pelo menos um dos seguintes sintomas: cefaleia, mialgia ou artralgia, na ausência de outro diagnóstico específico.</em></p>
                    <p><strong><em>Referências bibliográficas:</em></strong></p>
                    <p>1 - Diagrama Abordagem Inicial da síndrome gripal. Escola de Saúde Pública do Ceará, 2022.</p>
                    <p>2 - Nota Técnica Oseltamivir. Escola de Saúde Pública do Ceará, 2021.</p>
                    <p></p>'
                ]
            ],
            [
                'questao' => '<p>Paciente de 20 anos de idade é encaminhado para Unidade de Pronto Atendimento com história de febre alta de início súbito, acompanhada de tosse, dor de garganta, coriza e mialgia, evoluiu com desconforto respiratório e desidratação.</p>
                <p>Nega asma e outras comorbidades.</p>
                <p>O exame físico revelou:</p>
                <p>EGR, hidratado.</p>
                <p>T.ax.: 38<code>&deg;</code>C.</p>
                <p>PA=120 X 80 mmHg.</p>
                <p>Tiragem subcostal, FR:28irpm, FC=90bpm e SpO: 93%, sem outras alterações.</p>
                <p><strong>Qual o provável diagnóstico e onde deve ser feito o acompanhamento clínico?</strong></p>',
                'url_imagem' => '',
                'alternativas' => [
                    ['alternativa' => 'Síndrome respiratória aguda grave/enfermaria.', 'pontuacao' => 0],
                    ['alternativa' => 'Síndrome gripal/acompanhamento ambulatorial.', 'pontuacao' => 0],
                    ['alternativa' => 'Resfriado comum/acompanhamento ambulatorial.', 'pontuacao' => 100],
                    ['alternativa' => 'Síndrome respiratória aguda grave/unidade de terapia intensiva.', 'pontuacao' => 0],
                ],
                'explicacao' => [
                    'alternativa' => 2,
                    'descricao' => '<p><em>Trata-se de um paciente, previamente hígido, sem comorbidades. O passo inicial para o correto manejo clínico</em> é diferenciar o caso de síndrome gripal (*) e síndrome respiratória aguda grave (**).</p>
                    <p>O referido paciente tem sinais e sintomas compatíveis com síndrome respiratória aguda grave (dispneia, taquipneia, hipoxemia - SpO <94%) e deve ser acompanhado em ambiente hospitalar, especificamente em enfermaria. Caso apresentasse também sinais de disfunção orgânica (choque, insuficiência respiratória ou circulatória, além de disfunção de outros órgãos vitais), o ambiente mais adequado para o acompanhamento seria a unidade de terapia intensiva.</p>
                    <p><em>(*) SÍNDROME GRIPAL -SG</em></p>
                    <p><em>Indivíduo que apresente febre de início súbito, mesmo que referida, acompanhada de tosse ou dor de garganta e pelo menos um dos seguintes sintomas: cefaleia, mialgia ou artralgia, na ausência de outro diagnóstico específico.</em></p>
                    <p><em>Em crianças com menos de 2 anos de idade, considera-se também como caso de síndrome gripal: febre de início súbito (mesmo que referida) e sintomas respiratórios (tosse, coriza e obstrução nasal), na ausência de outro diagnóstico específico.</em></p>
                    <p><em>(**) SÍNDROME RESPIRATÓRIA AGUDA GRAVE – SRAG</em></p>
                    <p><em>Indivíduo de qualquer idade, com síndrome gripal (conforme definição anterior) e que apresente dispneia ou os seguintes sinais de gravidade:</em></p>
                    <p><em>- Saturação de SpO2 < 95% em ar ambiente.</em></p>
                    <p><em>- Sinais de desconforto respiratório ou aumento da frequência respiratória avaliada de acordo com a idade.</em></p>
                    <p><em>- Piora nas condições clínicas de doença de base.</em></p>
                    <p><em>- Hipotensão em relação à pressão arterial habitual do paciente.</em></p>
                    <p><em>Ou Indivíduo de qualquer idade com quadro de insuficiência respiratória aguda, durante período sazonal.</em></p>
                    <p><em>Em crianças: além dos itens anteriores, observar os batimentos de asa de nariz, cianose, tiragem intercostal, desidratação e inapetência.</em></p>
                    <p><em></em></p>
                    <p><strong><em>Referências bibliográficas:</em></strong></p>
                    <p>1 - Diagrama Abordagem Inicial da síndrome gripal. Escola de Saúde Pública do Ceará, 2022.</p>
                    <p>2 - Nota Técnica Oseltamivir. Escola de Saúde Pública do Ceará, 2021.</p>'
                ]
            ],
            [
                'questao' => '<p>Adulto com 56 anos de idade é levado para Unidade de Pronto Atendimento com história de febre iniciada nos últimos 3 dias, acompanhada de coriza, tosse, dor de garganta, apresentou melhora dos sintomas no 5<code>&ordm;</code> dia, mas no sexto dia evoluiu com dificuldade para respirar.</p>
                <p>Nega comorbidades.</p>
                <p>Exame Físico:</p>
                <p>EGR, FR=32 mrm, hidratado.</p>
                <p>PA: 120 x 70 mmHg.</p>
                <p>SatO2: 93%.</p>
                <p>Temperatura axilar: 39oC.</p>
                <p>Leve hiperemia de orofaringe.</p>
                <p><strong>Além de solicitar teste para Covid-19, qual a abordagem inicial mais adequada para esse paciente?</strong></p>',
                'url_imagem' => '',
                'alternativas' => [
                    ['alternativa' => 'Acompanhamento ambulatorial, prescrever sintomáticos/hidratação e Oseltamivir, orientar sinais de alarme e reavaliar com 24-48h.', 'pontuacao' => 0],
                    ['alternativa' => 'Acompanhamento ambulatorial, prescrever sintomáticos/hidratação e solicitar teste Influenza/covid e iniciar corticoide, se exame positivo.', 'pontuacao' => 0],
                    ['alternativa' => 'Prescrever corticoide oral, azitromicina e indicar internamento hospitalar.', 'pontuacao' => 0],
                    ['alternativa' => 'Indicar internamento hospitalar e se covid +, iniciar corticoide se necessidade de oxigênio e prescrever profilaxia para tromboembolismo.', 'pontuacao' => 100],
                ],
                'explicacao' => [
                    'alternativa' => 3,
                    'descricao' => '<p>Trata-se de individuo com possível diagnóstico de covid /influenza evoluindo com SRAG e critérios de internamento (F>30 mrm).</p>
                    <p>O teste para covid deve ser solicitado, o internamento está indicado e o uso de corticoide preconizado se houver necessidade de oxigênio suplementar.</p>
                    <p>Lembrar sempre a, ao internar de iniciar profilaxia para tromboembolismo venoso, salvo na presença de contraindicações.</p>
                    <p><strong><em>Referências bibliográficas:</em></strong></p>
                    <p>1 - Diagrama Abordagem Inicial da síndrome gripal. Escola de Saúde Pública do Ceará, 2022.</p>
                    <p>2 - Nota Técnica Oseltamivir. Escola de Saúde Pública do Ceará, 2021.</p>
                    <p>3 - Protocolo estadual COVID 19 – abril -2021 – SESA-CE</p>'
                ]
            ],
        ],
    ];

}
