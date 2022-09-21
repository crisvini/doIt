<?php
error_reporting(E_ERROR | E_PARSE);
include("../mysql/conexao.php");

$cpfValido = false;
$emailValido = false;

// Verifica se o cpf já está cadastrado
$sql = "SELECT
            cpf
        FROM 
            usuarios
        WHERE
            cpf ='" . $_POST["cpf"] . "'";
if (mysqli_fetch_assoc(mysqli_query($mysqli, $sql))["cpf"] == null)
    $cpfValido = true;

// Verifica se o email já está cadastrado
$sql = "SELECT
            email
        FROM 
            usuarios
        WHERE
            email ='" . $_POST["email"] . "'";
if (mysqli_fetch_assoc(mysqli_query($mysqli, $sql))["email"] == null)
    $emailValido = true;

// Se o email ou o cpf já estiver cadastrado, retorna false
if ($cpfValido != true || $emailValido != true)
    echo 'invalido';
else
    echo 'valido';
