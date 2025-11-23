<?php

namespace Trabalho\AcademiaPhp;

class Personal extends Pessoa
{
    private string $cref;
    public function __construct(string $cpf, string $nome, string $telefone, string $endereco, string $email, string $cref)
    {
        parent::__construct($cpf, $nome, $telefone, $endereco, $email);
        $this->setCref($cref);
    }

    public function getCref(): string
    {
        return $this->cref;
    }

    private function setCref($cref)
    {        
        $this->cref = $cref;
    }

    public function pegarDadosPessoais(): string
    {
        return "- Cref: {$this->getCref()}\n" . parent::pegarDadosPessoais();
    }
}
