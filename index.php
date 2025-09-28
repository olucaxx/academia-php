<?php

require_once 'src/Pessoa.php';
require_once 'src/Aluno.php';
require_once 'src/Personal.php';
require_once 'src/FichaTreino.php';
require_once 'src/Exercicio.php';
require_once 'src/Equipamento.php';

use Academia\Poo\Aluno;
use Academia\Poo\Personal;
use Academia\Poo\Exercicio;
use Academia\Poo\Equipamento;
use Academia\Poo\FichaTreino;

$personais = [];
$alunos = [];
$equipamentos = [];
$exercicios = [];

function inicializarDados() {
    global $personais, $alunos, $equipamentos, $exercicios;
    
    $personais[] = new Personal(
        "12345678900",
        "Carlos Silva",
        "15/05/1985",
        "(11) 99999-9999",
        "Rua A, 123 - São Paulo, SP", 
        "carlos@academia.com", 
        "012345-G/SP", 
        3500.00 
    );

    $personais[] = new Personal(
        "98765432100", 
        "Ana Souza", 
        "20/08/1990", 
        "(31) 98888-8888", 
        "Av. B, 456 - Belo Horizonte, MG", 
        "ana@academia.com", 
        "067890-G/MG", 
        3200.00
    );

    $alunos[] = new Aluno(
        "11111111100", 
        "João Santos", 
        "10/01/2000", 
        "(11) 97777-7777", 
        "Rua C, 789 - São Paulo, SP",
        "joao@email.com",
        2023001,
        120.00,
        "01/01/2024",
        "01/02/2024" 
    );

    $alunos[] = new Aluno(
        "22222222200", 
        "Maria Oliveira",
        "25/03/1998",
        "(11) 96666-6666",
        "Rua D, 321 - São Paulo, SP",
        "maria@email.com",
        2023002,
        120.00,
        "15/01/2024",
        "15/02/2024"
    );

    $alunos[] = new Aluno(
        "33333333300",
        "Pedro Costa",
        "05/12/1995",
        "(11) 95555-5555",
        "Av. E, 654 - São Paulo, SP",
        "pedro@email.com",
        2023003,
        120.00,
        "20/01/2024",
        "20/02/2024"
    );

    $equipamentos[] = new Equipamento("Barra Olímpica", "Força Total", 800.00, "01/01/2024");
    $equipamentos[] = new Equipamento("Halteres 20kg", "Muscle Pro", 300.00, "15/01/2024");
    $equipamentos[] = new Equipamento("Esteira", "Cardio Fit", 2500.00, "10/01/2024");

    $exercicios[] = new Exercicio("Supino Reto", "Peitoral", $equipamentos[0]);
    $exercicios[] = new Exercicio("Agachamento Livre", "Pernas", $equipamentos[0]);
    $exercicios[] = new Exercicio("Rosca Direta", "Bíceps", $equipamentos[1]);
}

function selecionarPersonal(): ?int {
    global $personais;
    
    if (empty($personais)) {
        echo "Nenhum personal cadastrado!\n";
        return null;
    }
    
    echo "\nSelecione o personal:\n";
    foreach ($personais as $index => $personal) {
        echo ($index + 1) . ". " . $personal->pegarDadosPessoais() . "\n";
    }
    
    $opcao = (int) readline("Digite o número do personal: ");
    
    if ($opcao >= 1 && $opcao <= count($personais)) {
        return $opcao - 1;
    }
    
    echo "Personal inválido!\n";
    return null;
}

function selecionarAluno(): ?int {
    global $alunos;
    
    if (empty($alunos)) {
        echo "Nenhum aluno cadastrado!\n";
        return null;
    }
    
    echo "\nSelecione o aluno:\n";
    foreach ($alunos as $index => $aluno) {
        echo ($index + 1) . ". " . $aluno->pegarDadosPessoais() . "\n";
    }
    
    $opcao = (int) readline("Digite o número do aluno: ");
    
    if ($opcao >= 1 && $opcao <= count($alunos)) {
        return $opcao - 1;
    }
    
    echo "Aluno inválido!\n";
    return null;
}

