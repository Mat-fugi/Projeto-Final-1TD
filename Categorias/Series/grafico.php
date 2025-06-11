<!DOCTYPE html>
<!-- Declara o documento como HTML5 -->
<html lang="pt-BR">
<!-- Define o idioma da página como português do Brasil -->

<head>
    <meta charset="UTF-8">
    <!-- Define a codificação de caracteres para UTF-8 -->

    <title>Resultado da Votação</title>
    <!-- Título da aba do navegador -->

    <!-- Biblioteca principal do Chart.js para desenhar gráficos -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Plugin do Chart.js para mostrar os valores em porcentagem dentro do gráfico -->
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

    <!-- Importa ícones do Google Fonts (Material Symbols Outlined) -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

    <!-- Importa fonte Raleway do Google Fonts com variações de peso e itálico -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <!-- Importa o arquivo CSS externo para estilizar a página -->
    <link rel="stylesheet" href="style.css">

    <!-- Importa script externo para montar o gráfico (arquivo grafico.js) -->
    <script src="grafico.js"></script>

    <!-- Importa biblioteca de ícones Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Define o ícone da aba do navegador (favicon) -->
    <link rel="shortcut icon" type="imagex/png" href="/imagens/logo.ico">

</head>

<body>

    <!-- Cabeçalho principal da página -->
    <header class="main-header">
        <nav class="nav_container">
            <!-- Container do menu de navegação -->

            <div class="nav_logo">
                <!-- Logo da página -->
                <img src="/imagens/Logo_TheBest.png" alt="logo">
            </div>

            <div class="nav_elementos">
                <!-- Itens do menu -->
                <ul class="nav_ul">
                    <li class="nav_li"><a href="/index.html" class="link">Home</a></li>
                    <!-- Link para a página inicial -->

                    <li class="nav_li"><a href="" class="link">Sobre</a></li>
                    <!-- Link para página Sobre (link vazio, pode ser corrigido) -->

                    <li class="nav_li categorias">
                        <!-- Item categorias com dropdown -->
                        <a href="/Categorias/categorias.html" class="link">Categorias</a>
                        <span class="material-symbols-outlined dropdown_seta">arrow_drop_up</span>
                        <!-- Ícone seta para mostrar o menu dropdown -->

                        <div class="dropdown_container">
                            <!-- Itens do dropdown -->
                            <a href="/Categorias/Filmes/Votar_Filmes.html" class="dropdown_link link">Filmes</a>
                            <a href="/Categorias/Animes/Votar_Animes.html" class="dropdown_link link">Animes</a>
                            <a href="/Categorias/Series/Votar_Series.html" class="dropdown_link link">Séries</a>
                            <a href="/Categorias/Jogos/Votar_Jogos.html" class="dropdown_link link">Jogos</a>
                            <a href="/Categorias/Livros/Votar_Livros.html" class="dropdown_link link">Livros</a>
                        </div>
                    </li>

                    <li class="nav_li entrar"><a href="/Cadastro/cadastro.php" class="link">Entrar</a></li>
                    <!-- Link para página de cadastro/login -->
                </ul>
            </div>
        </nav>
    </header>

    <!-- Mensagem de confirmação do voto, centralizada com margens -->
    <h1 style="margin-top: 100px; text-align:center; margin-bottom: 20px;">Seu voto foi registrado com sucesso!!!</h1>

    <!-- Título da seção de resultado -->
    <h2>Resultado da Votação</h2>

    <!-- Canvas onde o gráfico será desenhado pelo Chart.js -->
    <canvas id="graficoPizza"></canvas>

    <?php
    // Define o arquivo onde os votos estão salvos
    $arquivo = 'votos.txt';

    // Lê todas as linhas do arquivo, ignorando quebras de linha
    $dados = file($arquivo, FILE_IGNORE_NEW_LINES);

    // Inicializa array para contar os votos por anime
    $contagem = [];

    // Percorre cada linha do arquivo
    foreach ($dados as $linha) {
        // Divide a linha em partes pelo delimitador ";", e pega a segunda parte (nome do anime)
        list(, $anime) = explode(";", $linha);

        // Se ainda não existe esse anime no array de contagem, inicializa com zero
        if (!isset($contagem[$anime])) {
            $contagem[$anime] = 0;
        }

        // Incrementa a contagem do anime
        $contagem[$anime]++;
    }

    // Prepara as chaves (nomes dos animes) em formato JSON para o JavaScript
    $labels = json_encode(array_keys($contagem));

    // Prepara os valores (quantidade de votos) em formato JSON para o JavaScript
    $valores = json_encode(array_values($contagem));

    // Imprime um script que chama a função montarGrafico() do grafico.js, passando os dados
    echo "<script>montarGrafico($labels, $valores);</script>";
    ?>

    <!-- Rodapé da página -->
    <footer>
        <div class="footerContainer">
            <div class="socialicons">
                <!-- Ícones de redes sociais com links vazios -->
                <a href=""><i class="fa-brands fa-facebook"></i></a>
                <a href=""><i class="fa-brands fa-youtube"></i></a>
                <a href=""><i class="fa-brands fa-twitter"></i></a>
                <a href=""><i class="fa-brands fa-tiktok"></i></a>
                <a href=""><i class="fa-brands fa-instagram"></i></a>
            </div>
            <div class="footerNav">
                <ul>
                    <!-- Links do rodapé -->
                    <li><a href="/index.html">Home</a></li>
                    <li><a href="/Sobre/sobre.html">Sobre</a></li>
                    <li><a href="/Categorias/categorias.html">Categorias</a></li>
                    <li><a href="">Contato</a></li>
                    <!-- Link Contato vazio, pode ser preenchido -->
                </ul>
            </div>
        </div>

        <div class="footerBottom">
            <!-- Créditos e copyright -->
            <p>Copyright &copy;2025; Feito por <span class="designer">Mateus, Phietro e Tiago</span></p>
        </div>
    </footer>
</body>

</html>