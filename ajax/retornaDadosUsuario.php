<?php
// Inclusão do arquivo de conexão
include("../connection/conexao.php");

// Busca os dados da tarefa
$sql = "SELECT
           permissao_visualizar,
           permissao_editar,
           permissao_cadastrar,
           permissao_excluir,
           permissao_imprimir
        FROM 
            usuarios
        WHERE
            id_usuarios = " . (int) $_POST["id"];
echo json_encode([
    "permissao_visualizar" => '<option value="' . mysqli_fetch_assoc(mysqli_query($mysqli, $sql))["permissao_visualizar"] . '" selected>' . (mysqli_fetch_assoc(mysqli_query($mysqli, $sql))["permissao_visualizar"] == 1 ? 'Sim' : 'Não') . '</option>' .
        '<option value="' . (mysqli_fetch_assoc(mysqli_query($mysqli, $sql))["permissao_visualizar"] == 1 ? 0 : 1) . '">' . (mysqli_fetch_assoc(mysqli_query($mysqli, $sql))["permissao_visualizar"] == 1 ? 'Não' : 'Sim') . '</option>',
    "permissao_editar" => '<option value="' . mysqli_fetch_assoc(mysqli_query($mysqli, $sql))["permissao_editar"] . '" selected>' . (mysqli_fetch_assoc(mysqli_query($mysqli, $sql))["permissao_editar"] == 1 ? 'Sim' : 'Não') . '</option>' .
        '<option value="' . (mysqli_fetch_assoc(mysqli_query($mysqli, $sql))["permissao_editar"] == 1 ? 0 : 1) . '">' . (mysqli_fetch_assoc(mysqli_query($mysqli, $sql))["permissao_editar"] == 1 ? 'Não' : 'Sim') . '</option>',
    "permissao_cadastrar" => '<option value="' . mysqli_fetch_assoc(mysqli_query($mysqli, $sql))["permissao_cadastrar"] . '" selected>' . (mysqli_fetch_assoc(mysqli_query($mysqli, $sql))["permissao_cadastrar"] == 1 ? 'Sim' : 'Não') . '</option>' .
        '<option value="' . (mysqli_fetch_assoc(mysqli_query($mysqli, $sql))["permissao_cadastrar"] == 1 ? 0 : 1) . '">' . (mysqli_fetch_assoc(mysqli_query($mysqli, $sql))["permissao_cadastrar"] == 1 ? 'Não' : 'Sim') . '</option>',
    "permissao_excluir" => '<option value="' . mysqli_fetch_assoc(mysqli_query($mysqli, $sql))["permissao_excluir"] . '" selected>' . (mysqli_fetch_assoc(mysqli_query($mysqli, $sql))["permissao_excluir"] == 1 ? 'Sim' : 'Não') . '</option>' .
        '<option value="' . (mysqli_fetch_assoc(mysqli_query($mysqli, $sql))["permissao_excluir"] == 1 ? 0 : 1) . '">' . (mysqli_fetch_assoc(mysqli_query($mysqli, $sql))["permissao_excluir"] == 1 ? 'Não' : 'Sim') . '</option>',
    "permissao_imprimir" => '<option value="' . mysqli_fetch_assoc(mysqli_query($mysqli, $sql))["permissao_imprimir"] . '" selected>' . (mysqli_fetch_assoc(mysqli_query($mysqli, $sql))["permissao_imprimir"] == 1 ? 'Sim' : 'Não') . '</option>' .
        '<option value="' . (mysqli_fetch_assoc(mysqli_query($mysqli, $sql))["permissao_imprimir"] == 1 ? 0 : 1) . '">' . (mysqli_fetch_assoc(mysqli_query($mysqli, $sql))["permissao_imprimir"] == 1 ? 'Não' : 'Sim') . '</option>'
]);