function selecionarEquipamento(): ?int {
    global $equipamentos;
    
    if (empty($equipamentos)) {
        echo "Nenhum equipamento cadastrado!\n";
        return null;
    }
    
    echo "\nSelecione o equipamento:\n";
    foreach ($equipamentos as $index => $equipamento) {
        echo ($index + 1) . ". " . $equipamento->pegarNome() . "\n";
    }
    
    $opcao = (int) readline("Digite o número do equipamento: ");
    
    if ($opcao >= 1 && $opcao <= count($equipamentos)) {
        return $opcao - 1;
    }
    
    echo "Equipamento inválido!\n";
    return null;
}

function selecionarExercicio(): ?int {
    global $exercicios;
    
    if (empty($exercicios)) {
        echo "Nenhum exercício cadastrado!\n";
        return null;
    }
    
    echo "\nSelecione o exercício:\n";
    foreach ($exercicios as $index => $exercicio) {
        echo ($index + 1) . ". " . $exercicio->consultarExercicio() . "\n";
    }
    
    $opcao = (int) readline("Digite o número do exercício: ");
    
    if ($opcao >= 1 && $opcao <= count($exercicios)) {
        return $opcao - 1;
    }
    
    echo "Exercício inválido!\n";
    return null;
}

function exibirMenuPrincipal() {
    system('clear');
    echo "=== ACADEMIA UNIMAR ===\n";
    echo "1. Área do aluno\n";
    echo "2. Área do personal\n";
    echo "3. Área da gerencia\n";
    echo "0. Sair\n";
}

function exibirMenuAluno() {
    system('cls');
    echo "=== ÁREA DO ALUNO ===\n";
    echo "1. Consultar ficha de treino\n";
    echo "2. Verificar plano atual\n";
    echo "3. Renovar plano\n";
    echo "4. Cancelar plano\n";
    echo "5. Exibir dados pessoais\n";
    echo "0. Voltar\n";
}

function exibirMenuPersonal() {
    system('cls');
    echo "=== ÁREA DO PERSONAL ===\n";
    echo "1. Cadastrar aluno\n";
    echo "2. Exibir alunos\n";
    echo "3. Atribuir treino\n";
    echo "4. Revogar aluno\n";
    echo "5. Exibir dados pessoais\n";
    echo "0. Voltar\n";
}

function exibirMenuManutencao() {
    system('cls');
    echo "=== ÁREA DA GERENCIA ===\n";
    echo "1. Cadastrar personal\n";
    echo "2. Exibir personais\n";
    echo "3. Demitir personal\n";
    echo "4. Cadastrar equipamento\n";
    echo "5. Exibir equipamentos\n";
    echo "6. Realizar manutenção em equipamento\n";
    echo "7. Desativar equipamento\n";
    echo "8. Remover equipamento\n";
    echo "0. Voltar\n";
}

function selecionarOpcao(): int {
    return (int) readline("\nDigite uma opção: ");
}

function aguardarConfirmacao() {
    echo "\nPressione Enter para continuar...";
    fgets(STDIN);
}

function menuAluno($indiceAluno) {
    global $alunos;
    
    do {
        exibirMenuAluno();
        $opcao = selecionarOpcao();
        
        switch($opcao) {
            case 1:
                echo "\n=== FICHA DE TREINO ===\n";
                if (isset($alunos[$indiceAluno]->treino)) {
                    $treinos = $alunos[$indiceAluno]->consultarTreinos();
                    foreach ($treinos as $treino) {
                        print_r($treino);
                    }
                } else {
                    echo "Nenhum treino atribuído.\n";
                }
                aguardarConfirmacao();
                break;
                
            case 2:
                echo "\n=== PLANO ATUAL ===\n";
                echo $alunos[$indiceAluno]->verificarPlano();
                aguardarConfirmacao();
                break;
                
            case 3:
                $novaData = readline("Digite a nova data de vencimento (DD/MM/AAAA): ");
                $alunos[$indiceAluno]->renovarPlano($novaData);
                echo "Plano renovado com sucesso!\n";
                aguardarConfirmacao();
                break;
                
            case 4:
                $alunos[$indiceAluno]->cancelarPlano();
                echo "Plano cancelado com sucesso!\n";
                aguardarConfirmacao();
                break;
                
            case 5:
                echo "\n=== DADOS PESSOAIS ===\n";
                echo $alunos[$indiceAluno]->pegarDadosPessoais();
                aguardarConfirmacao();
                break;
                
            case 0:
                break;
                
            default:
                echo "Opção inválida!\n";
                aguardarConfirmacao();
        }
    } while($opcao != 0);
}

