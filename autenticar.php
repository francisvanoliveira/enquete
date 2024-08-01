<?php
include 'db.php';

$auth_code = '';
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $auth_code = $_POST['auth_code'];
    $stmt = $conn->prepare("SELECT created_at FROM relatorios WHERE auth_code = ?");
    $stmt->bind_param("s", $auth_code);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($created_at);
        $stmt->fetch();
        $message = "Código de autenticação válido. Relatório gerado em: " . $created_at;
    } else {
        $message = "Código de autenticação inválido.";
    }

    $stmt->close();
    $conn->close();
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
    <title>Autenticação</title>
 
</head>

<body id="principal">

    <div id="login">

        <div class="caixa">
            
            <img src="img/logo.jpg" alt="">
            <h1>PESQUISA</h1>
            <p>DaVinci Hotel</p>

            <form method="post">
                <div class="cpf">
                    <input type="text" id="auth_code" name="auth_code" placeholder="Código de Autenticação" required>
                </div>
    
                <div class="entrar">
                    <input type="submit" value="Verificar">
                </div>
            </form>
            <p><?php echo htmlspecialchars($message); ?></p>
            <a href="https://davinci.gr7tecnologia.com.br/">Início</a>
            

        </div>       

    </div>

    <footer>
        Desenvolvido por GR7Sites
    </footer>
    
</body>

</html>