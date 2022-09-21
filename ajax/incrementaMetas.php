<?php

session_start();
include("../mysql/conexao.php");

// Consulta os dados das fichas
$sql = "SELECT
            id_exercicio,
            nome,
            repeticoes,
            descanso,
            _id_ficha
        FROM 
            exercicios
        WHERE
            _id_ficha = " . $_SESSION["idFichaDoDia"];
$result = $mysqli->query($sql);

// Atribui o id dos exercícios ao array $idExerciciosArray
$idExerciciosArray = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        array_push($idExerciciosArray, $row["id_exercicio"]);
    }
}

// Seleciona as metas do usuário ainda não completas
$arrayMetasUsuarios = [];
$sql2 = "SELECT
            metas._id_exercicio,
            metas.quantidade,
            metas.pontos,
            metas_usuarios.quantidade_concluida,
            metas_usuarios.completo,
            metas_usuarios._id_metas
        FROM 
            metas_usuarios
        JOIN
            metas
        ON 
            metas_usuarios._id_metas = metas.id_metas
        WHERE
            metas_usuarios._id_usuarios = " . $_SESSION["idUsuario"] . "
        AND
            metas_usuarios.completo = 'false'";
$result2 = $mysqli->query($sql2);
if ($result2->num_rows > 0) {
    $cont = 0;
    while ($row2 = $result2->fetch_assoc()) {
        foreach ($idExerciciosArray as $key => $value) {
            if ($row2["_id_exercicio"] == $value) {
                $arrayQuantidadeCompleta = ["quantidade_ex_realizado_" . $cont =>  $row2["quantidade_concluida"], "ex_completo_" .
                    $cont => $row2["completo"], "id_exercicio" => $row2["_id_exercicio"], "_id_metas" => $row2["_id_metas"], "quantidade_a_completar" => $row2["quantidade"], "pontos" => $row2["pontos"]];
                array_push($arrayMetasUsuarios, $arrayQuantidadeCompleta);
            }
        }
        $cont++;
    }
}

// Atualiza o progresso da meta
foreach ($arrayMetasUsuarios as $key => $value) {
    // Seleciona a quantidade de repetições do exercício
    $sql = "SELECT
                repeticoes
            FROM 
                exercicios
            WHERE
                _id_ficha = " . $_SESSION["idFichaDoDia"] . "
            AND 
                id_exercicio = " . $arrayMetasUsuarios[$key]["id_exercicio"];
    $result =  explode(" ", mysqli_fetch_assoc(mysqli_query($mysqli, $sql))["repeticoes"]);
    $repeticoes = (int) str_replace("x", "", $result[0]) * (int) $result[1];

    $quantidade_concluida = (int) $arrayMetasUsuarios[$key]["quantidade_ex_realizado_" . $key] + $repeticoes;

    if ($quantidade_concluida >= (int) $arrayMetasUsuarios[$key]["quantidade_a_completar"]) {
        // Faz update na conclusão da meta
        $sql = "UPDATE
                    metas_usuarios
                JOIN
                    metas
                SET
                    completo = 'true',
                    quantidade_concluida = " . $quantidade_concluida . "
                WHERE
                    metas._id_exercicio = " . $arrayMetasUsuarios[$key]["id_exercicio"] . "
                AND
                    metas_usuarios._id_metas = " . $arrayMetasUsuarios[$key]["_id_metas"];
        $mysqli->query($sql);

        // Seleciona a pontuação atual do usuário
        $sql = "SELECT
                    pontuacao
                FROM 
                    ranking
                WHERE
                    _id_usuario = " . $_SESSION["idUsuario"];
        $pontuacaoAtual = (int) mysqli_fetch_assoc(mysqli_query($mysqli, $sql))["pontuacao"];

        // Soma a pontuação atual com a pontuação nova
        $novaPontuacao = $pontuacaoAtual + (int) $arrayMetasUsuarios[$key]["pontos"];

        // Incrementa a pontuação do usuário
        $sql = "UPDATE
                    ranking
                SET
                    pontuacao = " . $novaPontuacao . "
                WHERE
                    _id_usuario = " . $_SESSION["idUsuario"];
        $mysqli->query($sql);
    } else {
        // Faz update na quantidade de exercícios concluídos da meta
        $sql = "UPDATE
                    metas_usuarios
                JOIN
                    metas
                SET
                    quantidade_concluida = " . $quantidade_concluida . "
                WHERE
                    metas._id_exercicio = " . $arrayMetasUsuarios[$key]["id_exercicio"] . "
                AND
                    metas_usuarios._id_metas = " . $arrayMetasUsuarios[$key]["_id_metas"];
        $mysqli->query($sql);
    }
}
