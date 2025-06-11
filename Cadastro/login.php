<?php
session_start(); // Inicia a sessão para armazenar dados entre páginas

// Verifica se o formulário foi enviado via método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"]; // Captura o email enviado pelo formulário
    $senha = $_POST["senha"]; // Captura a senha enviada pelo formulário

    // Lê o conteúdo do arquivo "usuarios.txt" linha por linha, ignorando quebras de linha
    $usuarios = file("usuarios.txt", FILE_IGNORE_NEW_LINES);

    // Percorre cada usuário cadastrado
    foreach ($usuarios as $usuario) {
        // Separa o email e a senha salvos no arquivo (separados por ";")
        list($salvo_email, $salvo_senha) = explode(";", $usuario);

        // Verifica se o email e a senha digitados batem com os armazenados
        if ($email == $salvo_email && password_verify($senha, $salvo_senha)) {
            // Se válidos, salva o email na sessão
            $_SESSION["usuario_email"] = $email;

            // Redireciona para a página inicial
            header("Location: /index.html");
            exit; // Encerra o script
        }
    }

    // Se não encontrou nenhum usuário válido, exibe mensagem de erro
    echo "<p style='color:red;'>Email ou senha inválidos.</p>";
}
?>

<head>
    <link rel="stylesheet" href="login.css"> <!-- Estilo da página -->
    <title>Login</title> <!-- Título da aba -->
    <meta charset="UTF-8"> <!-- Suporte a caracteres especiais -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsividade -->

    <!-- Importação de fontes do Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <!-- Ícone da aba -->
    <link rel="shortcut icon" type="imagex/png" href="../imagens/logo.ico">
</head>

<body>
    <!-- Cabeçalho com a logo -->
    <div class="header">
        <a href="../index.html"> <!-- Link para voltar à página inicial -->
            <img src="../imagens/Logo_TheBest.png" alt="logo" class="logo"> <!-- Logo do site -->
        </a>
    </div>
    <div class="principal">
        <!-- Container do formulário de login -->
        <div class="formulario" style="margin-top: 5%;">
            <div class="titulo">
                <h1>Login</h1> <!-- Título da seção -->
            </div>

            <!-- Formulário de login -->
            <form method="post"> <!-- Envio via POST para o próprio arquivo -->
                <input type="text" placeholder="Email" name="email" class="usuarioEmailSenha" required><br>
                <input type="password" placeholder="Senha" name="senha" class="usuarioEmailSenha" required><br>
                <input type="submit" value="Entrar" class="botaoConfirmar"> <!-- Botão de envio -->
            </form>

            <!-- Link para cadastro, caso o usuário não tenha conta -->
            <p class="OpcoesLog-in">Não tem conta?
                <a href="../Cadastro/cadastro.php">Cadastre-se</a>
            </p>
        </div>
    </div>
</body>
</html>
