<?php
session_start(); // Inicia a sessão para armazenar dados entre páginas

// Verifica se o método da requisição é POST (ou seja, o formulário foi enviado)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"]; // Obtém o email enviado pelo formulário
    $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT); // Cria um hash seguro da senha

    // Lê o conteúdo do arquivo "usuarios.txt", cada linha vira um item do array
    $usuarios = file("usuarios.txt", FILE_IGNORE_NEW_LINES);

    // Verifica se o email já está cadastrado
    foreach ($usuarios as $usuario) {
        list($salvo_email) = explode(";", $usuario); // Separa email e senha pelo separador ";"
        if ($email == $salvo_email) {
            // Se o email já existir, redireciona para a página de login
            header("Location: login.php");
            exit; // Encerra o script após o redirecionamento
        }
    }

    // Se o email não estiver cadastrado, salva o novo usuário no arquivo
    file_put_contents("usuarios.txt", "$email;$senha" . PHP_EOL, FILE_APPEND); // Adiciona ao final do arquivo

    // Envia direto para o login
    header("Location: login.php");}
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="cadastro.css"> <!-- Importa o CSS -->
    <title>Cadastro</title>
    
    <!-- Google Fonts para a fonte Raleway -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <!-- Ícone do site -->
    <link rel="shortcut icon" type="imagex/png" href="../imagens/logo.ico">
</head>

<body>
    <!-- Cabeçalho com o logo -->
    <div class="header">
        <a href="../index.html"> <!-- Link que volta para a página inicial -->
            <img src="../imagens/Logo_TheBest.png" alt="logo" class="logo"> <!-- Logo do site -->
        </a>
    </div>

    <!-- Container principal -->
    <div class="principal">
        <!-- Formulário de cadastro -->
        <div class="formulario" style="margin-top: 5%;">
            <div class="titulo">
                <h1 class="textTitulo">Cadastro</h1> <!-- Título do formulário -->
            </div>

            <!-- Formulário com método POST (enviado para a mesma página) -->
            <form method="post">
                <div class="divUsuarioEmailSenha">
                    <!-- Campo de e-mail -->
                    <input type="email" placeholder="Email" name="email" class="FormUsuarioEmailSenhaConf" required><br>
                    <!-- Campo de senha -->
                    <input type="password" placeholder="Senha" name="senha" class="FormUsuarioEmailSenhaConf" required><br>
                </div>
                <!-- Botão de envio do formulário -->
                <input type="submit" value="Cadastrar" class="botaoEnviar">
            </form>

            <!-- Link para página de login -->
            <p class="OpcoesLogin">Já tem cadastro? <a href="login.php">Entre</a></p>
        </div>
    </div>
</body>

</html>