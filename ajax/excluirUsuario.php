<?php
error_reporting(E_ERROR | E_PARSE);
include_once("../connection/conexao.php");
session_start();

// Deleta usuário do banco de dados
$sql = "DELETE FROM 
            usuarios 
        WHERE id_usuarios = " . (int) $_POST["id"];
mysqli_query($mysqli, $sql);

echo "Ok";
