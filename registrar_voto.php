<?php
session_start();
include 'db.php';

$cpf = $_SESSION['cpf'];
$voto = $_POST['voto'];

// Inserir voto no banco de dados
$sql = "INSERT INTO votos (cpf, voto) VALUES ('$cpf', '$voto')";
if ($conn->query($sql) === TRUE) {
    session_unset();
    session_destroy();
    header("Location: obrigado.php");
} else {
    echo "Erro ao registrar voto: " . $conn->error;
}

$conn->close();
?>
