<?php

namespace Trabalho\AcademiaPhp\Menu;

class Dados {
    public array $alunos = [];
    public array $personais = [];
    public array $equipamentos = [];
    public array $exercicioTipos = [];

    public function __construct() {
        $this->setExercicioTipos([
            'Costas' => \Trabalho\AcademiaPhp\Exercicios\Costas::class,
            'Perna' => \Trabalho\AcademiaPhp\Exercicios\Perna::class,
        ]);
    }

    public function getAlunos(): array {
        return $this->alunos;
    }

    public function getPersonais(): array {
        return $this->personais;
    }

    public function getEquipamentos(): array {
        return $this->equipamentos;
    }

    public function getExercicioTipos(): array {
        return $this->exercicioTipos;
    }

    private function setAlunos(array $alunos): void {
        $this->alunos = $alunos;
    }

    private function setPersonais(array $personais): void {
        $this->personais = $personais;
    }

    private function setEquipamentos(array $equipamentos): void {
        $this->equipamentos = $equipamentos;
    }

    private function setExercicioTipos(array $exercicioTipos): void {
        $this->exercicioTipos = $exercicioTipos;
    }

    public function adicionarAluno($aluno): void {
        $alunos = $this->getAlunos();
        $alunos[] = $aluno;
        $this->setAlunos($alunos);
    }

    public function removerAluno(int $index): void {
        $alunos = $this->getAlunos();
        if (isset($alunos[$index])) {
            unset($alunos[$index]);
            $alunos = array_values($alunos);
            $this->setAlunos($alunos);
        }
    }

    public function adicionarPersonal($personal): void {
        $personais = $this->getPersonais();
        $personais[] = $personal;
        $this->setPersonais($personais);
    }

    public function removerPersonal(int $index): void {
        $personais = $this->getPersonais();
        if (isset($personais[$index])) {
            unset($personais[$index]);
            $personais = array_values($personais);
            $this->setPersonais($personais);
        }
    }

    public function adicionarEquipamento($equipamento): void {
        $equipamentos = $this->getEquipamentos();
        $equipamentos[] = $equipamento;
        $this->setEquipamentos($equipamentos);
    }

    public function removerEquipamento(int $index): void {
        $equipamentos = $this->getEquipamentos();
        if (isset($equipamentos[$index])) {
            unset($equipamentos[$index]);
            $equipamentos = array_values($equipamentos);
            $this->setEquipamentos($equipamentos);
        }
    }
}
