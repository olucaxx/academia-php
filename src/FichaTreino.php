<?php

namespace Academia\Poo;

class FichaTreino { 
    protected array $treinos;

    public function __construct(array $dias, array $exercicios, Personal $personal) {
        $this->treinos=[];
    }

    public function adicionarTreino(string $dia, Exercicio $exercicio, int $series, int $repeticoes, int $descanso) {
        $this->treinos[] = [$dia, $exercicio, $series, $repeticoes, $descanso ];
    }
    
    public function consultarTreinos(): array { 
        return $this->treinos;
    }
}
