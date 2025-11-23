<?php

    namespace Trabalho\AcademiaPhp;

    abstract class Pessoa {
        protected string $cpf;
        protected string $nome;
        protected string $telefone;
        protected string $endereco;
        protected string $email;

        //Construtor
        public function __construct(
            string $cpf,
            string $nome,
            string $telefone,
            string $endereco,
            string $email
        ) {
            $this->setCpf($cpf);
            $this->setNome($nome);
            $this->setTelefone($telefone);
            $this->setEndereco($endereco);
            $this->setEmail($email);
        }

        //Getters
        public function getCpf(): string{
            return $this->cpf;
        }

        public function getNome(): string{
            return $this->nome;
        }

        public function getTelefone(): string{
            return $this->telefone;
        }

        public function getEndereco(): string{
            return $this->endereco;
        }

        public function getEmail(): string{
            return $this->email;
        }

        //Setters
        private function setCpf(string $cpf): void{
            $this->cpf = $cpf;
        }

        private function setNome(string $nome): void{
            $this->nome = $nome;
        }

        public function setTelefone(string $telefone): void{
            $this->telefone = $telefone;
        }

        public function setEndereco(string $endereco): void{
            $this->endereco = $endereco;
        } 

        public function setEmail(string $email): void{
            $this->email = $email;
        }

        //Métodos


        
        public function pegarDadosPessoais(): string {
            $dados = "- CPF: {$this->getCpf()}\n";                 
            $dados .= "- Nome: {$this->getNome()}\n";
            $dados .= "- Telefone: {$this->getTelefone()}}\n";
            $dados .= "- Endereço: {$this->getEndereco()}\n";
            $dados .= "- Email: {$this->getEmail()}\n";
            return $dados;
        }
    }
?>