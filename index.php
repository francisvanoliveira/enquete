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
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <title>Sistema de Pesquisa</title>
 
</head>

<body id="principal">

    <div id="login">

        <div class="caixa">
            
            <img src="img/logo.jpg" alt="">
            <h1>PESQUISA</h1>
            <p>DaVinci Hotel</p>

            <form @submit.prevent="verificarCPF">
                <div class="cpf">
                    <input type="text" v-model="cpf" placeholder="Digite seu CPF" required>
                </div>
    
                <div class="entrar">
                    <input type="submit" value="Acessar">
                </div>
            </form>
            <div v-if="mensagem" class="alert">{{ mensagem }}</div>
            

        </div>       

    </div>

    <footer>
        Desenvolvido por GR7 Tecnologia
    </footer>

    <script>
        new Vue({
            el: '.caixa',
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
