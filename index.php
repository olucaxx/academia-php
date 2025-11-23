<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/Menu/Funcoes.php';       // contém linha(), ler(), pausar(), etc
require_once __DIR__ . '/src/Menu/MenuPrincipal.php'; // contém menuPrincipal()
require_once __DIR__ . '/src/Menu/MenuAluno.php';     // se você tiver funções de menu de aluno
require_once __DIR__ . '/src/Menu/MenuPersonal.php'; // se tiver funções de menu de instrutor
require_once __DIR__ . '/src/Menu/MenuEquipamentos.php'; // se tiver funções de menu de instrutor

use Trabalho\AcademiaPhp\Menu\Dados;
use Trabalho\AcademiaPhp\Aluno;
use Trabalho\AcademiaPhp\Personal;
use Trabalho\AcademiaPhp\Equipamento;
use Trabalho\AcademiaPhp\FichaTreino;
use Trabalho\AcademiaPhp\Treino;
use Trabalho\AcademiaPhp\Exercicios\Costas;
use Trabalho\AcademiaPhp\Exercicios\Perna;
use function Trabalho\AcademiaPhp\Menu\menuPrincipal;

// Criar objeto Dadosa
$dados = new Dados();

// Personal cadastrado
$personal = new Personal(
    '12345678901',
    'João Silva',
    '11999999999',
    'Rua A, 123',
    'joao@email.com',
    'CREF1234'
);
$dados->adicionarPersonal($personal);

// Equipamentos cadastrados
$e1 = new Equipamento('Leg Press', true);
$e2 = new Equipamento('Puxada Costas', true);
$dados->adicionarEquipamento($e1);
$dados->adicionarEquipamento($e2);

// Aluno 1
$aluno1 = new Aluno(
    '98765432100',
    'Maria Souza',
    '11988888888',
    'Rua B, 456',
    'maria@email.com',
    1,
    150.0
);

// Criar ficha de treino para Aluno 1
$ficha1 = new FichaTreino();
$ficha1->adicionarTreino('seg', new Treino('Agachamento', new Perna(), $e1, 3, 12, 60));
$ficha1->adicionarTreino('qua', new Treino('Puxada', new Costas(), $e2, 3, 10, 60));
$aluno1->setFicha($ficha1);

$dados->adicionarAluno($aluno1);

// Aluno 2
$aluno2 = new Aluno(
    '45678912300',
    'Carlos Lima',
    '11977777777',
    'Rua C, 789',
    'carlos@email.com',
    2,
    180.0
);

// Criar ficha de treino para Aluno 2
$ficha2 = new FichaTreino();
$ficha2->adicionarTreino('qui', new Treino('Puxada Costas', new Costas(), $e2, 3, 12, 60));
$ficha2->adicionarTreino('ter', new Treino('Leg Press', new Perna(), $e1, 4, 10, 90));
$ficha2->adicionarTreino('qui', new Treino('Leg Press', new Perna(), $e1, 4, 10, 90));
$aluno2->setFicha($ficha2);

$dados->adicionarAluno($aluno2);

// Chamar menu principal
menuPrincipal($dados);