function menuPersonal($indicePersonal) {
    global $personais, $alunos, $exercicios;
    
    do {
        exibirMenuPersonal();
        $opcao = selecionarOpcao();
        
        switch($opcao) {
            case 1:
                echo "\n=== CADASTRAR ALUNO ===\n";
                $cpf = readline("CPF: ");
                $nome = readline("Nome: ");
                $dataNascimento = readline("Data de Nascimento (DD/MM/AAAA): ");
                $telefone = readline("Telefone: ");
                $endereco = readline("Endereço: ");
                $email = readline("Email: ");
                $matricula = count($alunos) + 1;
                $valorPlano = (float) readline("Valor do plano: ");
                $dataAdesao = readline("Data de adesão (DD/MM/AAAA): ");
                $vencimentoPlano = readline("Data de vencimento (DD/MM/AAAA): ");
                
                $alunos[] = new Aluno($cpf, $nome, $dataNascimento, $telefone, $endereco, $email, $matricula, $valorPlano, $dataAdesao, $vencimentoPlano);
                echo "Aluno cadastrado com sucesso!\n";
                aguardarConfirmacao();
                break;
                
            case 2:
                echo "\n=== LISTA DE ALUNOS ===\n";
                foreach ($alunos as $index => $aluno) {
                    echo ($index + 1) . ". " . $aluno->pegarDadosPessoais() . "\n";
                    echo "Plano: " . $aluno->verificarPlano() . "\n";
                    echo "---\n";
                }
                aguardarConfirmacao();
                break;
                
            case 3:
                $indiceAluno = selecionarAluno();
                if ($indiceAluno !== null) {
                    echo "\n=== ATRIBUIR TREINO ===\n";
                    $ficha = new FichaTreino([], [], $personais[$indicePersonal]);
                    
                    $continuar = true;
                    while ($continuar) {
                        $indiceExercicio = selecionarExercicio();
                        if ($indiceExercicio !== null) {
                            $dia = readline("Dia da semana: ");
                            $series = (int) readline("Número de séries: ");
                            $repeticoes = (int) readline("Número de repetições: ");
                            $descanso = (int) readline("Tempo de descanso (segundos): ");
                            
                            $ficha->adicionarTreino($dia, $exercicios[$indiceExercicio], $series, $repeticoes, $descanso);
                            echo "Exercício adicionado ao treino!\n";
                        }
                        
                        $continuar = readline("Adicionar outro exercício? (s/n): ") === 's';
                    }
                    
                    $personais[$indicePersonal]->atribuirTreinoParaAluno($alunos[$indiceAluno], $ficha);
                    echo "Treino atribuído com sucesso!\n";
                }
                aguardarConfirmacao();
                break;
                
            case 4:
                $indiceAluno = selecionarAluno();
                if ($indiceAluno !== null) {
                    unset($alunos[$indiceAluno]);
                    $alunos = array_values($alunos);
                    echo "Aluno removido com sucesso!\n";
                }
                aguardarConfirmacao();
                break;
                
            case 5:
                echo "\n=== DADOS PESSOAIS ===\n";
                echo $personais[$indicePersonal]->pegarDadosPessoais();
                echo "CREF: " . $personais[$indicePersonal]->consultarCref() . "\n";
                aguardarConfirmacao();
                break;
                
            case 0:
                break;
                
            default:
                echo "Opção inválida!\n";
                aguardarConfirmacao();
        }
    } while($opcao != 0);
}

