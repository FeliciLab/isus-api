<?php

namespace App\Model;

class UserKeycloak
{
    private $idKeycloak;
    private $enabled = true;
    private $email;
    private $firstName;
    private $lastName;
    private $password;
    private $telefone;
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
    private $unidadeServico;
    private $especialidades;

    public function __construct($dados)
    {
        $nomeCompleto = $dados['nomeCompleto'] ?? null;
        $nome = $this->pegarNome($nomeCompleto);
        $sobrenome = $this->pegarSobrenome($nomeCompleto);

        $this->idKeycloak = $dados['idKeycloak'] ?? null;
        $this->email = $dados['email'] ?? null;
        $this->firstName = $nome ?? null;
        $this->lastName = $sobrenome ?? null;
        $this->password = $dados['senha'] ?? null;
        $this->telefone = $dados['telefone'] ?? null;
        $this->cpf = $dados['cpf'] ?? null;
        $this->rg = $dados['rg'] ?? null;
        $this->estadoId = $dados['estadoId'] ?? null;
        $this->estado = $dados['estado'] ?? null;
        $this->cidadeId = $dados['cidadeId'] ?? null;
        $this->cidade = $dados['cidade'] ?? null;
        $this->termos = $dados['termos'] ?? null;
        $this->categoriaProfissional = $dados['categoriaProfissional'] ?? null;
        $this->titulacaoAcademica = $dados['titulacaoAcademica'] ?? null;
        $this->tipoContratacao = $dados['tipoContratacao'] ?? null;
        $this->instituicao = $dados['instituicao'] ?? null;
        $this->unidadeServico = $dados['unidadeServico'] ?? null;
        $this->especialidades = $dados['especialidades'] ?? null;
    }

    public function getIdKeycloak()
    {
        return $this->idKeycloak;
    }

    public function getName()
    {
        return $this->firstName . ' ' . $this->lastName;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getCidadeId()
    {
        return $this->cidadeId;
    }

    public function getCategoriaProfissionalId()
    {
        if ($this->categoriaProfissional) {
            $categoriaProfissional = json_decode($this->categoriaProfissional);

            return $categoriaProfissional->id;
        }
    }

    public function getUnidadesServicos()
    {
        return json_decode($this->unidadeServico);
    }

    public function getTiposContratacoes()
    {
        return json_decode($this->tipoContratacao);
    }

    public function getTitulacoesAcademicas()
    {
        return json_decode($this->titulacaoAcademica);
    }

    public function getEspecialidades()
    {
        return json_decode($this->especialidades);
    }

    public function toKeycloak($semSenha = false)
    {
        $municipio = Municipio::find($this->cidadeId);
        $estado = $municipio->estado()->first();

        $dadosKeycloak = [
            'enabled' => $this->enabled,
            'email' => $this->email,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'credentials' => [
                [
                    'type' => 'password',
                    'value' => $this->password,
                    'temporary' => false,
                ],
            ],
            'attributes' => [
                'TELEFONE' => $this->telefone,
                'CPF' => $this->cpf,
                'RG' => $this->rg,
                'ESTADO_ID' => $estado->id,
                'ESTADO' => $estado->nome,
                'CIDADE_ID' => $this->cidadeId,
                'CIDADE' => $this->cidade,
                'TERMOS' => $this->termos,
            ],
        ];

        if ($semSenha) {
            unset($dadosKeycloak['credentials']);
        }

        return $dadosKeycloak;
    }

    /**
     * Retorna o objeto modelo como array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'nome' => $this->firstName,
            'sobrenome' => $this->lastName,
            'senha' => $this->password,
            'idKeycloak' => $this->idKeycloak,
            'email' => $this->email,
            'telefone' => $this->telefone,
            'cpf' => $this->cpf,
            'rg' => $this->rg,
            'estadoId' => $this->estadoId,
            'estado' => $this->estado,
            'cidadeId' => $this->cidadeId,
            'cidade' => $this->cidade,
            'termos' => $this->termos,
            'categoriaProfissional' => $this->categoriaProfissional,
            'titulacaoAcademica' => $this->titulacaoAcademica,
            'tipoContratacao' => $this->tipoContratacao,
            'instituicao' => $this->instituicao,
            'unidadeServico' => $this->unidadeServico,
            'especialidades' => $this->especialidades,
        ];
    }

    private function pegarSobrenome($nomeCompleto)
    {
        $sobrenome = '';
        $nomeCompletoArr = explode(' ', $nomeCompleto);
        for ($i = 0; $i < count($nomeCompletoArr); $i++) {
            if ($i != 0) {
                if ($i < count($nomeCompletoArr) - 1) {
                    $sobrenome .= $nomeCompletoArr[$i] . ' ';
                } else {
                    $sobrenome .= $nomeCompletoArr[$i];
                }
            }
        }

        return $sobrenome;
    }

    private function pegarNome($nomeCompleto)
    {
        return explode(' ', $nomeCompleto)[0];
    }
}
