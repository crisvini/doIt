<?php
session_start();
// Inclusão do arquivo de conexão
include("../connection/conexao.php");

$sql = "SELECT
            permissao_visualizar,
            permissao_imprimir
        FROM 
            usuarios
        WHERE
            email ='" . $_SESSION["email"] . "'";
// Se o usuário tiver permissão de visualização, retorna o botão de retorno de tarefas
if (mysqli_fetch_assoc(mysqli_query($mysqli, $sql))["permissao_visualizar"] == 1) {
    $htmlAcoes = '<i class="pointer success-hover fa-solid fa-rotate-right text-success fs-4 me-3 me-lg-4" onclick="retornaRegistros(true);retornaAcoesRegistros();"></i>';
    // Se o usuário tiver permissão de impressão, retorna o botão de retorno de tarefas, excel e pdf
    if (mysqli_fetch_assoc(mysqli_query($mysqli, $sql))["permissao_imprimir"] == 1) {
        $htmlAcoes .= ' <i class="pointer success-hover fa-solid fa-file-excel text-success fs-4 me-3 me-lg-4"></i>
                        <i class="pointer success-hover fa-solid fa-file-pdf text-success fs-4"></i>';
    }
    echo $htmlAcoes;
}
