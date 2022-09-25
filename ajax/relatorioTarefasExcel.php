<?php
error_reporting(E_ERROR | E_PARSE);

include("../connection/conexao.php");
include("../class/Funcoes.php");

$arrayTarefas = [];
$sql = "SELECT
            tarefas.id_tarefa as id_tarefa,
            tarefas.nome as nome,
            tarefas.descricao as descricao,
            tarefas.data_criacao as data_criacao,
            tarefas.data_conclusao as data_conclusao,
            status.nome_status as status
        FROM 
            tarefas
        JOIN
            status ON tarefas._id_status = status.id_status
        ORDER BY
            id_tarefa
        ASC";
$result = $mysqli->query($sql);
// Se existir um registro, executa o código abaixo 
if ($result->num_rows > 0) {
    // Enquanto existirem registros, incrementa o html da tabela de tarefas
    while ($row = $result->fetch_assoc()) {
        array_push($arrayTarefas, [
            "id_tarefa" => $row["id_tarefa"],
            "nome" => Funcoes::tirarAcentos($row["nome"]),
            "descricao" => Funcoes::tirarAcentos($row["descricao"]),
            "data_criacao" => $row["data_criacao"],
            "data_conclusao" => $row["data_conclusao"] == null ? "Nao concluida" : $row["data_conclusao"],
            "status" => Funcoes::tirarAcentos($row["status"])
        ]);
    }
}

// Nome do arquivo e header para fazer o download
$file_name = "relatorio_tarefas_" . date("Y-m-d") . ".xls";
header("Content-Disposition: attachment; filename=\"$file_name\"");
header("Content-Type: application/vnd.ms-excel");

// Define o nome das colunas na primeira linha
$column_names = false;
// Adiciona as linhas ao arquivo
foreach ($arrayTarefas as $row) {
    if (!$column_names) {
        echo implode("\t", array_keys($row)) . "\n";
        $column_names = true;
    }
    echo implode("\t", array_values($row)) . "\n";
}
exit;

// echo "<script>window.close();</script>";
