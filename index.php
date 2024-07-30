<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sistema de Enquete DaVinci Hotel</title>
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="header">
        <p>DaVinci Hotel</p>
    </div>
    <div id="app">
        <form @submit.prevent="verificarCPF">
            <input type="text" v-model="cpf" placeholder="Digite seu CPF" required>
            <input type="submit" value="Verificar">
        </form>
        <div v-if="mensagem" class="alert">{{ mensagem }}</div>
    </div>
    <footer>
        Desenvolvido por GR7Sites
    </footer>

    <script>
        new Vue({
            el: '#app',
            data: {
                cpf: '',
                mensagem: ''
            },
            methods: {
                verificarCPF() {
                    // Remover pontuações e traços do CPF
                    const cpfNumerico = this.cpf.replace(/\D/g, '');
                    fetch('verificar.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: `cpf=${cpfNumerico}`
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            window.location.href = 'voto.php';
                        } else {
                            this.mensagem = data.message;
                        }
                    });
                }
            }
        });
    </script>
</body>
</html>
