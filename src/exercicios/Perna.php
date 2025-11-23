<?php

    namespace Trabalho\AcademiaPhp\Exercicios;

    class Perna extends Exercicio { 
        public function __construct() {
            parent::__construct("Perna");
        }

        public function treinar(): string {
            return "Treino de perna realizado, agora dói para andar.\n";
        }
    }
