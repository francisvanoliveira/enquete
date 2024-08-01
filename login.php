<?php
session_start();
?>

<!DOCTYPE html>

<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" href="css/style.css">
    <title>Administrador</title>
 
</head>

<body id="principal">

    <div id="login">

        <div class="caixa">
            
            <img src="img/logo.jpg" alt="">
            <h1>PESQUISA</h1>
            <p>DaVinci Hotel</p>

            <form action="admin_verificar.php" method="POST">
                <div class="cpf">
                    <input type="text" name="username" placeholder="Usuário" required><br>
                    <input type="password" name="password" placeholder="Senha" required><br>
                </div>
    
                <div class="entrar">
                    <input type="submit" value="Login">
                </div>
            </form>
            
            <a href="https://davinci.gr7tecnologia.com.br/">Início</a>
            

        </div>       

    </div>

    <footer>
        Desenvolvido por GR7Sites
    </footer>
    
</body>

</html>
