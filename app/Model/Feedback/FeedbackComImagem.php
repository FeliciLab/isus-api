<?php

namespace App\Model\Feedback;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FeedbackComImagem extends Feedback
{
    public $imagem = [];

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $dados = $request->all();
        $this->imagem = $dados['imagem'];
    }

    public function enviarEmail()
    {
        $feedback = (array) $this;
        \Mail::send('email.feedback', ['dados' => (array) $feedback], function ($message) use ($feedback) {
            $message->from(env('MAIL_USERNAME'), $feedback['email'])
            ->to('feedback.isus@esp.ce.gov.br')
            ->subject('ISUS APP - FEEDBACK. ' . date('d/m/Y H:i:s'))
            ->attachData(base64_decode($this->imagem['dados']), $this->imagem['nome'], ['mime' => $this->imagem['tipo']]);
        });
    }

    protected function validar()
    {
        $is_base64 = function ($attribute, $value, $fail) {
            if (base64_encode(base64_decode($value, false)) !== $value) {
                $fail($attribute . ' não é uma imagem válida');
            }
        };

        return Validator::make(
            (array) $this,
            [
            'email' => 'required',
            'tipoDeFeedback' => 'required',
            'texto' => 'required',
            'versaoAplicativo' => 'required',
            'plataforma' => 'required',
            'imagem.nome' => 'required',
            'imagem.dados' => ['required', $is_base64],
            'imagem.tamanho' => 'required|integer|max:2000000',
            'imagem.tipo' => 'required|endswith:jpeg,png,jpg',
        ],
            [
            'imagem.tamanho.max' => 'A imagem não pode ser maior que 2 MB',
            'imagem.tipo.endswith' => 'A imagem deve ser no formato .jpeg, .jpg ou .png',
        ]
        );
    }
}
