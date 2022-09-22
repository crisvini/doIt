<?php
error_reporting(E_ERROR | E_PARSE);
session_start();

include("../mysql/conexao.php");

$autenticado = false;

// Busca o email e a senha no banco de dados
$sql = "SELECT
            telefone,
            email
        FROM 
            usuarios
        WHERE
            email ='" . $_POST["email"] . "'
        OR
            telefone ='" . $_POST["telefone"] . "'";
die($sql);
var_dump(mysqli_fetch_assoc(mysqli_query($mysqli, $sql))["telefone"]);
die();
if (mysqli_fetch_assoc(mysqli_query($mysqli, $sql))["telefone"] == null && mysqli_fetch_assoc(mysqli_query($mysqli, $sql))["email"] == null) {
    $sql2 = "INSERT INTO
                usuarios (nome, telefone, email, senha)
            VALUES
                ('" . $_POST["nome"] . "', '" . $_POST["telefone"] . "', '" . $_POST["email"] . "', md5('" . $_POST["senha"] . "'))";
    mysqli_query($mysqli, $sql2);
    $autenticado = true;
    // Cria session com dados necessários
    $_SESSION["nome"] = mysqli_fetch_assoc(mysqli_query($mysqli, $sql))["email"];
    $_SESSION["telefone"] = mysqli_fetch_assoc(mysqli_query($mysqli, $sql))["nome"];
    $_SESSION["email"] = mysqli_fetch_assoc(mysqli_query($mysqli, $sql))["cpf"];
}

echo $autenticado;
