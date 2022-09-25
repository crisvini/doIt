<?php
error_reporting(E_ERROR | E_PARSE);
include_once("../connection/conexao.php");
session_start();

// Apaga a tarefa
$sql = "DELETE 
            FROM 
        tarefas
            WHERE
        id_tarefa = " . (int) $_POST["id"];
mysqli_query($mysqli, $sql);

echo "Ok";
