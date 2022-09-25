<?php
require('../lib/fpdf/fpdf.php');
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

class PDF extends FPDF
{

    // Colored table
    function Table($header, $data)
    {
        // Colors, line width and bold font
        $this->SetFillColor(25, 135, 84);
        $this->SetTextColor(255);
        $this->SetDrawColor(0, 0, 0);
        $this->SetLineWidth(.3);
        $this->SetFont('', 'B');
        // Header
        $w = array(17, 17, 67, 35, 35, 20);
        for ($i = 0; $i < count($header); $i++) {
            $this->Cell($w[$i], 5, $header[$i], 1, 0, 'C', true);
        }
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = false;
        $i = 0;
        while ($i < count($data)) {
            $this->Cell(17, 7, $data[$i]["id_tarefa"]);
            $this->Cell(17, 7, $data[$i]["nome"]);
            $this->Cell(67, 7, $data[$i]["descricao"]);
            $this->Cell(35, 7, $data[$i]["data_criacao"]);
            $this->Cell(35, 7, $data[$i]["data_conclusao"]);
            $this->Cell(20, 7, $data[$i]["status"]);
            $this->Ln();
            $i++;
        }
        $this->Cell(array_sum($w), 0, '', 'T');
    }
}

$pdf = new PDF();
// Nome das colunas
$header = array('id_tarefa', 'nome', 'descricao', 'data_criacao', 'data_conclusao', 'status');
$pdf->SetFont('Arial', '', 10);
$pdf->AddPage();
$pdf->Table($header, $arrayTarefas);
$pdf->Output();
