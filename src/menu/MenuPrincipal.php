<?php

namespace Trabalho\AcademiaPhp\Menu;

use \Trabalho\AcademiaPhp\Personal;

function menuPrincipal(Dados $dados): void {
    while (true) {
        linha();
        echo "ACADEMIA - MENU PRINCIPAL\n";
        echo "1) Menu Aluno\n";
        echo "2) Menu Personal\n";
        echo "3) Cadastrar Personal\n";
        echo "0) Sair\n";
        $op = ler("Opção: ");
        switch ($op) {
            case '1':
                menuAluno($dados);
                break;
            case '2':
                menuPersonal($dados);
                break;
            case '3':
                cadastrarPersonal($dados);
                break;
            case '0':
                echo "Saindo...\n";
                return;
            default:
                echo "Opção inválida.\n";
                pausar();
        }
    }
}

function cadastrarPersonal(Dados $dados): void {
    linha();
    echo "CADASTRAR PERSONAL\n";
    $cpf = lerSomenteNumeros("CPF (somente números): ");
    $nome = ler("Nome: ");
    $telefone = lerSomenteNumeros("Telefone (somente números: ");
    $endereco = ler("Endereço: ");
    $email = ler("Email: ");
    $cref = ler("CREF: ");
    $p = new Personal($cpf, $nome, $telefone, $endereco, $email, $cref);
    $dados->adicionarPersonal($p);
    echo "Personal cadastrado.\n";
    pausar();
}
