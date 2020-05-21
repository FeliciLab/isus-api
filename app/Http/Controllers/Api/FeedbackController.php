<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Mail;

class FeedbackController extends Controller
{
    public function enviarEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'categoria' => 'required',
            'texto' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        $dados = $request->all();

        \Mail::send('email.feedback', array('dados' => $dados), function ($message) use ($dados) {
            $message->from(env('MAIL_USERNAME'))
                    ->to('feedback.isus@esp.ce.gov.br')
                    ->subject('ISUS APP - FEEDBACK. ' . date('d/m/Y H:i:s'));
        });

        return response()->json([
            'success' => true
        ]);
    }
}
