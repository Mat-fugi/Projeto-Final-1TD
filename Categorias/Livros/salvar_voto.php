<?php
// Inicia a sessão para acessar variáveis de sessão
session_start();

// Verifica se o usuário está logado, ou seja, se o e-mail está definido na sessão
if (!isset($_SESSION["usuario_email"])) {
    // Se não estiver logado, redireciona para a página de cadastro/login
    header("Location: /Cadastro/cadastro.php");
    exit; // Para a execução do script após o redirecionamento
}

// Recupera o e-mail do usuário logado armazenado na sessão
$email = $_SESSION["usuario_email"];

// Lê o arquivo 'votos.txt' linha a linha, ignorando quebras de linha
$votos = file("votos.txt", FILE_IGNORE_NEW_LINES);

// Verifica se o usuário já votou anteriormente
foreach ($votos as $linha) {
    // Separa a linha pelo caractere ';' para extrair o votante (email) e o voto (anime)
    list($votante, ) = explode(";", $linha);

    // Se o email do votante na linha atual for igual ao email do usuário logado
    if ($votante == $email) {
        // Exibe mensagem informando que o usuário já votou e link para ver resultados
        echo "Você já votou. <a href='grafico.php'>Ver resultados</a>";
        exit; // Para a execução do script para impedir múltiplos votos
    }
}

// Verifica se foi enviada alguma opção de voto via POST
if (isset($_POST['Anime'])) {
    // Recebe a opção escolhida pelo usuário
    $voto = $_POST['Anime'];

    // Caminho do arquivo onde os votos são armazenados
    $arquivo = 'votos.txt';

    // Adiciona uma nova linha no arquivo com o formato "email;voto" seguido de quebra de linha
    file_put_contents($arquivo, "$email;$voto" . PHP_EOL, FILE_APPEND);

    // Após registrar o voto, redireciona o usuário para a página de resultados (gráfico)
    header('Location: grafico.php');
} else {
    // Caso nenhum voto tenha sido selecionado no formulário, exibe mensagem de erro
    echo "Nenhuma opção foi selecionada.";
}
?>