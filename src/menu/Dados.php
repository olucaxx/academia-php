<?php

namespace Trabalho\AcademiaPhp\Menu;

class Dados {
    public array $alunos = [];
    public array $personals = [];
    public array $equipamentos = [];
    public array $exercicioTipos = [];

    public function __construct() {
        $this->exercicioTipos = [
            'Costas' => \Trabalho\AcademiaPhp\Exercicios\Costas::class,
            'Perna' => \Trabalho\AcademiaPhp\Exercicios\Perna::class,
        ];
    }
}
