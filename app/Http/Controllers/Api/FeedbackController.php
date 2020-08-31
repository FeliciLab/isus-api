<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Feedback\Feedback;
use App\Model\Feedback\FeedbackComImagem;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function enviarEmail(Request $request)
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

        $feedback->enviarEmail();

        return response()->json([ 'success' => true ]);
    }
}
