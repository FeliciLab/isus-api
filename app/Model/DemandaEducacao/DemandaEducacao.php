<?php

namespace App\Model\DemandaEducacao;

use App\Model\EnviavelPorEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DemandaEducacao implements EnviavelPorEmail
{
    public $descricao = '';
    public $unidadeDeSaude = '';
    public $email = '';
    public $versaoAplicativo = '';
    public $plataforma = '';

    public function __construct(Request $request)
    {
        $dados = $request->all();
        $this->descricao = $dados['descricao'];
        $this->unidadeDeSaude = $dados['unidadeDeSaude'];
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
        $demandaEducacao = (array) $this;
        \Mail::send('email.demandaEducacao', ['dados' => $demandaEducacao], function ($mensagem) use ($demandaEducacao) {
            $mensagem->from(env('MAIL_USERNAME'), $demandaEducacao['email'])
                ->to('feedback.isus@esp.ce.gov.br')
                ->subject('ISUS APP - DEMANDA POR EDUCAÇÃO PERMANENTE - ' . $demandaEducacao['unidadeDeSaude'] . '. ' . date('d/m/Y H:i:s'));
        });
    }

    protected function validar()
    {
        $demandaEducacao = (array) $this;

        return Validator::make($demandaEducacao, [
            'descricao' => 'required',
            'unidadeDeSaude' => 'required',
            'versaoAplicativo' => 'required',
            'plataforma' => 'required',
        ]);
    }
}
