<?php

    namespace Trabalho\AcademiaPhp\Exercicios;

    class Costas extends Exercicio { 
        public function __construct() {
            parent::__construct("Costas");
        }

        public function treinar(): string {
            return "Treino de costas feito, agora dói para manter a postura.\n";
        }
    }
