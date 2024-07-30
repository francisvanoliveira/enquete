<?php
session_start();
include 'db.php';

$username = $_POST['username'];
$password = $_POST['password'];

// Preparar e executar a consulta para evitar SQL Injection
$sql = $conn->prepare("SELECT * FROM admin WHERE username = ?");
$sql->bind_param("s", $username);
$sql->execute();
$result = $sql->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        $_SESSION['admin'] = $username;
        header("Location: apuracao.php");
        exit();
    } else {
        echo "Senha incorreta!";
    }
} else {
    echo "Usuário não encontrado!";
}

$conn->close();
?>

