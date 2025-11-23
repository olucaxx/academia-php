<?php

    namespace Trabalho\AcademiaPhp;

    class Equipamento { 
        private string $nome;
        private bool $ativo;

        public function __construct(string $nome, bool $ativo) {
            $this->setNome($nome);
            $this->setAtivo($ativo);
        }

        public function getNome(): string {
            return $this->nome;
        }

        public function getAtivo(): bool {
            return $this->ativo;
        }

        public function setNome(string $nome) {
            $this->nome = $nome;
        }

        public function setAtivo(bool $ativo) {
            $this->ativo = $ativo;
        }
    }

