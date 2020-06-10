<?php

namespace App\Http\Controllers\Api;

use App\Model\Feedback\FeedbackComImagem;
use App\Http\Controllers\Controller;
use App\Model\Feedback\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Mail;

class FeedbackController extends Controller
{
    public function emailHandler(Request $request)
    {
        $feedback = "";
        if (key_exists('imagem', $request->all())) {
            $feedback = new FeedbackComImagem($request);
        } else {
            $feedback = new Feedback($request);
        }

        if (!$feedback->valido()) {
            return response()->json([ 'success' => false, 'errors' => $feedback->erros()]);
        }

        if ($feedback instanceof FeedbackComImagem) {
            $this->enviarEmailComAnexo($feedback);
        } else {
            $this->enviarEmail($feedback);
        }

        return response()->json([ 'success' => true ]);
    }

    private function enviarEmail(Feedback $feedback)
    {
        \Mail::send('email.feedback', array('dados' => (array) $feedback), function ($message) use ($feedback) {
            $message->from('matheus.bernardes@thoughtworks.com')
            ->to('feedback.isus@esp.ce.gov.br')
            ->subject('ISUS APP - FEEDBACK. ' . date('d/m/Y H:i:s'));
        });
    }

    private function enviarEmailComAnexo(FeedbackComImagem $feedback)
    {
        \Mail::send('email.feedback', array('dados' => (array) $feedback), function ($message) use ($feedback) {
            $message->from('matheus.bernardes@thoughtworks.com')
            ->to('feedback.isus@esp.ce.gov.br')
            ->subject('ISUS APP - FEEDBACK. ' . date('d/m/Y H:i:s'))
            ->attachData(base64_decode($feedback->imagem['dados']), $feedback->imagem['nome'], ['mime' => $feedback->imagem['tipo']]);
        });
    }
}
