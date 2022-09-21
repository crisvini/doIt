<?php
error_reporting(E_ERROR | E_PARSE);
session_start();

// Arquivo de conexão
include("../mysql/conexao.php");

// Define a última ficha completa
$ultima_ficha_completa = 0;
if ($_POST["objetivo"] == "emagrecimento")
    $ultima_ficha_completa = 3;
else if ($_POST["objetivo"] == "hipertrofia")
    $ultima_ficha_completa = 6;

// Altera o objetivo
$sql = "UPDATE 
            usuarios
        SET 
            objetivo = '" . $_POST["objetivo"] . "',
            ultima_ficha_completa = " . $ultima_ficha_completa . "
        WHERE 
            cpf = '" .  $_SESSION["cpf"] . "'";
mysqli_query($mysqli, $sql);
