<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';
require('fpdf/fpdf.php');

// Definir fuso horário para Manaus/AM
date_default_timezone_set('America/Manaus');

// Gerar código de autenticação único
$auth_code = bin2hex(random_bytes(8));

// Obter resultados da votação
$sql = "SELECT voto, COUNT(*) as count FROM votos GROUP BY voto ORDER BY count DESC";
$result = $conn->query($sql);

// Obter total de votos
$total_sql = "SELECT COUNT(*) as total FROM votos";
$total_result = $conn->query($total_sql);
$total_row = $total_result->fetch_assoc();
$total_votos = $total_row['total'];

// Preparar dados para o relatório
$votos = [];
$porcentagens = [];
$vencedor = '';
$max_votos = 0;

while ($row = $result->fetch_assoc()) {
    $votos[$row['voto']] = $row['count'];
    $porcentagens[$row['voto']] = ($row['count'] / $total_votos) * 100;
    if ($row['count'] > $max_votos) {
        $max_votos = $row['count'];
        $vencedor = $row['voto'];
    }
}

// Obter data e hora atuais
$dataHora = date('Y-m-d H:i:s');

// Armazenar o código de autenticação e a data/hora no banco de dados
$stmt = $conn->prepare("INSERT INTO relatorios (auth_code, created_at) VALUES (?, ?)");
$stmt->bind_param("ss", $auth_code, $dataHora);
$stmt->execute();

// Criar o PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Título
$pdf->Cell(0, 10, utf8_decode('RELATÓRIO DE RESULTADO'), 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, utf8_decode('ESCOLHA DE BENEFÍCIO'), 0, 1, 'C');

// Data e Hora
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 10, utf8_decode('Gerado em: ') . $dataHora, 0, 1, 'C');

// Código de Autenticação
$pdf->Cell(0, 10, utf8_decode('Código de Autenticação: ') . $auth_code, 0, 1, 'C');

// Espaço
$pdf->Ln(10);

// Tabela de Votos
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Total de votos: ' . $total_votos, 0, 1, 'C');
$pdf->Ln(5);

// Centralizar a tabela de votos
$tableWidth = 130; // 80 (opção) + 50 (votos)
$centerX = ($pdf->GetPageWidth() - $tableWidth) / 2;

$pdf->SetX($centerX);
$pdf->Cell(80, 10, utf8_decode('Opção'), 1, 0, 'C');
$pdf->Cell(50, 10, 'Votos', 1, 1, 'C');

$pdf->SetFont('Arial', '', 12);
foreach ($votos as $opcao => $contagem) {
    $pdf->SetX($centerX);
    $pdf->Cell(80, 10, utf8_decode($opcao), 1, 0, 'C');
    $pdf->Cell(50, 10, $contagem, 1, 1, 'C');
}

// Espaço
$pdf->Ln(10);

// Tabela de Porcentagens
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetX($centerX);
$pdf->Cell(80, 10, utf8_decode('Opção'), 1, 0, 'C');
$pdf->Cell(50, 10, 'Porcentagem', 1, 1, 'C');

$pdf->SetFont('Arial', '', 12);
foreach ($porcentagens as $opcao => $porcentagem) {
    $pdf->SetX($centerX);
    $pdf->Cell(80, 10, utf8_decode($opcao), 1, 0, 'C');
    $pdf->Cell(50, 10, number_format($porcentagem, 2) . '%', 1, 1, 'C');
}

// Espaço
$pdf->Ln(20);

// Vencedor
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, utf8_decode('Opção mais votada: ') . utf8_decode($vencedor), 0, 1, 'C');

// Espaço
$pdf->Ln(20);

// Assinatura
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, utf8_decode('Silvia Souza'), 0, 1, 'C');
$pdf->Cell(0, 5, utf8_decode('Departamento Pessoal'), 0, 1, 'C');
$pdf->Cell(0, 6, utf8_decode('EAH-Empresa Amazonense de Hotelaria Ltda'), 0, 1, 'C');

$pdf->Ln(10);

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, utf8_decode('Francisvan Oliveira'), 0, 1, 'C');
$pdf->Cell(0, 5, utf8_decode('Desenvolvedor'), 0, 1, 'C');
$pdf->Cell(0, 6, utf8_decode('GR7 Tecnologia'), 0, 1, 'C');

// Exibir o PDF
$pdf->Output();

$conn->close();
?>
