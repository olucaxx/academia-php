<?php

    namespace Trabalho\AcademiaPhp;

    use Datetime;
    use DateInterval;   

    class Aluno extends Pessoa {
        private int $matricula;
        private float $valorPlano;
        private DateTime $dataAdesao;
        private DateTime $vencimentoPlano;
        private bool $planoAtivo;
        private ?FichaTreino $treinoAtual;

        //CONSTRUTOR
        public function __construct(string $cpf, string $nome, string $telefone, string $endereco, string $email, int $matricula, float $valorPlano, DateTime $dataAdesao, DateTime $vencimentoPlano) {
            parent::__construct($cpf, $nome, $telefone, $endereco, $email);
            $this->setMatricula($matricula);
            $this->setValorPlano($valorPlano);
 
            $dataAdesao = new DateTime(); // vai criar nossa data de adesão com o DateTime
            $this->setDataAdesao($dataAdesao);

            $vencimentoPlano = clone $dataAdesao; // serve para adicionar 30 dias reais para uma data de vencimento com DateInterval
            $vencimentoPlano->add(new DateInterval('P30D'));
            $this->setVencimentoPlano($vencimentoPlano);

            $this->planoAtivo = true;
        }

        //GETTERS
        public function getMatricula(): int{
            return $this->matricula;
        }

        public function getValorPlano(): float{
            return $this->valorPlano;
        }

        public function getDataAdesao(): DateTime {// já retorna como uma string, para não precisar mexer no programa principal
            return $this->dataAdesao;
        }

        public function getVencimentoPlano(): DateTime { // já retorna como uma string
            return $this->vencimentoPlano;
        }

        public function getPlanoAtivo(): bool {
            return $this->planoAtivo;
        }

        public function getTreino(): ?FichaTreino {
            return $this->treinoAtual;
        }

        //SETTERS
        private function setMatricula(int $matricula): void{
            $this->matricula = $matricula;
        }

        public function setValorPlano(float $valorPlano): void{
            $this->valorPlano = $valorPlano;
        }

        private function setDataAdesao(DateTime $dataAdesao): void{
            $this->dataAdesao = $dataAdesao;
        }

        public function setVencimentoPlano(DateTime $vencimentoPlano): void{
            $this->vencimentoPlano = $vencimentoPlano;
        }

        private function setPlanoAtivo(bool $planoAtivo): void{
            $this->planoAtivo = $planoAtivo;
        }

        public function setTreino(FichaTreino $treino): void {
            $this->treinoAtual = $treino;
        }

        //MÉTODOS
        public function renovarPlano(): void { // renovar com +30 dias e ativar o plano
            $this->setVencimentoPlano($this->getVencimentoPlano()->add(new DateInterval('P30D')));
            $this->setPlanoAtivo(true);
        }

        public function cancelarPlano(): void { // definir a expiracao como o dia de hoje e desativar o plano
            $this->setVencimentoPlano(new DateTime());
            $this->setPlanoAtivo(false);
        }

        public function verificarPlano(): string { 
            $statusPlano = $this->getPlanoAtivo() ? "Ativo" : "Inativo";

            return "
                - Matricula: {$this->getMatricula()}\n
                - Plano: $statusPlano\n
                - Adesão: {$this->getDataAdesao()->format('d/m/Y')}\n
                - Vencimento: {$this->getVencimentoPlano()->format('d/m/Y')}\n
                - Mensalidade: {$this->getValorPlano()}\n
            ";
        }

        public function pegarDadosPessoais(): string
        {
            return parent::pegarDadosPessoais() . $this->verificarPlano();
        }
    }