<?php
// Inclusão do arquivo de conexão
include("../connection/conexao.php");

// Busca os dados da tarefa
$sql = "SELECT
           tarefas.nome as nome,
           tarefas.descricao as descricao
        FROM 
            tarefas
        WHERE
            id_tarefa = " . (int) $_POST["id"];
echo json_encode([
    "nome" => mysqli_fetch_assoc(mysqli_query($mysqli, $sql))["nome"],
    "descricao" => mysqli_fetch_assoc(mysqli_query($mysqli, $sql))["descricao"]
]);
