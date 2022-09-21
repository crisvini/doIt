<?php
error_reporting(E_ERROR | E_PARSE);
session_start();

include("../mysql/conexao.php");

// Altera o objetivo
$sql = "UPDATE 
            usuarios
        SET 
            ultima_ficha_completa  = " . $_POST["idFicha"] . "
        WHERE 
            cpf = '" .  $_SESSION["cpf"] . "'";
mysqli_query($mysqli, $sql);
