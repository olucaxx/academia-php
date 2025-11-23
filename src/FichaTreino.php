<?php

    namespace Trabalho\AcademiaPhp;

    use Exception;

    class FichaTreino{
        private array $treinos; // dicionário com 'dia' : [array de treinos]

        public function __construct(){
            $this->treinos = array(
                "seg" => [],
                "ter" => [],
                "qua" => [],
                "qui" => [],
                "sex" => [],
                "sab" => [],
                "dom" => [],
            );
        }

        public function getTreinos(): array{
            return $this->treinos;
        }

        private function setTreinos(array $treinos): void{
            $this->treinos = $treinos;
        }

        public function adicionarTreino(string $dia, Treino $novoTreino): void{
            $treinosAtuais = $this->getTreinos()[$dia];
            $treinosAtuais[] = $novoTreino;

            $treinosComNovo = $this->getTreinos(); 
            $treinosComNovo[$dia] = $treinosAtuais;

            $this->setTreinos($treinosComNovo);
        }

        public function removerTreino(string $dia, int $index): void{
            try {
                $treinosAtuais = $this->getTreinos()[$dia];

                if (!isset($treinosAtuais[$index])) {
                    throw new Exception("Treino no índice {$index} não encontrado para o dia {$dia}.");
                }

                unset($treinosAtuais[$index]);
                $treinosAtuais = array_values($treinosAtuais);

                $treinosComNovo = $this->getTreinos();
                $treinosComNovo[$dia] = $treinosAtuais;

                $this->setTreinos($treinosComNovo);
            } catch (Exception $e) {
                echo "Erro ao remover treino: " . $e->getMessage();
            }
        }
    }
