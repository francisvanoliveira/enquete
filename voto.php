<?php
session_start();
if (!isset($_SESSION['cpf'])) {
    header("Location: index.php");
    exit();
}
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
    <title>Votação</title>
 
</head>

<body id="principal">

    <div id="login">

        <div class="caixa">
            
            <img src="img/logo.jpg" alt="">
            <h1>PESQUISA</h1>
            <p>Escolha uma das Opções</p>

            <form action="registrar_voto.php" method="POST">
                <div class="cpf">
                    <input type="radio" id="Gympass" name="voto" value="Gympass" required>
                    <label for="Gympass">Gympass</label>
                    <input type="radio" id="PlanodeSaúde" name="voto" value="Plano de Saúde" required>
                    <label for="PlanodeSaúde">Plano de Saúde</label>
                    <input type="radio" id="SalãodeBeleza" name="voto" value="Salão de Beleza" required>
                    <label for="SalãodeBeleza">Salão de Beleza</label>
                </div>
    
                <div class="entrar">
                    <input type="submit" value="Votar">
                </div>
            </form>
            

        </div>       

    </div>

    <footer>
        Desenvolvido por GR7 Tecnologia
    </footer>
    
</body>

</html>
