<?php

namespace App\Model;

class UserKeycloak
{
    private $enabled = true;
    private $username;
    private $email;
    private $firstName;
    private $lastName;
    private $password;
    private $phone;
    private $cpf;
    private $rg;
    private $estadoId;
    private $estado;
    private $cidadeId;
    private $cidade;
    private $termos = false;
    private $categoriaProfissional;
    private $titulacaoAcademica;
    private $tipoContratacao;
    private $instituicao;

    public function __construct($dados)
    {
        $this->username = $dados['username'];
        $this->email = $dados['email'];
        $this->firstName = $dados['firstName'];
        $this->lastName = $dados['lastName'];
        $this->password = $dados['password'];
        $this->phone = $dados['phone'];
        $this->cpf = $dados['cpf'];
        $this->rg = $dados['rg'];
        $this->estadoId = $dados['estadoId'];
        $this->estado = $dados['estado'];
        $this->cidadeId = $dados['cidadeId'];
        $this->cidade = $dados['cidade'];
        $this->termos = $dados['termos'];
        $this->categoriaProfissional = $dados['categoriaProfissional'];
        $this->titulacaoAcademica = $dados['titulacaoAcademica'];
        $this->tipoContratacao = $dados['tipoContratacao'];
        $this->instituicao = $dados['instituicao'];
    }

    public function toKeycloak()
    {
        return [
            "enabled" => $this->enabled,
            "username" => $this->username,
            "email" => $this->email,
            "firstName" => $this->firstName,
            "lastName" => $this->lastName,
            "credentials" => [
                [
                    "type" => "password",
                    "value" => $this->password,
                    "temporary" => 'false'
                ]
            ],
            "attributes" => [
                "TELEFONE" => $this->phone,
                "CPF" => $this->cpf,
                "RG" => $this->rg,
                "ESTADO_ID" => $this->estadoId,
                "ESTADO" => $this->estado,
                "CIDADE_ID" => $this->cidadeId,
                "CIDADE" => $this->cidade,
                "TERMOS" => $this->termos,
                "CATEGORIA_PROFISSIONAL" => $this->categoriaProfissional,
                "TITULACAO_ACADEMICA" => $this->titulacaoAcademica,
                "TIPO_CONTRATACAO" => $this->tipoContratacao,
                "INSTITUICAO" => $this->instituicao
            ]
        ];
    }
}
