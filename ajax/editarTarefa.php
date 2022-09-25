<?php
// Inclusão do arquivo de conexão
include("../connection/conexao.php");

// Atualiza a tarefa 
$sql = "UPDATE
            tarefas
        SET
            nome = '" . $_POST["nome"] . "',
            descricao = '" . $_POST["descricao"] . "',
            _id_status = " . $_POST["status"] . ",
            data_conclusao = IF (" . $_POST["status"] . " = 2, CURRENT_TIMESTAMP(), NULL)
        WHERE
            id_tarefa = " . (int) $_POST["id_tarefa"];
$result = $mysqli->query($sql);

echo "Ok";
