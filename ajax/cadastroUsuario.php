<?php
error_reporting(E_ERROR | E_PARSE);
include_once("../connection/conexao.php");
session_start();

// Verifica se o e-mail e telefone informados já existem
$sql = "SELECT
            telefone,
            email
        FROM 
            usuarios
        WHERE
            email ='" . $_POST["email"] . "'
        OR
            telefone ='" . $_POST["telefone"] . "'";
$result = $mysqli->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($row["telefone"] == $_POST["telefone"] && $row["email"] == $_POST["email"])
            die("Telefone e e-mail já cadastrados");
        else if ($row["telefone"] == $_POST["telefone"])
            die("Telefone já cadastrado");
        else if ($row["email"] == $_POST["email"])
            die("E-mail já cadastrado");
    }
}

// Insere o usuário no banco de dados
$sql = "INSERT INTO
            usuarios (nome, telefone, email, senha)
        VALUES
            ('" . $_POST["nome"] . "', '" . $_POST["telefone"] . "', '" . $_POST["email"] . "', md5('" . $_POST["senha"] . "'))";
mysqli_query($mysqli, $sql);
// Cria session com dados necessários
$_SESSION["nome"] = $_POST["nome"];
$_SESSION["telefone"] = $_POST["telefone"];
$_SESSION["email"] = $_POST["email"];

echo "Ok";
