<?php
session_start();
if (!isset($_SESSION['cpf'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Votação DaVinci Hotel</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <form action="registrar_voto.php" method="POST">
        <p>Escolha uma opção</p>
        <input type="radio" id="Gympass" name="voto" value="Gympass" required>
        <label for="Gympass">Gympass</label>
        <input type="radio" id="PlanodeSaúde" name="voto" value="Plano de Saúde" required>
        <label for="PlanodeSaúde">Plano de Saúde</label>
        <input type="radio" id="SalãodeBeleza" name="voto" value="Salão de Beleza" required>
        <label for="SalãodeBeleza">Salão de Beleza</label>
        <input type="submit" value="Votar">
    </form>
</body>
</html>
