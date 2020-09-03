<?php

namespace App\Model\AlertaDeEpi;

use App\Model\EnviavelPorEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AlertaDeEpi implements EnviavelPorEmail
{
    public $descricao = '';
    public $unidadeDeSaude = '';
    public $email = '';

    public function __construct(Request $request)
    {
        $dados = $request->all();
        $this->descricao = $dados['descricao'];
        $this->unidadeDeSaude = $dados['unidadeDeSaude'];
        $this->email = $dados['email'];
    }

    public function valido()
    {
        return !$this->validar()->fails();
    }

    public function erros()
    {
        return $this->validar()->errors();
    }

    public function enviarEmail()
    {
        $alertaDeEpi = (array) $this;
        \Mail::send('email.alertaDeEpi', ['dados' => $alertaDeEpi], function ($mensagem) use ($alertaDeEpi) {
            $mensagem->from(env('MAIL_USERNAME'), $alertaDeEpi['email'])
            ->to('feedback.isus@esp.ce.gov.br')
            ->subject('ISUS APP - ALERTA DE EPI - ' . $alertaDeEpi['unidadeDeSaude'] . '. ' . date('d/m/Y H:i:s'));
        });
    }

    protected function validar()
    {
        $alertaDeEpi = (array) $this;

        return Validator::make($alertaDeEpi, [
            'descricao' => 'required',
            'unidadeDeSaude' => 'required',
        ]);
    }
}
