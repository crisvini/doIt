<?php
session_start();
// Inclusão do arquivo de conexão
include("../connection/conexao.php");

$sql = "SELECT
            permissao_cadastrar
        FROM 
            usuarios
        WHERE
            email ='" . $_SESSION["email"] . "'";
if (mysqli_fetch_assoc(mysqli_query($mysqli, $sql))["permissao_cadastrar"] == 1) {
    $floatingButton = ' <div class="floating-btn pointer success-hover-background box-shadow-padrao" onclick="insereTarefa();">
                            <i class="fa fa-plus plus"></i>
                        </div>';
    echo $floatingButton;
}
