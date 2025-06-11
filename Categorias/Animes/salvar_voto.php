<?php
session_start(); 
// Inicia a sessão para usar variáveis de sessão

if (!isset($_SESSION["usuario_email"])) {
    // Verifica se o usuário não está logado (email não está definido na sessão)
    header("Location: /Cadastro/cadastro.php");
    // Redireciona para a página de cadastro/login
    exit; 
    // Para o script para garantir que o código abaixo não rode
}

$email = $_SESSION["usuario_email"]; 
// Pega o email do usuário da sessão

$votos = file("votos.txt", FILE_IGNORE_NEW_LINES); 
// Lê o arquivo 'votos.txt' e coloca cada linha em um array, sem incluir quebras de linha

// Verifica se o usuário já votou
foreach ($votos as $linha) {
    list($votante, ) = explode(";", $linha); 
    // Divide a linha pelo ponto e vírgula e pega o primeiro valor (email do votante)

    if ($votante == $email) {
        // Se o email do votante for igual ao email da sessão
        echo "Você já votou. <a href='grafico.php'>Ver resultados</a>";
        // Exibe mensagem que já votou e link para ver resultados
        exit; 
        // Para a execução para não permitir novo voto
    }
}

if (isset($_POST['Anime'])) {
    // Verifica se foi enviado um voto pelo formulário com o nome 'Anime'
    $voto = $_POST['Anime']; 
    // Pega o valor selecionado no formulário

    $arquivo = 'votos.txt'; 
    // Define o caminho do arquivo onde os votos serão salvos

    file_put_contents($arquivo, "$email;$voto" . PHP_EOL, FILE_APPEND);
    // Adiciona no final do arquivo o email e voto separados por ";" e pula uma linha

    header('Location: grafico.php'); 
    // Redireciona para a página que mostra o gráfico dos votos
} else {
    echo "Nenhuma opção foi selecionada.";
    // Caso o usuário não tenha selecionado nenhuma opção, mostra mensagem de erro
}
?>