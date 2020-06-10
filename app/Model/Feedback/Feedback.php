<?php

namespace App\Model\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
}
