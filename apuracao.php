<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}
include 'db.php';

// Obter resultados da votação
$sql = "SELECT voto, COUNT(*) as count FROM votos GROUP BY voto";
$result = $conn->query($sql);

// Obter total de votos
$total_sql = "SELECT COUNT(*) as total FROM votos";
$total_result = $conn->query($total_sql);
$total_row = $total_result->fetch_assoc();
$total_votos = $total_row['total'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Apuração dos Votos</title>
</head>
<body>
    <h1>Resultados da Votação</h1>
    <p>Total de votos: <?php echo $total_votos; ?></p>
    <table border="1">
        <tr>
            <th>Opção</th>
            <th>Votos</th>
        </tr>
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row['voto'] . "</td><td>" . $row['count'] . "</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>
