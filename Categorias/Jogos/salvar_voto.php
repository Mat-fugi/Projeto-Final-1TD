<?php
session_start(); 
// Inicia a sessão para acessar variáveis de sessão (como o email do usuário)

if (!isset($_SESSION["usuario_email"])) {
    // Se o usuário não estiver logado (email não definido na sessão)
    header("Location: /Cadastro/cadastro.php"); 
    // Redireciona para a página de cadastro/login
    exit; 
    // Interrompe a execução do script após o redirecionamento
}

$email = $_SESSION["usuario_email"]; 
// Recupera o email do usuário logado da sessão

$votos = file("votos.txt", FILE_IGNORE_NEW_LINES); 
// Lê todas as linhas do arquivo 'votos.txt' e salva em um array, sem incluir as quebras de linha

// Verifica se o usuário já votou
foreach ($votos as $linha) {
    list($votante, ) = explode(";", $linha); 
    // Separa a linha em duas partes usando ";" — o votante e o voto (descartamos o voto aqui)
    if ($votante == $email) { 
        // Se o email do votante for igual ao email da sessão (usuário atual)
        echo "Você já votou. <a href='grafico.php'>Ver resultados</a>"; 
        // Exibe mensagem informando que já votou e link para ver resultados
        exit; 
        // Interrompe o script para evitar votação duplicada
    }
}

if (isset($_POST['Anime'])) {
    // Verifica se o formulário enviou o campo 'Anime' (ou seja, se o usuário escolheu um voto)
    $voto = $_POST['Anime']; 
    // Armazena o voto enviado pelo usuário

    $arquivo = 'votos.txt'; 
    // Define o caminho do arquivo onde os votos serão salvos

    file_put_contents($arquivo, "$email;$voto" . PHP_EOL, FILE_APPEND); 
    // Adiciona no final do arquivo uma linha com "email;voto" + quebra de linha

    header('Location: grafico.php'); 
    // Redireciona o usuário para a página que mostra o gráfico dos votos
} else {
    echo "Nenhuma opção foi selecionada."; 
    // Caso o usuário não tenha selecionado nenhum voto, exibe mensagem de erro
}
?>