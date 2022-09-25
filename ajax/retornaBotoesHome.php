<?php
session_start();
// Inclusão do arquivo de conexão
include("../connection/conexao.php");

$sql = "SELECT
            admin
        FROM
            usuarios
        WHERE
            email = '" . $_SESSION["email"] . "'";
$htmlBotoesHome = '<a href="./tarefas.php"><button class="mt-3 mt-lg-0 w-100 w-lg-50 btn btn-lg btn-success rounded"><i class="fa-solid fa-list-check"></i> Tarefas</button></a>';
// Se o perfil do usuário for de admin, exibe o botão de usuários e de tarefas na home, caso contrário, exibe somente o botão de tarefas
if (mysqli_fetch_assoc(mysqli_query($mysqli, $sql))["admin"] == 1) {
    $htmlBotoesHome = ' <a href="./tarefas.php"><button class="mt-3 mt-lg-0 w-100 w-lg-50 btn btn-lg btn-success rounded"><i class="fa-solid fa-list-check"></i> Tarefas</button></a>
                        <a href="./usuarios.php"><button class="mt-3 w-100 w-lg-50 btn btn-lg btn-success rounded"><i class="fa-solid fa-user"></i> Usuários</button></a>';
}

echo $htmlBotoesHome;