function menuManutencao() {
    global $personais, $equipamentos;
    
    do {
        exibirMenuManutencao();
        $opcao = selecionarOpcao();
        
        switch($opcao) {
            case 1:
                echo "\n=== CADASTRAR PERSONAL ===\n";
                $cpf = readline("CPF: ");
                $nome = readline("Nome: ");
                $dataNascimento = readline("Data de Nascimento (DD/MM/AAAA): ");
                $telefone = readline("Telefone: ");
                $endereco = readline("Endereço: ");
                $email = readline("Email: ");
                $cref = readline("CREF: ");
                $salario = (float) readline("Salário: ");
                
                $personais[] = new Personal($cpf, $nome, $dataNascimento, $telefone, $endereco, $email, $cref, $salario);
                echo "Personal cadastrado com sucesso!\n";
                aguardarConfirmacao();
                break;
                
            case 2:
                echo "\n=== LISTA DE PERSONAIS ===\n";
                foreach ($personais as $index => $personal) {
                    echo ($index + 1) . ". " . $personal->pegarDadosPessoais() . "\n";
                    echo "CREF: " . $personal->consultarCref() . "\n";
                    echo "---\n";
                }
                aguardarConfirmacao();
                break;
                
            case 3:
                $indicePersonal = selecionarPersonal();
                if ($indicePersonal !== null) {
                    unset($personais[$indicePersonal]);
                    $personais = array_values($personais);
                    echo "Personal demitido com sucesso!\n";
                }
                aguardarConfirmacao();
                break;
                
            case 4:
                echo "\n=== CADASTRAR EQUIPAMENTO ===\n";
                $nome = readline("Nome: ");
                $fornecedor = readline("Fornecedor: ");
                $valor = (float) readline("Valor: ");
                $dataAquisicao = readline("Data de aquisição (DD/MM/AAAA): ");
                
                $equipamentos[] = new Equipamento($nome, $fornecedor, $valor, $dataAquisicao);
                echo "Equipamento cadastrado com sucesso!\n";
                aguardarConfirmacao();
                break;
                
            case 5:
                echo "\n=== LISTA DE EQUIPAMENTOS ===\n";
                foreach ($equipamentos as $index => $equipamento) {
                    echo ($index + 1) . ". " . $equipamento->consultarDados() . "\n";
                }
                aguardarConfirmacao();
                break;
                
            case 6:
                $indiceEquipamento = selecionarEquipamento();
                if ($indiceEquipamento !== null) {
                    $dataManutencao = readline("Data da manutenção (DD/MM/AAAA): ");
                    $equipamentos[$indiceEquipamento]->realizarManutencao($dataManutencao);
                    echo "Manutenção realizada com sucesso!\n";
                }
                aguardarConfirmacao();
                break;
                
            case 7:
                $indiceEquipamento = selecionarEquipamento();
                if ($indiceEquipamento !== null) {
                    $equipamentos[$indiceEquipamento]->desativarEquipamento();
                    echo "Equipamento desativado com sucesso!\n";
                }
                aguardarConfirmacao();
                break;
                
            case 8:
                $indiceEquipamento = selecionarEquipamento();
                if ($indiceEquipamento !== null) {
                    unset($equipamentos[$indiceEquipamento]);
                    $equipamentos = array_values($equipamentos);
                    echo "Equipamento removido com sucesso!\n";
                }
                aguardarConfirmacao();
                break;
                
            case 0:
                break;
                
            default:
                echo "Opção inválida!\n";
                aguardarConfirmacao();
        }
    } while($opcao != 0);
}

inicializarDados();

while(true) {
    exibirMenuPrincipal();
    $opcao = selecionarOpcao();

    switch($opcao) {
        case 1:
            $indiceAluno = selecionarAluno();
            if ($indiceAluno !== null) {
                menuAluno($indiceAluno);
            } else {
                aguardarConfirmacao();
            }
            break;
            
        case 2:
            $indicePersonal = selecionarPersonal();
            if ($indicePersonal !== null) {
                menuPersonal($indicePersonal);
            } else {
                aguardarConfirmacao();
            }
            break;
            
        case 3:
            menuManutencao();
            break;
            
        case 0:
            echo "\nEncerrando sistema...\n";
            exit(0);
            
        default:
            echo "Opção inválida!\n";
            aguardarConfirmacao();
    }
}
