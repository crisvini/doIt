<?php
// Inclusão do arquivo de conexão
include("../connection/conexao.php");

// Seleciona o status da tarefa
$sql = "SELECT
           tarefas.nome as nome,
           tarefas.descricao as descricao,
           tarefas._id_status as id_status,
           status.nome_status as nome_status
        FROM 
            tarefas
        JOIN
            status ON  tarefas._id_status =  status.id_status
        WHERE
            id_tarefa = " . (int) $_POST["id"];
$statusTarefa =  mysqli_fetch_assoc(mysqli_query($mysqli, $sql))["nome_status"];
// Variável que gera a option
$htmlStatus = '<option value="' . mysqli_fetch_assoc(mysqli_query($mysqli, $sql))["id_status"] . '" selected>' . mysqli_fetch_assoc(mysqli_query($mysqli, $sql))["nome_status"] . '</option>';

$sql = "SELECT
            id_status,
            nome_status
        FROM 
            status
        WHERE
            nome_status != '" . $statusTarefa . "'";
$result = $mysqli->query($sql);
if ($result->num_rows > 0) {
    // Enquanto existirem registros, incrementa o html do select de status
    while ($row = $result->fetch_assoc()) {
        $htmlStatus .= '<option value="' . $row['id_status'] . '">' . $row['nome_status'] . '</option>';
    }
}

echo $htmlStatus;
