<?php

use Illuminate\Database\Seeder;
use App\Domains\QualiQuiz\Models\Quiz;
use App\Domains\QualiQuiz\Models\Questao;
use App\Domains\QualiQuiz\Models\QuizQuestao;
use App\Domains\QualiQuiz\Models\AlternativaQuestao;
use App\Domains\QualiQuiz\Models\Explicacao;

class AvaliacaoDigitalDaForcaDeTrabalhoEmSaudePt1 extends Seeder
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
                'explicacao' => [
                    'alternativa' => 2,
                    'descricao' => '<p>A op&ccedil;&atilde;o C Universalidade est&aacute; correta, em primeiro lugar, com base no que cita o artigo 196 da Constitui&ccedil;&atilde;o Brasileira 1988 : <strong>A sa&uacute;de &eacute; direito de todos e dever do Estado</strong>, garantido mediante pol&iacute;ticas sociais e econ&ocirc;micas que visem &agrave; redu&ccedil;&atilde;o do risco de doen&ccedil;a e de outros agravos e ao acesso universal e igualit&aacute;rio &agrave;s a&ccedil;&otilde;es e servi&ccedil;os para sua promo&ccedil;&atilde;o, prote&ccedil;&atilde;o e recupera&ccedil;&atilde;o.</p>
                    <p>E tamb&eacute;m pela Lei Org&acirc;nica da Sa&uacute;de n.8080/1990 que cita nos:</p>
                    <p style="margin-left: 20px;">&nbsp;&sect; 1&ordm; do artigo 2&ordm;: O dever do Estado de garantir a sa&uacute;de consiste na formula&ccedil;&atilde;o e execu&ccedil;&atilde;o de pol&iacute;ticas econ&ocirc;micas e sociais que visem &agrave; redu&ccedil;&atilde;o de riscos de doen&ccedil;as e de outros agravos e no estabelecimento de condi&ccedil;&otilde;es que assegurem acesso universal e igualit&aacute;rio &agrave;s a&ccedil;&otilde;es e aos servi&ccedil;os para a sua promo&ccedil;&atilde;o, prote&ccedil;&atilde;o e recupera&ccedil;&atilde;o.</p>
                    <p style="margin-left: 20px;">- Artigo 7&ordm; sobre os princ&iacute;pios e diretrizes do SUS:</p>
                    <p><strong>I - universalidade de acesso aos servi&ccedil;os de sa&uacute;de em todos os n&iacute;veis de assist&ecirc;ncia.</strong></p>
                    <p>Distrator a) n&atilde;o &eacute; a correta pois, segundo a Lei Org&acirc;nica da Sa&uacute;de n.8080/1990 &eacute; um princ&iacute;pios do SUS mas n&atilde;o se aplica a quest&atilde;o, pois tem o seguinte significado: <strong>integralidade de assist&ecirc;ncia</strong>, entendida como conjunto articulado e cont&iacute;nuo das a&ccedil;&otilde;es e servi&ccedil;os preventivos e curativos, individuais e coletivos, exigidos para cada caso em todos os n&iacute;veis de complexidade do sistema (II Princ&iacute;pio).</p>
                    <p>Distrator b) <strong>Equidade- </strong>n&atilde;o &eacute; a correta pois n&atilde;o &eacute; um princ&iacute;pio do SUS e sim um princ&iacute;pio da Aten&ccedil;&atilde;o B&aacute;sica definido no Anexo da Portaria n. 2436/2017 das Disposi&ccedil;&otilde;es Gerais da Aten&ccedil;&atilde;o B&aacute;sica.</p>
                    <p>Distrator d) <strong>Igualdade-</strong> n&atilde;o &eacute; a correta pois, segundo a Lei Org&acirc;nica da Sa&uacute;de n.8080/1990 &eacute; um dos princ&iacute;pios do SUS mas n&atilde;o se aplica ao item acima, pois tem o seguinte significado: igualdade da assist&ecirc;ncia &agrave; sa&uacute;de, sem preconceitos ou privil&eacute;gios de qualquer esp&eacute;cie (IV Princ&iacute;pio)</p>'
                ]
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
                'explicacao' => [
                    'alternativa' => 1,
                    'descricao' => '<p>A op&ccedil;&atilde;o B &eacute; a correta pois a situa&ccedil;&atilde;o se aplica &agrave; descri&ccedil;&atilde;o do II Princ&iacute;pio do SUS: &nbsp;- integralidade de assist&ecirc;ncia, entendida como conjunto articulado e cont&iacute;nuo das a&ccedil;&otilde;es e servi&ccedil;os preventivos e curativos, individuais e coletivos, exigidos para cada caso em todos os n&iacute;veis de complexidade do sistema (Artigo 7&ordm; Lei Org&acirc;nica da Sa&uacute;de n. 8080/1990 que trata sobre os princ&iacute;pios e diretrizes do SUS.</p>
                    <p>Os distratores a), c) e d) - S&atilde;o princ&iacute;pios do SUS mas n&atilde;o se aplicam &agrave; descri&ccedil;&atilde;o da situa&ccedil;&atilde;o do enunciado.</p>'
                ]
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
                'explicacao' => [
                    'alternativa' => 3,
                    'descricao' => '<p>A op&ccedil;&atilde;o D) Equidade est&aacute; correta pois &eacute; um dos princ&iacute;pios da Aten&ccedil;&atilde;o B&aacute;sica expl&iacute;cito no Art. 3&ordm; dos &nbsp;Princ&iacute;pios e Diretrizes do SUS e da RAS a serem operacionalizados na Aten&ccedil;&atilde;o B&aacute;sica editados na Portaria n.2436 de 21/09/2017que Aprova a Pol&iacute;tica Nacional de Aten&ccedil;&atilde;o B&aacute;sica, estabelecendo a revis&atilde;o de diretrizes para a organiza&ccedil;&atilde;o da Aten&ccedil;&atilde;o B&aacute;sica, no &acirc;mbito do Sistema &Uacute;nico de Sa&uacute;de (SUS) e tamb&eacute;m no Anexo dessa Portaria que trata das Disposi&ccedil;&otilde;es Gerais da Aten&ccedil;&atilde;o B&aacute;sica que define Equidade como: ofertar o cuidado, reconhecendo as diferen&ccedil;as nas condi&ccedil;&otilde;es de vida e sa&uacute;de e de acordo com as necessidades das pessoas, considerando que o direito &agrave; sa&uacute;de passa pelas diferencia&ccedil;&otilde;es sociais e deve atender &agrave; diversidade, ficando proibida qualquer exclus&atilde;o baseada em idade, g&ecirc;nero, cor, cren&ccedil;a, nacionalidade, etnia, orienta&ccedil;&atilde;o sexual, identidade de g&ecirc;nero, estado de sa&uacute;de, condi&ccedil;&atilde;o socioecon&ocirc;mica, escolaridade ou limita&ccedil;&atilde;o f&iacute;sica, intelectual, funcional, entre outras, com estrat&eacute;gias que permitam minimizar desigualdades, evitar exclus&atilde;o social de grupos que possam vir a sofrer estigmatiza&ccedil;&atilde;o ou discrimina&ccedil;&atilde;o; de maneira que impacte na autonomia e na situa&ccedil;&atilde;o de sa&uacute;de.<br><br>Os distratores a) e c) - embora sejam princ&iacute;pios da Aten&ccedil;&atilde;o B&aacute;sica, n&atilde;o est&atilde;o corretos pois segundo o Anexo que trata das Disposi&ccedil;&otilde;es Gerais da Aten&ccedil;&atilde;o B&aacute;sica (Pt. n.2436 de 21/09/2017) a defini&ccedil;&atilde;o que o documento traz sobre estes dois princ&iacute;pios, n&atilde;o se aplica ao contexto da quest&atilde;o.</p>
                    <ul>
                        <li>Integralidade: &Eacute; o conjunto de servi&ccedil;os executados pela equipe de sa&uacute;de que atendam &agrave;s necessidades da popula&ccedil;&atilde;o adscrita nos campos do cuidado, da promo&ccedil;&atilde;o e manuten&ccedil;&atilde;o da sa&uacute;de, da preven&ccedil;&atilde;o de doen&ccedil;as e agravos, da cura, da reabilita&ccedil;&atilde;o, redu&ccedil;&atilde;o de danos e dos cuidados paliativos. Inclui a responsabiliza&ccedil;&atilde;o pela oferta de servi&ccedil;os em outros pontos de aten&ccedil;&atilde;o &agrave; sa&uacute;de e o reconhecimento adequado das necessidades biol&oacute;gicas, psicol&oacute;gicas, ambientais e sociais causadoras das doen&ccedil;as, e manejo das diversas tecnologias de cuidado e de gest&atilde;o necess&aacute;rias a estes fins, al&eacute;m da amplia&ccedil;&atilde;o da autonomia das pessoas e coletividade.<br><br><br></li>
                        <li>Universalidade: possibilitar o acesso universal e cont&iacute;nuo a servi&ccedil;os de sa&uacute;de de qualidade e resolutivos, caracterizados como a porta de entrada aberta e preferencial da RAS (primeiro contato), acolhendo as pessoas e promovendo a vincula&ccedil;&atilde;o e corresponsabiliza&ccedil;&atilde;o pela aten&ccedil;&atilde;o &agrave;s suas necessidades de sa&uacute;de. O estabelecimento de mecanismos que assegurem acessibilidade e acolhimento pressup&otilde;e uma l&oacute;gica de organiza&ccedil;&atilde;o e funcionamento do servi&ccedil;o de sa&uacute;de que parte do princ&iacute;pio de que as equipes que atuam na Aten&ccedil;&atilde;o B&aacute;sica nas UBS devem receber e ouvir todas as pessoas que procuram seus servi&ccedil;os, de modo universal, de f&aacute;cil acesso e sem diferencia&ccedil;&otilde;es excludentes, e a partir da&iacute; construir respostas para suas demandas e necessidades.<br><br><br></li>
                    </ul>
                    <p>O distrator b) Igualdade &eacute; princ&iacute;pio do SUS mas n&atilde;o &eacute; princ&iacute;pio da Aten&ccedil;&atilde;o B&aacute;sica. Os princ&iacute;pios da Aten&ccedil;&atilde;o B&aacute;sica s&atilde;o: Universalidade; Equidade e Integralidade.</p>'
                ]
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
                'explicacao' => [
                    'alternativa' => 1,
                    'descricao' => '<p>A op&ccedil;&atilde;o b) est&aacute; correta, pois as a&ccedil;&otilde;es de sa&uacute;de na Aten&ccedil;&atilde;o B&aacute;sica devem ser individuais, familiares e coletivas segundo a Portaria n. 2.436/2017no seu Art. 2&ordm;. A Aten&ccedil;&atilde;o B&aacute;sica que define como o conjunto de a&ccedil;&otilde;es de sa&uacute;de individuais, familiares e coletivas.<br><br>O distrator a) est&aacute; incorreto, porque as a&ccedil;&otilde;es da Aten&ccedil;&atilde;o B&aacute;sica, segundo a mesma Portaria deve envolver promo&ccedil;&atilde;o, preven&ccedil;&atilde;o, prote&ccedil;&atilde;o, diagn&oacute;stico, tratamento, reabilita&ccedil;&atilde;o, redu&ccedil;&atilde;o de danos, cuidados paliativos e vigil&acirc;ncia em sa&uacute;de, desenvolvida por meio de pr&aacute;ticas de cuidado integrado e gest&atilde;o qualificada, realizada com equipe multiprofissional e dirigida &agrave; popula&ccedil;&atilde;o em territ&oacute;rio definido, sobre as quais as equipes assumem responsabilidade sanit&aacute;ria.</p>
                    <p>O distrator c) est&aacute; incorreto, porque as pr&aacute;ticas de cuidados individuais em Policl&iacute;nicas est&atilde;o relacionadas &agrave; Aten&ccedil;&atilde;o Secund&aacute;ria.<br><br>O distrator d) est&aacute; incorreto, porque segundo a mesma Portaria as a&ccedil;&otilde;es de Aten&ccedil;&atilde;o tamb&eacute;m envolvem a Vigil&acirc;ncia em Sa&uacute;de.</p>'
                ]
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
                'explicacao' => [
                    'alternativa' => 0,
                    'descricao' => '<p>A Op&ccedil;&atilde;o a) est&aacute; correta pois segundo (Mendes, 2009, p. 57-58) apud Sa&uacute;de Soc. S&atilde;o Paulo, v.20, n.4, p.867-874, 2011 p.869, a coordena&ccedil;&atilde;o implica na capacidade de garantir a continuidade da aten&ccedil;&atilde;o, atrav&eacute;s da equipe de sa&uacute;de, com o reconhecimento dos problemas que requerem seguimento constante.<br><br>Enquanto que pela mesma refer&ecirc;ncia os demais atributos tem este significado:</p>
                    <p>Distrator b): O primeiro contacto implica a acessibilidade e o uso do servi&ccedil;o para cada novo problema ou novo epis&oacute;dio de um problema para os quais se procura o cuidado.<br><br>Distrator c) A longitudinalidade requer a exist&ecirc;ncia do aporte regular de cuidados pela equipe de sa&uacute;de e seu uso consistente ao longo do tempo, num ambiente de rela&ccedil;&atilde;o colaborativa e humanizada entre equipe, pessoa usu&aacute;ria e fam&iacute;lia.</p>
                    <p>Distrator d) A integralidade sup&otilde;e a presta&ccedil;&atilde;o, pela equipe de sa&uacute;de, de um conjunto de servi&ccedil;os que atendam &agrave;s necessidades mais comuns da popula&ccedil;&atilde;o adscrita, a responsabiliza&ccedil;&atilde;o pela oferta de servi&ccedil;os em outros pontos de aten&ccedil;&atilde;o &agrave; sa&uacute;de e o reconhecimento adequado dos problemas biol&oacute;gicos, psicol&oacute;gicos e sociais que causam as doen&ccedil;as.</p>'
                ]
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
                'explicacao' => [
                    'alternativa' => 0,
                    'descricao' => '<p>A Op&ccedil;&atilde;o a) est&aacute; correta pois a descri&ccedil;&atilde;o do enunciado corresponde a Vigil&acirc;ncia Epidemiol&oacute;gica segundo ao artigo o 6&ordm;, &sect; 2&ordm; da Lei Org&acirc;nica da Sa&uacute;de.</p>
                    <p>O distrator b) N&atilde;o &eacute; correto pois, o artigo Imunidade Contra o C&acirc;ncer &nbsp;www.passeiodireto.com), descreve o conceito de vigil&acirc;ncia imunol&oacute;gica como uma fun&ccedil;&atilde;o fisiol&oacute;gica do sistema imune de reconhecer e destruir clones de c&eacute;lulas transformadas antes que elas se transformem em tumores, e destruir tumores j&aacute; depois de formados.</p>
                    <p>O distrator c) N&atilde;o &eacute; correto pois, nem existe este termo o que existe &eacute; a vigil&acirc;ncia sanit&aacute;ria nas comunidades terap&ecirc;uticas.</p>
                    <p>O distrator d) &nbsp;N&atilde;o &eacute; correto pois o &sect; 1&ordm; do artigo 6&ordm; &nbsp;da Lei Org&acirc;nica da Sa&uacute;de afirma: &ldquo;entende-se por vigil&acirc;ncia sanit&aacute;ria um conjunto de a&ccedil;&otilde;es capaz de eliminar, diminuir ou prevenir riscos &agrave; sa&uacute;de e de intervir nos problemas sanit&aacute;rios decorrentes do meio ambiente, da produ&ccedil;&atilde;o e circula&ccedil;&atilde;o de bens e da presta&ccedil;&atilde;o de servi&ccedil;os de interesse da sa&uacute;de&rdquo;.</p>'
                ]
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
                'explicacao' => [
                    'alternativa' => 0,
                    'descricao' => '<p>A op&ccedil;&atilde;o a) est&aacute; correta, como consta na Cartilha da PNH: Cl&iacute;nica Ampliada, Equipe de Refer&ecirc;ncia e Projeto Terap&ecirc;utico Singular &ndash; Caso3 (http://bvsms.saude.gov.br/bvs/publicacoes/clinica_ampliada_compartilhada.pdf)</p>
                    <p>A cl&iacute;nica ampliada &eacute; uma das diretrizes que a Pol&iacute;tica Nacional de Humaniza&ccedil;&atilde;o prop&otilde;e para qualificar o modo de se fazer sa&uacute;de. Ampliar a cl&iacute;nica &eacute; aumentar a autonomia do usu&aacute;rio do servi&ccedil;o de sa&uacute;de, da fam&iacute;lia e da comunidade (BVS- MS Dicas em Sa&uacute;de).</p>
                    <p>O distrator b) n&atilde;o est&aacute; correto pois, consulta compartilhada &eacute; um instrumento de trabalho, podendo ser considerada como um arranjo que privilegie uma &ldquo;comunica&ccedil;&atilde;o transversal na equipe e entre equipes&rdquo;, com vistas para uma cl&iacute;nica ampliada (dialnet.unirioja.es)</p>
                    <p>O distrator c) n&atilde;o est&aacute; correto pois integra&ccedil;&atilde;o com o Nasf &eacute; de servi&ccedil;o com servi&ccedil;o e n&atilde;o envolve a comunidade.</p>
                    <p>O distrator d) n&atilde;o est&aacute; correto, pois n&atilde;o &eacute; uma diretriz da PNH.</p>'
                ]
            ],
        ],
    ];
}
