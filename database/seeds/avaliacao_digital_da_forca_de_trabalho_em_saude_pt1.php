<?php

use Illuminate\Database\Seeder;
use App\Domains\QualiQualiz\Models\Quiz;
use App\Domains\QualiQualiz\Models\Questao;

class avaliacao_digital_da_forca_de_trabalho_em_saude_pt1 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $quiz = (new Quiz(['name' => 'AVALIAÇÃO DIGITAL DA FORÇA DE TRABALHO EM SAÚDE']))->save();

        $questao = (new Questao([
            'questao' => 'Em 1986, o morador de um sítio no município “Tempos idos”, sentiu-se mal após o almoço. Sua esposa acompanhou-o até o serviço de saúde, temendo que ele só seria atendido se comprovasse um vínculo formal de emprego. Assim, de posse da carteira profissional do marido, foram em busca da assistência no “Posto” de saúde mais próximo de onde moravam.        A partir de 1988, com a implantação do Sistema Único de Saúde (SUS), a exigência da carteira profissional para a prestação da assistência ao cidadão descumprirá qual princípio do SUS?'
        ]))->save();

        $quizQuestao = (new QuizQuestao([
            'ordem' => 1,
            'quiz_id' => $quiz->id,
            'questao_id' => $questao1->id,
        ]))->save();

        $alternativaQuestao = (new AlternativaQuestao([
            'alternativa',
            'pontuacao' => 100,
            'questao_id',
            'ordem',
        ]))->save();
    }
}
