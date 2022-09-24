<?php
// Inclusão do arquivo de conexão
include("../connection/conexao.php");

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
        $row['status'] == "Concluída" ? $status = '<span class="bg-success rounded p-1 text-light">' . $row['status'] . '</span>' : $status = '<span class="bg-danger rounded p-1 text-light">' . $row['status'] . '</span>';
        $row['status'] == "Concluída" ? $backgroundColor = ' class="green-table-row"' : $backgroundColor = '';
        $htmlTabela .= '<tr' . $backgroundColor . '>
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

echo $htmlTabela;
