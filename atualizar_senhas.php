<?php
include 'db.php';

// Consulta para obter todas as senhas existentes
$sql = "SELECT id, username, password FROM admin";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $username = $row['username'];
        $old_password = $row['password'];

        // Verificar se a senha já está hasheada
        if (password_get_info($old_password)['algo'] == 0) {
            // Se a senha não está hasheada, hash a senha antiga
            $new_password = password_hash($old_password, PASSWORD_DEFAULT);

            // Atualizar a senha no banco de dados
            $update_sql = $conn->prepare("UPDATE admin SET password = ? WHERE id = ?");
            $update_sql->bind_param("si", $new_password, $id);

            if ($update_sql->execute()) {
                echo "Senha atualizada para o usuário: $username<br>";
            } else {
                echo "Erro ao atualizar a senha para o usuário: $username - " . $conn->error . "<br>";
            }
        } else {
            echo "A senha para o usuário $username já está hasheada.<br>";
        }
    }
} else {
    echo "Nenhum usuário encontrado.";
}

$conn->close();
?>
