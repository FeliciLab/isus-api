<?php

namespace App\Model\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mail;

class Feedback
{
    public $email = "";
    public $categoria = "";
    public $texto = "";

    function __construct(Request $request)
    {
        $dados = $request->all();
        $this->email = $dados['email'];
        $this->categoria = $dados['categoria'];
        $this->texto = $dados['texto'];
    }

    public function valido() {
        return !$this->validar()->fails();
    }

    public function erros() {
        return $this->validar()->errors();
    }

    protected function validar()
    {
        $feedback = (array) $this;
        return Validator::make($feedback, [
            'email' => 'required',
            'categoria' => 'required',
            'texto' => 'required',
        ]);
    }

    public function enviarEmail()
    {
        $feedback = (array) $this;
        \Mail::send('email.feedback', array('dados' => $feedback), function ($mensagem) use ($feedback) {
            $mensagem->from($feedback['email'])
            ->to('feedback.isus@esp.ce.gov.br')
            ->subject('ISUS APP - FEEDBACK. ' . date('d/m/Y H:i:s'));
        });
    }
}
