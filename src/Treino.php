<?php

    namespace Trabalho\AcademiaPhp;

    use Trabalho\AcademiaPhp\Exercicios\Exercicio;

    class Treino { 
        private string $exercicio; 
        private Exercicio $tipo;
        private ?Equipamento $equipamento; // pode ser null, ou seja, livre
        private int $series;
        private int $repeticoes;
        private int $descanso;
        
        public function __construct(string $exercicio, Exercicio $tipo, ?Equipamento $equipamento, int $series, int $repeticoes, int $descanso) {
            $this->setExercicio($exercicio);
            $this->setTipo($tipo);
            $this->setEquipamento($equipamento);
            $this->setSeries($series);
            $this->setRepeticoes($repeticoes);
            $this->setDescanso($descanso);
        }

        public function getExercicio(): string {
            return $this->exercicio;
        }

        public function getTipo(): Exercicio {
            return $this->tipo;
        }

        public function getEquipamento(): ?Equipamento {
            return $this->equipamento;
        }

        public function getSeries(): int {
            return $this->series;
        }

        public function getRepeticoes(): int {
            return $this->repeticoes;
        }

        public function getDescanso(): int {
            return $this->descanso;
        }

        public function setExercicio(string $exercicio): void {
            $this->exercicio = $exercicio;
        }

        public function setTipo(Exercicio $tipo): void {
            $this->tipo = $tipo;
        }

        public function setEquipamento(?Equipamento $equipamento): void {
            $this->equipamento = $equipamento;
        }

        public function setSeries(int $series): void {
            $this->series = $series;
        }

        public function setRepeticoes(int $repeticoes): void {
            $this->repeticoes = $repeticoes;
        }

        public function setDescanso(int $descanso): void {
            $this->descanso = $descanso;
        }

        public function detalhes(): string {
            $nomeEquipamento = $this->getEquipamento() ? $this->getEquipamento()->getNome() : "Não especificado.";

            $detalhes = "";
            $detalhes .= "Exercício: {$this->getExercicio()}\n";
            $detalhes .= "      Grupo: {$this->getTipo()->getNome()}\n";
            $detalhes .= "      Equipamento: {$nomeEquipamento}\n";
            $detalhes .= "      Quant. Series: {$this->getSeries()}\n";
            $detalhes .= "      Quant. Repetições: {$this->getRepeticoes()}\n";
            $detalhes .= "      Tempo descanso (seg): {$this->getDescanso()}\n";
            return $detalhes;
        }
    }
