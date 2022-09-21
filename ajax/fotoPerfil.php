<?php
// error_reporting(E_ERROR | E_PARSE);
session_start();

include("../mysql/conexao.php");

// Altera o objetivo
$sql = "UPDATE 
            usuarios
        SET 
            foto_perfil = '" . $_POST["base64"] . "'
        WHERE 
            cpf = '" .  $_SESSION["cpf"] . "'";
mysqli_query($mysqli, $sql);

die($sql);
