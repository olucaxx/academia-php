<?php

require_once 'src/Pessoa.php';
require_once 'src/Aluno.php';
require_once 'src/Personal.php';
require_once 'src/FichaTreino.php';
require_once 'src/Exercicio.php';
require_once 'src/Equipamento.php';

use Academia\Poo\Aluno;
use Academia\Poo\Personal;
use Academia\Poo\Exercicio;
use Academia\Poo\Equipamento;

$personais = [];
$alunos = [];

$personais[] = new Personal(
    "12345678900",
    "Carlos Silva",
    "15/05/1985",
    "(11) 99999-9999",
    "Rua A, 123 - São Paulo, SP", 
    "carlos@academia.com", 
    "012345-G/SP", 
    3500.00 
);

$personais[] = new Personal(
    "98765432100", 
    "Ana Souza", 
    "20/08/1990", 
    "(31) 98888-8888", 
    "Av. B, 456 - Belo Horizonte, MG", 
    "ana@academia.com", 
    "067890-G/MG", 
    3200.00
);

$alunos[] = new Aluno(
    "11111111100", 
    "João Santos", 
    "10/01/2000", 
    "(11) 97777-7777", 
    "Rua C, 789 - São Paulo, SP",
    "joao@email.com",
    count($alunos)+1,
    120.00,
    "01/01/2024",
    "01/02/2024" 
);

$alunos[] = new Aluno(
    "22222222200", 
    "Maria Oliveira",
    "25/03/1998",
    "(11) 96666-6666",
    "Rua D, 321 - São Paulo, SP",
    "maria@email.com",
    count($alunos)+1,
    120.00,
    "15/01/2024",
    "15/02/2024"
);

$alunos[] = new Aluno(
    "33333333300",
    "Pedro Costa",
    "05/12/1995",
    "(11) 95555-5555",
    "Av. E, 654 - São Paulo, SP",
    "pedro@email.com",
    count($alunos)+1,
    120.00,
    "20/01/2024",
    "20/02/2024"
);

function exibirMenuPrincipal() {
    system('cls');
    echo "ACADEMIA UNIMAR\n";
    echo "1.Área do aluno\n";
    echo "2.Área do personal\n";
    echo "3.Área da gerencia\n";
}

function exibirMenuAluno() {
    system('cls');
    echo "ÁREA DO ALUNO\n";
    echo "1. Consultar ficha de treino\n";
    echo "2. Verificar plano atual\n";
    echo "3. Renover plano\n";
    echo "4. Cancelar plano\n";
    echo "5. Exibir dados pessoais\n";
}

function exibirMenuPersonal() {
    system('cls');
    echo "ÁREA DO PERSONAL\n";
    echo "1. Cadastrar aluno\n";
    echo "2. Exibir alunos\n";
    echo "3. Atribuir treino\n";
    echo "4. Revogar aluno\n";
    echo "5. Exibir dados pessoais\n";
}

function exibirMenuManutencao() {
    system('cls');
    echo "ÁREA DA GERENCIA\n";
    echo "1. Cadastrar personal\n";
    echo "2. Exibir personais\n";
    echo "3. Demitir personal\n";
    echo "4. Cadastrar equipamento\n";
    echo "5. Exibir equipamentos\n";
    echo "6. Realizar manutenção em equipamento\n";
    echo "7. Desativar equipamento\n";
    echo "8. Remover equipamento\n";
}

function selecionarOpcao(): int {
    return (int) readline("Digite uma opção (ou 0 para sair): ");
}

function aguardarConfirmacao() {
    echo "\nPressione qualquer tecla para prosseguir...";
    fgets(STDIN);
}

while(1) {
    exibirMenuPrincipal();
    $opcao = selecionarOpcao();

    switch($opcao) {
        case 1:
            do {
                exibirMenuAluno();
                $opcao = selecionarOpcao();
                switch($opcao) {
                }
            } while($opcao != 0);
            break;
        case 2:
            do {
                exibirMenuPersonal();
                $opcao = selecionarOpcao();
                switch($opcao) {
                }
            } while($opcao != 0);
            break;
        case 3:
            do {
                exibirMenuManutencao();
                $opcao = selecionarOpcao();
                switch($opcao) {
                }
            } while($opcao != 0);
            break;
        case 0:
            echo "\nEncerrando...";
            break 2;
    }
};