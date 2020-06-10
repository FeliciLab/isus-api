<?php

namespace App\Model\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FeedbackComImagem extends Feedback
{
    public $imagem = array();

    function __construct(Request $request)
    {
        $dados = $request->all();
        $this->email = $dados['email'];
        $this->categoria = $dados['categoria'];
        $this->texto = $dados['texto'];
        $this->imagem = $dados['imagem'];
    }

    protected function validar()
    {
        $is_base64 = function ($attribute, $value, $fail) {
            if (base64_encode(base64_decode($value, false)) !== $value){
                $fail($attribute.' não é uma imagem válida');
            }
        };

        return Validator::make((array) $this, [
            'email' => 'required',
            'categoria' => 'required',
            'texto' => 'required',
            'imagem.nome' => 'required',
            'imagem.dados' => ['required', $is_base64],
            'imagem.tamanho' => 'required|integer|max:2000000',
            'imagem.tipo' => 'required|endswith:jpeg,png,jpg'
        ],
        [
            'imagem.tamanho.max' => 'O arquivo não pode ser maior que 2 MB',
            'imagem.tipo.endswith' => 'O arquivo deve ser uma imagem .jpeg, .jpg ou .png'
        ]);
    }
}




