<?php

namespace Academia\Poo;

abstract class Pessoa {
    protected string $cpf;
    protected string $nome;
    protected string $dataNascimento;
    protected string $telefone;
    protected string $endereco;
    protected string $email;

    public function __construct(string $cpf, string $nome, string $dataNascimento, string $telefone, string $endereco, string $email) {
        $this->cpf=$cpf;
        $this->nome=$nome;
        $this->dataNascimento=$dataNascimento;
        $this->telefone=$telefone;
        $this->endereco=$endereco;
        $this->email=$email;
    }

    public function pegarDadosPessoais(): string {
        return "|CPF:$this->cpf\n|Nome:$this->nome\n|Data de Nascimento:$this->dataNascimento\n|Telefone:$this->telefone\n|Endereço:$this->endereco\n|Email:$this->email";
    }
}
