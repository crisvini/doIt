<?php
// Inclusão do arquivo de conexão
include("../connection/conexao.php");

// Atualiza as permissões do usuário
$sql = "UPDATE
            usuarios
        SET
            permissao_visualizar = " . $_POST["permissao_visualizar"] . ",
            permissao_editar = " . $_POST["permissao_editar"] . ",
            permissao_cadastrar = " . $_POST["permissao_cadastrar"] . ",
            permissao_excluir = " . $_POST["permissao_excluir"] . ",
            permissao_imprimir = " . $_POST["permissao_imprimir"] . "
        WHERE
            id_usuarios = " . (int) $_POST["id_usuario"];
$result = $mysqli->query($sql);

echo "Ok";
