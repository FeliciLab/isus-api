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
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        $dados = $request->all();
        $imagem = $dados['imagem'];

        if (empty($imagem)) {
            $this->enviarEmail($dados);
        } else {
            $this->enviarEmailComAnexo($dados, $imagem);
        }

        return response()->json([
            'success' => true
        ]);
    }

    private function validarFeedback(Request $request)
    {
        return Validator::make($request->all(), [
            'email' => 'required',
            'categoria' => 'required',
            'texto' => 'required',
            'imagem' => 'present',
            '*.tamanho' => 'integer|max:2000000',
            '*.tipo' => 'endswith:jpeg,png,jpg'
        ], [
            '*.tamanho.max' => 'O arquivo não pode ser maior que 2 MB',
            '*.tipo.endswith' => 'O arquivo deve ser uma imagem .jpeg, .jpg ou .png'
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
