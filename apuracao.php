<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}
include 'db.php';

// Obter resultados da votação ordenados pela quantidade de votos (do maior para o menor)
$sql = "SELECT voto, COUNT(*) as count FROM votos GROUP BY voto ORDER BY count DESC";
$result = $conn->query($sql);

// Obter total de votos
$total_sql = "SELECT COUNT(*) as total FROM votos";
$total_result = $conn->query($total_sql);
$total_row = $total_result->fetch_assoc();
$total_votos = $total_row['total'];
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
    <title>Resultado</title>
 
</head>

<body id="principal">

    <div id="login">

        <div class="caixa">
            
            <img src="img/logo.jpg" alt="">
            <h1>PESQUISA</h1>
            <p>Resultado Votação Benefício</p>
            <p>Total de votos: <?php echo $total_votos; ?></p>

            <div class="container">
                <table class="results-table">
                    <thead>
                        <tr>
                            <th>Opção</th>
                            <th>Votos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr><td>" . $row['voto'] . "</td><td>" . $row['count'] . "</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
                
                <form action="relatorio.php" method="post" target="_blank">
                    <div class="relatorio">
                        <input type="submit" value="Relatório">
                    </div>
                </form>

                <form action="logout.php" method="post">
                    <div class="sair">
                        <input type="submit" value="Sair">
                    </div>
                </form>
            </div>
            

        </div>       

    </div>

    <footer>
        Desenvolvido por GR7 Tecnologia
    </footer>
    
</body>

</html>
