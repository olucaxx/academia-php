<?php

    namespace Trabalho\AcademiaPhp\Exercicios;

    abstract class Exercicio { 
        private string $nome;

        public function __construct(string $nome) {
            $this->setNome($nome);
        }

        public function getNome(): string {
            return $this->nome;
        }

        private function setNome(string $nome): void { 
            $this->nome = $nome;
        }

        public function treinar(): string {
            return "Treino finalizado, o aluno ficou cansado.\n";
        }
    }
