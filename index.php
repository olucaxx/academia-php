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

public function exibirMenuPrincipal() {
    echo "ACADEMIA UNIMAR\n";
    echo "1.Área do aluno\n";
    echo "2.Área do personal\n";
    echo "3.Área da gerencia\n";
}

public function exibirMenuAluno() {
    echo "ÁREA DO ALUNO\n";
    echo "1. Consultar ficha de treino\n"
    echo "2. Verificar plano atual\n"
    echo "3. Renover plano\n";
    echo "4. Cancelar plano\n";
    echo "5. Exibir dados pessoais\n";
}

public function exibirMenuPersonal() {
    echo "ÁREA DO PERSONAL\n";
    echo "1. Cadastrar aluno\n";
    echo "2. Exibir alunos\n";
    echo "3. Atribuir treino\n";
    echo "4. Revogar aluno\n";
    echo "5. Exibir dados pessoais\n";
}

public function exibirMenuManutencao() {
    echo "ÁREA DA GERENCIA\n";
    echo "1. Cadastrar personal\n";
    echo "2. Exibir personais\n";
    echo "3. Demitir personal\n";
    echo "4. Cadastrar equipamento\n";
    echo "5. Exibir equipamentos\n";
    echo "6. Realizar manutenção em equipamento\n";
    echo "7. Desativar equipamento\n";
    echo "8. Remover equipamento"
}

public function selecionarOpcao(): int {
    return (int) readline("Digite uma opção (ou 0 para sair): ");
}
