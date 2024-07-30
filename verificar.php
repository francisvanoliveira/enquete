<?php
session_start();
include 'db.php';
header('Content-Type: application/json');

function validaCPF($cpf) {
    // Remove os caracteres especiais
    $cpf = preg_replace('/[^0-9]/', '', $cpf);

    // Verifica se o número de dígitos é igual a 11
    if (strlen($cpf) != 11) {
        return false;
    }

    // Verifica se todos os dígitos são iguais
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    // Calcula os dígitos verificadores para verificar se o CPF é válido
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }
    return true;
}

$cpf = preg_replace('/[^0-9]/', '', $_POST['cpf']);

if (!validaCPF($cpf)) {
    echo json_encode(['success' => false, 'message' => 'CPF inválido!']);
    exit();
}

// Verificar se o CPF já votou
$sql = "SELECT * FROM votos WHERE cpf='$cpf'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo json_encode(['success' => false, 'message' => 'Você já votou!']);
} else {
    $_SESSION['cpf'] = $cpf;
    echo json_encode(['success' => true]);
}

$conn->close();
?>
