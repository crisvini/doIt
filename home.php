<?php
// Inclusão do arquivo de includes
include_once("./includes/includes.php");
// Inclusão do arquivo de conexão
include("./connection/conexao.php");
// Função que verifica se o usuário está autenticado
Funcoes::verificaLogin();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!-- Inclusão do head -->
    <?php Componentes::head('Home'); ?>
</head>

<body>
    <!-- Navbar/Header -->
    <header>
        <!-- Inclusão do navbar/header -->
        <?php Componentes::header(); ?>
    </header>

    <main class="mt-3 mt-lg-4 container">
        <div class="px-4 py-3 rounded bg-light box-shadow-padrao">
            <!-- Header tabela     -->
            <div class="row mt-2 mb-4">
                <div class="col">
                    <span class="fw-bolder fs-3 text-success"><i class="fa-solid fa-list-check"></i>&nbsp;Tarefas</span>
                </div>
                <div class="col-6 text-end align-self-end">
                    <i class="pointer success-hover fa-solid fa-file-excel text-success fs-4 me-3 me-lg-4"></i>
                    <i class="pointer success-hover fa-solid fa-file-pdf text-success fs-4"></i>
                </div>
            </div>

            <?php
            $htmlTabela = "";
            // Busca as tarefas
            $sql = "SELECT
                        tarefas.id_tarefa as id_tarefa,
                        tarefas.nome as nome,
                        tarefas.descricao as descricao,
                        tarefas.data_criacao as data_criacao,
                        tarefas.data_conclusao as data_conclusao,
                        status.nome_status as status
                    FROM 
                        tarefas
                    JOIN
                        status ON tarefas._id_status = status.id_status";
            $result = $mysqli->query($sql);
            if ($result->num_rows > 0) {
                // Enquanto existirem registros, incrementa o html da tabela de tarefas
                while ($row = $result->fetch_assoc()) {
                    $row['data_conclusao'] == null ? $dataConclusao = "Não concluída" : $dataConclusao = $row['data_conclusao'];
                    $row['status'] == "Pendente" ? $status = '<span class="bg-danger rounded p-1 text-light">' . $row['status'] . '</span>' : $status = '<span class="bg-success rounded p-1 text-light">' . $row['status'] . '</span>';
                    $htmlTabela .= '<tr>
                                        <th scope="row">' . $row['nome'] . '</th>
                                        <td>' . $row['descricao'] . '</td>
                                        <td>' . $row['data_criacao'] . '</td>
                                        <td>' . $dataConclusao . '</td>
                                        <td>' . $status . '</td>
                                        <td class="text-success text-center"><i class="pointer success-hover fa-solid fa-pen-to-square" id="editar_' . $row["id_tarefa"] . '" onclick="editarTarefa($(this).attr(' . "'id'" . '))"></i></td>
                                        <td class="text-success text-center"><i class="pointer success-hover fa-solid fa-trash" id="excluir_' . $row["id_tarefa"] . '" onclick="excluirTarefa($(this).attr(' . "'id'" . '))"></i></td>
                                    </tr>';
                }
            } else
                $htmlTabela = '<tr><th class="text-center scope="row" colspan="7"><span>Nenhuma tarefa encontrada</span></th></tr>';
            ?>

            <!-- Tabela -->
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="text-success" scope="col">Nome</th>
                            <th class="text-success" scope="col">Descrição</th>
                            <th class="text-success" scope="col">Criação</th>
                            <th class="text-success" scope="col">Conclusão</th>
                            <th class="text-success" scope="col">Status</th>
                            <th class="text-success text-center" scope="col">Editar</th>
                            <th class="text-success text-center" scope="col">Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?= $htmlTabela; ?>
                        <!--<tr>
                            <th scope="row">1</th>
                            <td>Cell</td>
                            <td>Cell</td>
                            <td>Cell</td>
                            <td>Cell</td>
                            <td class="text-success text-center"><i class="pointer success-hover fa-solid fa-pen-to-square"></i></td>
                            <td class="text-success text-center"><i class="pointer success-hover fa-solid fa-trash"></i></td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Cell</td>
                            <td>Cell</td>
                            <td>Cell</td>
                            <td>Cell</td>
                            <td class="text-success text-center pointer"><i class="pointer success-hover fa-solid fa-pen-to-square"></i></td>
                            <td class="text-success text-center pointer"><i class="pointer success-hover fa-solid fa-trash"></i></td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Cell</td>
                            <td>Cell</td>
                            <td>Cell</td>
                            <td>Cell</td>
                            <td class="text-success text-center"><i class="pointer success-hover fa-solid fa-pen-to-square"></i></td>
                            <td class="text-success text-center"><i class="pointer success-hover fa-solid fa-trash"></i></td>
                        </tr> -->
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Floating Button (incluir nova tarefa) -->
        <div class="floating-btn pointer success-hover-background box-shadow-padrao">
            <i class="fa fa-plus plus"></i>
        </div>
    </main>
</body>

</html>