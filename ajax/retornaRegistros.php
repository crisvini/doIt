<?php
session_start();
// Inclusão do arquivo de conexão
include("../connection/conexao.php");

$sql = "SELECT
            permissao_visualizar,
            permissao_editar,
            permissao_excluir
        FROM 
            usuarios
        WHERE
            email ='" . $_SESSION["email"] . "'";
if (mysqli_fetch_assoc(mysqli_query($mysqli, $sql))["permissao_visualizar"] == 1) {
    mysqli_fetch_assoc(mysqli_query($mysqli, $sql))["permissao_editar"] == 1 ? $permissao_editar = '" onclick="editarTarefa($(this).attr(' . "'id'" . '))"' : $permissao_editar = '" onclick="erroPermissao(' . "'Você não possui permissão para editar tarefas, contate um administrador para mais informações'" . ')"';
    mysqli_fetch_assoc(mysqli_query($mysqli, $sql))["permissao_excluir"] == 1 ? $permissao_excluir = '" onclick="excluirTarefa($(this).attr(' . "'id'" . '))"' : $permissao_excluir = '" onclick="erroPermissao(' . "'Você não possui permissão para excluir tarefas, contate um administrador para mais informações'" . ')"';
    $htmlTabela = ' <thead>
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
                    <tbody>';
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
            $row['status'] == "Concluída" ? $status = '<span class="bg-success rounded p-1 text-light">' . $row['status'] . '</span>' : $status = '<span class="bg-danger rounded p-1 text-light">' . $row['status'] . '</span>';
            $row['status'] == "Concluída" ? $backgroundColor = ' class="green-table-row"' : $backgroundColor = '';
            $htmlTabela .= '<tr' . $backgroundColor . '>
                                <th scope="row">' . $row['nome'] . '</th>
                                <td>' . $row['descricao'] . '</td>
                                <td>' . $row['data_criacao'] . '</td>
                                <td>' . $dataConclusao . '</td>
                                <td>' . $status . '</td>
                                <td class="text-success text-center"><i class="pointer success-hover fa-solid fa-pen-to-square" id="editar_' . $row["id_tarefa"] . $permissao_editar . '></i></td>
                                <td class="text-success text-center"><i class="pointer success-hover fa-solid fa-trash" id="excluir_' . $row["id_tarefa"] . $permissao_excluir . '></i></td>
                            </tr>';
        }
    } else
        $htmlTabela = '<tr><th class="text-center scope="row" colspan="7"><span>Nenhuma tarefa encontrada</span></th></tr>';

    echo $htmlTabela . '</tbody>';
} else {
    $htmlTabela = '<thead>
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
                        <tr>
                            <th class="text-center scope="row" colspan="7">
                                <span>Você não possui permissão para visualizar os registros, contate um administrador para mais informações</span>
                            </th>
                        </tr>
                    </tbody>';
    echo $htmlTabela;
}
