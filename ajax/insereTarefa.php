<?php
error_reporting(E_ERROR | E_PARSE);
include_once("../connection/conexao.php");
session_start();

$sql = "INSERT INTO
            tarefas (nome, descricao)
        VALUES
            ('" . $_POST["nome"] . "', '" . $_POST["descricao"] . "')";
mysqli_query($mysqli, $sql);

echo "Ok";
