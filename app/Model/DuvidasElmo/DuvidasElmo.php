<?php

namespace App\Model\DuvidasElmo;

use App\Model\EnviavelPorEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DuvidasElmo implements EnviavelPorEmail
{
    public $duvida = '';
    public $email = '';
    public $versaoAplicativo = '';
    public $plataforma = '';

    public function __construct(Request $request)
    {
        $dados = $request->all();
        $this->duvida = $dados['duvida'];
        $this->email = $dados['email'];
        $this->versaoAplicativo = $dados['versaoAplicativo'];
        $this->plataforma = $dados['plataforma'];
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
        $duvidasElmo = (array) $this;
        \Mail::send('email.duvidasElmo', ['dados' => $duvidasElmo], function ($mensagem) use ($duvidasElmo) {
            $mensagem->from(env('MAIL_USERNAME'), $duvidasElmo['email'])
            ->to('feedback.isus@esp.ce.gov.br')
            ->subject('ISUS APP - DÚVIDAS SOBRE O ELMO - ' . date('d/m/Y H:i:s'));
        });
    }

    protected function validar()
    {
        $duvidasElmo = (array) $this;

        return Validator::make($duvidasElmo, [
            'duvida' => 'required',
            'email' => 'required',
            'versaoAplicativo' => 'required',
            'plataforma' => 'required',
        ]);
    }
}
