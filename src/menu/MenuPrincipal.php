<?php

namespace Trabalho\AcademiaPhp\Menu;

use \Trabalho\AcademiaPhp\Personal;

function menu(array &$alunos, array &$personals, array &$equipamentos, array &$exercicioTipos): void {
    while (true) {
        linha();
        echo "ACADEMIA - MENU PRINCIPAL\n";
        echo "1) Menu Aluno\n";
        echo "2) Menu Instrutor\n";
        echo "3) Cadastrar Personal (instrutor)\n";
        echo "0) Sair\n";
        $op = ler("Opção: ");
        switch ($op) {
            case '1':
                menuAluno($alunos, $equipamentos);
                break;
            case '2':
                menuInstrutor($alunos, $personals, $equipamentos, $exercicioTipos);
                break;
            case '3':
                cadastrarPersonal($personals);
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

function cadastrarPersonal(array &$personals): void {
    linha();
    echo "CADASTRAR PERSONAL (INSTRUTOR)\n";
    $cpf = ler("CPF: ");
    $nome = ler("Nome: ");
    $telefone = ler("Telefone: ");
    $endereco = ler("Endereço: ");
    $email = ler("Email: ");
    $cref = ler("CREF: ");
    $p = new Personal($cpf, $nome, $telefone, $endereco, $email, $cref);
    $personals[] = $p;
    echo "Personal cadastrado.\n";
    pausar();
}