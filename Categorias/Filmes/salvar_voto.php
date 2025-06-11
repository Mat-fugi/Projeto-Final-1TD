<?php
// Inicia a sessão para acessar variáveis de sessão
session_start();

// Verifica se o usuário está logado, ou seja, se a variável de sessão 'usuario_email' existe
if (!isset($_SESSION["usuario_email"])) {
    // Se não estiver logado, redireciona para a página de cadastro/login
    header("Location: /Cadastro/cadastro.php");
    // Encerra a execução do script após o redirecionamento
    exit;
}

// Recupera o email do usuário logado da sessão
$email = $_SESSION["usuario_email"];

// Lê o conteúdo do arquivo 'votos.txt', linha por linha, ignorando quebras de linha
$votos = file("votos.txt", FILE_IGNORE_NEW_LINES);

// Verifica se o usuário já votou antes
foreach ($votos as $linha) {
    // Divide a linha em partes separadas pelo ponto-e-vírgula (;)
    // A variável $votante recebe o email do votante, a segunda parte é descartada com ', '
    list($votante, ) = explode(";", $linha);

    // Compara se o email do votante é igual ao email do usuário atual
    if ($votante == $email) {
        // Se já votou, exibe uma mensagem e um link para ver os resultados
        echo "Você já votou. <a href='grafico.php'>Ver resultados</a>";
        // Encerra o script para evitar múltiplos votos
        exit;
    }
}

// Verifica se o formulário foi enviado e a opção 'Anime' foi selecionada
if (isset($_POST['Anime'])) {
    // Recupera o valor selecionado no formulário
    $voto = $_POST['Anime'];

    // Define o caminho do arquivo onde os votos serão armazenados
    $arquivo = 'votos.txt';

    // Adiciona uma nova linha ao arquivo com o formato "email;voto" + quebra de linha
    file_put_contents($arquivo, "$email;$voto" . PHP_EOL, FILE_APPEND);

    // Após salvar o voto, redireciona o usuário para a página do gráfico
    header('Location: grafico.php');
} else {
    // Caso nenhuma opção tenha sido selecionada no formulário, exibe mensagem de erro
    echo "Nenhuma opção foi selecionada.";
}
?>