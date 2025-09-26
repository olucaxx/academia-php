<?php

namespace Academia\Poo;

abstract class Pessoa {
    protected string $cpf;
    protected string $nome;
    protected string $dataNascimento;
    protected int $telefone;
    protected string $endereco;
    protected string $email;

    public function __construct(string $cpf, string $nome, string $dataNascimento, int $telefone, string $endereco, string $email) { }

    public function pegarDadosPessoais(): string { }
}
