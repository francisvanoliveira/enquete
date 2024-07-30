<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login do Administrador</title>
</head>
<body>
    <form action="admin_verificar.php" method="POST">
        Usuário: <input type="text" name="username" required><br>
        Senha: <input type="password" name="password" required><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
