<!DOCTYPE html>
<!-- Declara que este documento é HTML5 -->
<html lang="pt-BR">
<!-- Elemento raiz da página, idioma definido para português do Brasil -->

<head>
    <!-- Cabeçalho da página, contém metadados, links e scripts -->

    <meta charset="UTF-8">
    <!-- Define a codificação de caracteres como UTF-8 -->

    <title>Resultado da Votação</title>
    <!-- Título da página que aparece na aba do navegador -->

    <!-- Biblioteca principal do Chart.js para desenhar gráficos -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Plugin do Chart.js para mostrar porcentagens nos gráficos -->
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

    <!-- Importa ícones do Google Fonts (Material Symbols) -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

    <!-- Otimizações e importação da fonte 'Raleway' do Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <!-- Importa o arquivo CSS externo para estilização da página -->
    <link rel="stylesheet" href="style.css">

    <!-- Importa script externo que contém o código para montar o gráfico -->
    <script src="grafico.js"></script>

    <!-- Importa a biblioteca Font Awesome para ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Define o favicon da página -->
    <link rel="shortcut icon" type="imagex/png" href="/imagens/logo.ico">

</head>

<body>
    <!-- Corpo da página -->

    <!-- Cabeçalho principal com menu de navegação -->
    <header class="main-header">
        <nav class="nav_container">
            <!-- Container do menu -->

            <div class="nav_logo">
                <!-- Área do logo -->
                <img src="/imagens/Logo_TheBest.png" alt="logo">
                <!-- Imagem do logo -->
            </div>

            <div class="nav_elementos">
                <!-- Container dos links do menu -->
                <ul class="nav_ul">
                    <li class="nav_li"><a href="/index.html" class="link">Home</a></li>
                    <!-- Link para a página inicial -->

                    <li class="nav_li"><a href="" class="link">Sobre</a></li>
                    <!-- Link para a página Sobre (ainda sem href definido) -->

                    <li class="nav_li categorias">
                        <!-- Item do menu com submenu -->
                        <a href="/Categorias/categorias.html" class="link">Categorias</a>
                        <!-- Link para página de categorias -->

                        <span class="material-symbols-outlined dropdown_seta">arrow_drop_up</span>
                        <!-- Ícone de seta para dropdown -->

                        <div class="dropdown_container">
                            <!-- Container do menu dropdown -->

                            <a href="/Categorias/Filmes/Votar_Filmes.html" class="dropdown_link link">Filmes</a>
                            <!-- Link para categoria Filmes -->

                            <a href="/Categorias/Animes/Votar_Animes.html" class="dropdown_link link">Animes</a>
                            <!-- Link para categoria Animes -->

                            <a href="/Categorias/Series/Votar_Series.html" class="dropdown_link link">Séries</a>
                            <!-- Link para categoria Séries -->

                            <a href="/Categorias/Jogos/Votar_Jogos.html" class="dropdown_link link">Jogos</a>
                            <!-- Link para categoria Jogos -->

                            <a href="/Categorias/Livros/Votar_Livros.html" class="dropdown_link link">Livros</a>
                            <!-- Link para categoria Livros -->
                        </div>
                    </li>

                    <li class="nav_li entrar"><a href="/Cadastro/cadastro.php" class="link">Entrar</a></li>
                    <!-- Link para a página de cadastro/login -->
                </ul>
            </div>
        </nav>
    </header>

    <!-- Mensagem de sucesso após o voto -->
    <h1 style="margin-top: 100px; text-align:center; margin-bottom: 20px;">Seu voto foi registrado com sucesso!!!</h1>

    <!-- Título da seção de resultados -->
    <h2>Resultado da Votação</h2>

    <!-- Elemento canvas onde o gráfico será desenhado -->
    <canvas id="graficoPizza"></canvas>

    <?php
    // Início do código PHP que processa os votos e gera os dados para o gráfico

    // Define o arquivo que contém os votos salvos
    $arquivo = 'votos.txt';

    // Lê o conteúdo do arquivo linha a linha, ignorando quebras de linha
    $dados = file($arquivo, FILE_IGNORE_NEW_LINES);

    // Inicializa array para contar votos por anime
    $contagem = [];

    // Loop para contar votos
    foreach ($dados as $linha) {
        // Separa cada linha usando ';' e pega o segundo elemento (nome do anime)
        list(, $anime) = explode(";", $linha);

        // Se ainda não existe a chave para esse anime, inicializa com zero
        if (!isset($contagem[$anime])) {
            $contagem[$anime] = 0;
        }

        // Incrementa o contador para o anime
        $contagem[$anime]++;
    }

    // Converte as chaves (nomes dos animes) em JSON para passar ao JavaScript
    $labels = json_encode(array_keys($contagem));

    // Converte os valores (contagem de votos) em JSON para passar ao JavaScript
    $valores = json_encode(array_values($contagem));

    // Imprime um script para chamar a função montarGrafico() com os dados convertidos
    echo "<script>montarGrafico($labels, $valores);</script>";
    ?>

    <!-- Rodapé da página -->
    <footer>
        <div class="footerContainer">
            <!-- Container dos ícones sociais -->
            <div class="socialicons">
                <a href=""><i class="fa-brands fa-facebook"></i></a>
                <a href=""><i class="fa-brands fa-youtube"></i></a>
                <a href=""><i class="fa-brands fa-twitter"></i></a>
                <a href=""><i class="fa-brands fa-tiktok"></i></a>
                <a href=""><i class="fa-brands fa-instagram"></i></a>
            </div>

            <!-- Navegação do rodapé -->
            <div class="footerNav">
                <ul>
                    <li><a href="/index.html">Home</a></li>
                    <li><a href="/Sobre/sobre.html">Sobre</a></li>
                    <li><a href="/Categorias/categorias.html">Categorias</a></li>
                    <li><a href="">Contato</a></li>
                </ul>
            </div>
        </div>

        <!-- Parte inferior do rodapé -->
        <div class="footerBottom">
            <p>Copyright &copy;2025; Feito por <span class="designer">Mateus, Phietro e Tiago</span></p>
        </div>
    </footer>
</body>

</html>