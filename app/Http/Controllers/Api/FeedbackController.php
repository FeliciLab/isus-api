<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Mail;

class FeedbackController extends Controller
{
    public function emailHandler(Request $request)
    {
        $validator = $this->validarFeedback($request);

        if ($validator->fails()) {
            return $this->enviarMensagemDeErro($validator);
        }

        $dados = $request->all();

        if (key_exists('imagem', $dados)) {
            $imagem = $dados['imagem'];
            $validator = $this->validarImagem($request);

            if ($validator->fails()) {
                return $this->enviarMensagemDeErro($validator);
            }

            $this->enviarEmailComAnexo($dados, $imagem);
        } else {
            $this->enviarEmail($dados);
        }

        return $this->enviarMensagemDeSucesso();
    }

    private function enviarMensagemDeSucesso()
    {
        return response()->json([ 'success' => true ]);
    }

    private function enviarMensagemDeErro($validator)
    {
        return response()->json([ 'success' => false, 'errors' => $validator->errors() ]);
    }

    private function validarImagem($request)
    {
        $is_base64 = function ($attribute, $value, $fail) {
            if (base64_encode(base64_decode($value, false)) !== $value){
                $fail($attribute.' não é uma imagem válida');
            }
        };

        return Validator::make($request->all(), [
            'imagem.nome' => 'required',
            'imagem.dados' => ['required', $is_base64],
            'imagem.tamanho' => 'required|integer|max:2000000',
            'imagem.tipo' => 'required|endswith:jpeg,png,jpg'
        ], [
            'imagem.tamanho.max' => 'O arquivo não pode ser maior que 2 MB',
            'imagem.tipo.endswith' => 'O arquivo deve ser uma imagem .jpeg, .jpg ou .png'
        ]);
    }

    private function validarFeedback(Request $request)
    {
        return Validator::make($request->all(), [
            'email' => 'required',
            'categoria' => 'required',
            'texto' => 'required',
        ]);
    }

    private function enviarEmail($dados)
    {
        \Mail::send('email.feedback', array('dados' => $dados), function ($message) use ($dados) {
            $message->from(env('MAIL_USERNAME'))
            ->to('feedback.isus@esp.ce.gov.br')
            ->subject('ISUS APP - FEEDBACK. ' . date('d/m/Y H:i:s'));
        });
    }

    private function enviarEmailComAnexo($dados, $imagem)
    {
        \Mail::send('email.feedback', array('dados' => $dados), function ($message) use ($dados, $imagem) {
            $message->from(env('MAIL_USERNAME'))
            ->to('feedback.isus@esp.ce.gov.br')
            ->subject('ISUS APP - FEEDBACK. ' . date('d/m/Y H:i:s'))
            ->attachData(base64_decode($imagem['dados']), $imagem['nome'], ['mime' => $imagem['tipo']]);
        });
    }
}
