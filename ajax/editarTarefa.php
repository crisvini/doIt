<?php
// Inclusão do arquivo de conexão
include("../connection/conexao.php");

$sql = "UPDATE
            tarefas
        SET
            nome = '" . $_POST["nome"] . "',
            descricao = '" . $_POST["descricao"] . "',
            _id_status = " . $_POST["status"] . "
        WHERE
            id_tarefa = " . (int) $_POST["id_tarefa"];
$result = $mysqli->query($sql);

echo "Ok";
