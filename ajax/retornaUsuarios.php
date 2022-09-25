<?php
session_start();
// Inclusão do arquivo de conexão
include("../connection/conexao.php");

$htmlTabela = '';
$sql = "SELECT
            id_usuarios,
            nome,
            telefone,
            email,
            permissao_visualizar,
            permissao_editar,
            permissao_cadastrar,
            permissao_excluir,
            permissao_imprimir
        FROM
            usuarios
        WHERE
            admin = false
        ORDER BY 
            id_usuarios
        ASC";
$result = $mysqli->query($sql);
if ($result->num_rows > 0) {
    // Enquanto existirem registros, incrementa o html da tabela de usuários
    while ($row = $result->fetch_assoc()) {
        $htmlTabela .= ' <tr>
                            <th scope="col">' . $row["id_usuarios"] . '</th>
                            <td scope="col">' . $row["nome"] . '</td>
                            <td scope="col">' . $row["telefone"] . '</td>
                            <td scope="col">' . $row["email"] . '</td>
                            <td scope="col">' . ($row["permissao_visualizar"] == 1 ? 'Sim' : 'Não') . '</td>
                            <td scope="col">' . ($row["permissao_editar"] == 1 ? 'Sim' : 'Não') . '</td>
                            <td scope="col">' . ($row["permissao_cadastrar"] == 1 ? 'Sim' : 'Não') . '</td>
                            <td scope="col">' . ($row["permissao_excluir"] == 1 ? 'Sim' : 'Não') . '</td>
                            <td scope="col">' . ($row["permissao_imprimir"] == 1 ? 'Sim' : 'Não') . '</td>
                            <td class="text-success text-center" scope="col"><i class="pointer success-hover fa-solid fa-pen-to-square" id="excluir_' . $row["id_usuarios"] . '" onclick="editarPermissoesUsuarios($(this).attr(' . "'id'" . '))"><i></td>
                            <td class="text-success text-center" scope="col"><i class="pointer success-hover fa-solid fa-trash" id="excluir_' . $row["id_usuarios"] . '" onclick="excluirUsuario($(this).attr(' . "'id'" . '))"><i></td>
                        </tr>';
    }
}
echo $htmlTabela;
