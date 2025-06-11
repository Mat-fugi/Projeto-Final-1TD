<?php
// Inicia a sessão para usar variáveis de sessão
session_start();

// Verifica se o usuário está logado, verificando se o e-mail está definido na sessão
if (!isset($_SESSION["usuario_email"])) {
    // Se não estiver logado, redireciona para a página de cadastro/login
    header("Location: /Cadastro/cadastro.php");
    exit; // Encerra o script para evitar continuar executando
}

// Recupera o e-mail do usuário logado da sessão
$email = $_SESSION["usuario_email"];

// Lê todas as linhas do arquivo votos.txt, cada linha representa um voto
$votos = file("votos.txt", FILE_IGNORE_NEW_LINES);

// Verifica se o usuário já votou, para impedir voto duplicado
foreach ($votos as $linha) {
    // Separa a linha no formato "email;voto", pega só o email (primeira parte)
    list($votante, ) = explode(";", $linha);

    // Compara o e-mail do votante com o e-mail do usuário atual
    if ($votante == $email) {
        // Se já votou, exibe mensagem informando e oferece link para ver resultados
        echo "Você já votou. <a href='grafico.php'>Ver resultados</a>";
        exit; // Para o script para não permitir novo voto
    }
}

// Verifica se o formulário enviou o campo 'Anime' (nome da opção votada)
if (isset($_POST['Anime'])) {
    // Recupera o voto selecionado
    $voto = $_POST['Anime'];

    // Define o arquivo onde os votos serão armazenados
    $arquivo = 'votos.txt';

    // Adiciona o voto ao final do arquivo, no formato "email;voto" seguido de nova linha
    file_put_contents($arquivo, "$email;$voto" . PHP_EOL, FILE_APPEND);

    // Após salvar o voto, redireciona o usuário para a página do gráfico de resultados
    header('Location: grafico.php');
} else {
    // Caso não tenha selecionado nenhuma opção, mostra essa mensagem de erro
    echo "Nenhuma opção foi selecionada.";
}
?>