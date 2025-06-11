<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8"> <!-- Define o conjunto de caracteres como UTF-8 -->
    <title>Resultado da Votação</title> <!-- Título da página -->

    <!-- Biblioteca principal do Chart.js para desenhar gráficos -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Plugin extra para mostrar porcentagem no gráfico -->
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

    <!-- Importa ícones do Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

    <!-- Importa fonte Raleway do Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <!-- Importa CSS externo para estilização -->
    <link rel="stylesheet" href="style.css">

    <!-- Script externo que contém a função montarGrafico (deve estar presente na pasta) -->
    <script src="grafico.js"></script>

    <!-- Importa biblioteca de ícones Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
          integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Ícone da aba do navegador -->
    <link rel="shortcut icon" type="imagex/png" href="/imagens/logo.ico">

</head>

<body>

    <!-- Cabeçalho principal com menu de navegação -->
    <header class="main-header">
        <nav class="nav_container">
            <div class="nav_logo">
                <!-- Logo do site -->
                <img src="/imagens/Logo_TheBest.png" alt="logo">
            </div>
            <div class="nav_elementos">
                <ul class="nav_ul">
                    <li class="nav_li"><a href="/index.html" class="link">Home</a></li>
                    <li class="nav_li"><a href="" class="link">Sobre</a></li>

                    <!-- Menu categorias com submenu dropdown -->
                    <li class="nav_li categorias">
                        <a href="/Categorias/categorias.html" class="link">Categorias</a>
                        <span class="material-symbols-outlined dropdown_seta">arrow_drop_up</span>
                        <div class="dropdown_container">
                            <a href="/Categorias/Filmes/Votar_Filmes.html" class="dropdown_link link">Filmes</a>
                            <a href="/Categorias/Animes/Votar_Animes.html" class="dropdown_link link">Animes</a>
                            <a href="/Categorias/Series/Votar_Series.html" class="dropdown_link link">Séries</a>
                            <a href="/Categorias/Jogos/Votar_Jogos.html" class="dropdown_link link">Jogos</a>
                            <a href="/Categorias/Livros/Votar_Livros.html" class="dropdown_link link">Livros</a>
                        </div>
                    </li>

                    <!-- Link para página de login/cadastro -->
                    <li class="nav_li entrar"><a href="/Cadastro/cadastro.php" class="link">Entrar</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Mensagem de confirmação de voto -->
    <h1 style="margin-top: 100px; text-align:center; margin-bottom: 20px;">Seu voto foi registrado com sucesso!!!</h1>

    <h2>Resultado da Votação</h2>

    <!-- Canvas onde o gráfico de pizza será desenhado -->
    <canvas id="graficoPizza"></canvas>

<?php
// PHP para ler votos do arquivo e preparar os dados para o gráfico

// Define o caminho do arquivo de votos
$arquivo = 'votos.txt';

// Lê todas as linhas do arquivo, ignorando quebras de linha no final
$dados = file($arquivo, FILE_IGNORE_NEW_LINES);

// Array para contar quantos votos cada anime recebeu
$contagem = [];

// Percorre cada linha dos votos
foreach ($dados as $linha) {
    // Divide a linha em duas partes: email e anime votado
    list(, $anime) = explode(";", $linha);

    // Se o anime ainda não está no array, inicializa com zero
    if (!isset($contagem[$anime])) {
        $contagem[$anime] = 0;
    }

    // Incrementa o contador de votos para o anime
    $contagem[$anime]++;
}

// Converte as chaves (nomes dos animes) para JSON, para usar no JavaScript
$labels = json_encode(array_keys($contagem));

// Converte os valores (quantidade de votos) para JSON
$valores = json_encode(array_values($contagem));

// Insere um script JavaScript que chama a função montarGrafico() passando os dados
echo "<script>montarGrafico($labels, $valores);</script>";
?>
    <!-- Rodapé da página -->
    <footer>
        <div class="footerContainer">
            <div class="socialicons">
                <a href=""><i class="fa-brands fa-facebook"></i></a>
                <a href=""><i class="fa-brands fa-youtube"></i></a>
                <a href=""><i class="fa-brands fa-twitter"></i></a>
                <a href=""><i class="fa-brands fa-tiktok"></i></a>
                <a href=""><i class="fa-brands fa-instagram"></i></a>
            </div>
            <div class="footerNav">
                <ul>
                    <li><a href="/index.html">Home</a></li>
                    <li><a href="/Sobre/sobre.html">Sobre</a></li>
                    <li><a href="/Categorias/categorias.html">Categorias</a></li>
                    <li><a href="">Contato</a></li>
                </ul>
            </div>
        </div>
        <div class="footerBottom">
            <p>Copyright &copy;2025; Feito por <span class="designer">Mateus, Phietro e Tiago</span></p>
        </div>
    </footer>
</body>

</html>