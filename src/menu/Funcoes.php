<?php

namespace Trabalho\AcademiaPhp\Menu;

function linha(): void {
    echo str_repeat('-', 60) . PHP_EOL;
}

function ler(string $prompt): string {
    $res = readline($prompt);
    return $res === false ? '' : trim($res);
}

function pausar(): void {
    readline("Pressione Enter para continuar...");
}

function selecionarIndice(string $prompt, array $arr): ?int {
    if (empty($arr)) {
        echo "Lista vazia.\n";
        return null;
    }
    $input = ler($prompt);
    if ($input === '') return null;
    if (!is_numeric($input)) {
        echo "Entrada inválida.\n";
        return null;
    }
    $idx = (int) $input;
    if (!array_key_exists($idx, $arr)) {
        echo "Índice não existe.\n";
        return null;
    }
    return $idx;
}

function escolherDia(): ?string {
    $dias = ['seg','ter','qua','qui','sex','sab','dom'];
    echo "Dias disponíveis:\n";
    foreach ($dias as $d) {
        echo "- {$d}\n";
    }
    $dia = ler("Escolha o dia (seg/ter/qua/qui/sex/sab/dom): ");
    if (!in_array($dia, $dias, true)) {
        echo "Dia inválido.\n";
        return null;
    }
    return $dia;
}

function listarAlunos(array $alunos): void {
    if (empty($alunos)) {
        echo "Nenhum aluno cadastrado.\n";
        return;
    }
    echo "Alunos:\n";
    foreach ($alunos as $idx => $aluno) {
        $nome = $aluno->getNome();
        $mat = $aluno->getMatricula();
        echo "[$idx] Matricula: {$mat} - Nome: {$nome}\n";
    }
}

function listarPersonals(array $personals): void {
    if (empty($personals)) {
        echo "Nenhum personal cadastrado.\n";
        return;
    }
    echo "Personais:\n";
    foreach ($personals as $idx => $p) {
        echo "[$idx] Nome: " . $p->getNome() . " - CREF: " . $p->getCref() . "\n";
    }
}

function listarEquipamentos(array $equipamentos): void {
    if (empty($equipamentos)) {
        echo "Nenhum equipamento cadastrado.\n";
        return;
    }
    echo "Equipamentos:\n";
    foreach ($equipamentos as $idx => $e) {
        $status = $e->getAtivo() ? 'Ativo' : 'Inativo';
        echo "[$idx] Nome: " . $e->getNome() . " - Status: {$status}\n";
    }
}

