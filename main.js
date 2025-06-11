// =================== HEADER DINÂMICO ===================

// Guarda a posição anterior de scroll
let ultimoScroll = 0;

// Seleciona o header principal
const header = document.querySelector('.main-header');

// Adiciona comportamento de esconder/mostrar o header ao rolar a página
window.addEventListener('scroll', () => {
    const scrollAtual = window.scrollY;
    if (scrollAtual > ultimoScroll) {
        header.classList.add('esconder_Header'); // Esconde ao descer
    } else {
        header.classList.remove('esconder_Header'); // Mostra ao subir
    }
    ultimoScroll = scrollAtual;
});


// =================== CARROSSEL ===================

let index = 0;
let autoplayIntervalo;

// Botões e elementos do carrossel
const botaoAnterior = document.getElementById('botaoAnterior');
const botaoProximo = document.getElementById('botaoProximo');
const carrossel = document.getElementById('carrossel');
const totalSlides = carrossel.children.length;

// Função para mover o carrossel para frente ou para trás
function mover(direcao) {
    index = (index + direcao + totalSlides) % totalSlides;
    carrossel.style.transform = `translateX(-${index * 100}%)`;
}

// Inicia o autoplay do carrossel
function comecarAutoPlay() {
    autoplayIntervalo = setInterval(() => mover(1), 5000);
}

// Interrompe o autoplay
function pararAutoPlay() {
    clearInterval(autoplayIntervalo);
}

// Pausa o autoplay quando o mouse está sobre os controles ou o carrossel
function configurarEventosPausaAutoplay(elemento) {
    elemento.addEventListener('mouseenter', pararAutoPlay);
    elemento.addEventListener('mouseleave', comecarAutoPlay);
}

// Aplica a pausa em todos os elementos relevantes
[carrossel, botaoAnterior, botaoProximo].forEach(configurarEventosPausaAutoplay);

// Inicia o autoplay quando a página carrega
comecarAutoPlay();


// =================== DESTAQUES ===================

// Atualiza o conteúdo exibido com base na seleção
function trocarItem(item) {
    const conteudo = document.getElementById('conteudo');
    conteudo.classList.remove('ativo'); // Oculta o conteúdo atual

    setTimeout(() => {
        let novoHTML = '';

        if (item === 1) {
            novoHTML = `
                <div class="descricao">
                    <span>FILMES</span>
                    <p>Qual filme merece o seu voto? Das teias do Aranhaverso aos maiores sucessos de bilheteria, a decisão está em suas mãos. Vote agora nos seus favoritos e ajude a coroar os campeões do cinema!</p>
                    <a href="Categorias/Filmes/Votar_Filmes.html"><button class="buttonVoteAgora">Vote Agora</button></a>
                </div>

                <div class="imgDescricao" style="align-itens: left; width:100%;">
                    <img src="/imagens/destaques/MilesMorales.png" class="imgFundo" alt="Arcane">
                </div>
            `;
        } else if (item === 2) {
            novoHTML = `
                <div class="descricao">
                    <span>ANIMES</span>
                    <p>Qual anime é o seu preferido? Do mundo de One Piece aos maiores sucessos, vote agora e ajude a eleger os melhores!</p>
                    <a href="Categorias/Animes/Votar_Animes.html"><button class="buttonVoteAgora">Vote Agora</button></a>
                </div>

                <div class="imgDescricao">
                    <img src="/imagens/destaques/LuffyGear5.png" class="imgFundo" alt="Miles Morales">
                </div>
            `;
        } else if (item === 3) {
            novoHTML = `
                <div class="descricao">
                    <span>SÉRIES</span>
                    <p>Qual série dominou seu coração? De "Arcane" aos maiores sucessos, a hora é agora! Vote nas suas séries favoritas e ajude a coroar as melhores produções da TV!</p>
                    <a href="Categorias/Series/Votar_Series.html"><button class="buttonVoteAgora">Vote Agora</button></a>
                </div>

                <div class="imgDescricao">
                    <img src="/imagens/destaques/Arcane.png" class="imgFundo" alt="Miles Morales">
                </div>
            `;
        } else if (item === 4) {
            novoHTML = `
                <div class="descricao">
                    <span>JOGOS</span>
                    <p>Qual jogo é o campeão? Dos balanços de Spider-Man 2 às maiores aventuras, a decisão é sua! Vote nos seus games favoritos e celebre os ícones dos consoles!</p>
                    <a href="Categorias/Jogos/Votar_Jogos.html"><button class="buttonVoteAgora">Vote Agora</button></a>
                </div>

                <div class="imgDescricao">
                    <img src="/imagens/destaques/Spiderman.png" class="imgFundo" alt="Miles Morales">
                </div>
            `;
        } else if (item === 5) {
            novoHTML = `
                <div class="descricao">
                    <span>LIVROS</span>
                    <p>Qual livro te transportou? De "Projeto Hail Mary" aos clássicos, vote nos seus favoritos e celebre a literatura!</p>
                    <a href="Categorias/Livros/Votar_Livros.html"><button class="buttonVoteAgora">Vote Agora</button></a>
                </div>

                <div class="imgDescricao">
                    <img src="/imagens/destaques/Project-hail-mary.png" class="imgFundo" alt="Miles Morales">
                </div>
            `;
        } else if (item === 6) {
            novoHTML = `
                <div class="descricao">
                    <span>ATORES</span>
                    <p>Quem brilhou nas telas? De Chris Evans a grandes talentos, vote nos seus atores e atrizes favoritos e celebre as performances que te emocionaram!</p>
                    <a href="Categorias/Atores/Votar_Atores.html"><button class="buttonVoteAgora">Vote Agora</button></a>
                </div>

                <div class="imgDescricao">
                    <img src="/imagens/destaques/Chris-Evans.png" class="imgFundo" alt="Miles Morales">
                </div>
            `;
        }

        conteudo.innerHTML = novoHTML;
        conteudo.classList.add('ativo'); // Reexibe com novo conteúdo
    }, 500);
}


// =================== TEMPORIZADOR ===================

// Define a data e hora limite para o fim da votação
const dataFinal = new Date(Date.UTC(2025, 5, 20, 18, 20, 0)).getTime(); // mês 5 = junho

// Seleciona o elemento de contador na interface
const contadorElement = document.querySelector(".contador");

// Atualiza o contador a cada segundo
function atualizarContador() {
    const agora = new Date().getTime();
    const tempoRestante = dataFinal - agora;

    if (tempoRestante <= 0) {
        contadorElement.textContent = "00 dias 00:00:00";
        clearInterval(intervalo);
        return;
    }

    const dias = Math.floor(tempoRestante / (1000 * 60 * 60 * 24));
    const horas = Math.floor((tempoRestante / (1000 * 60 * 60)) % 24);
    const minutos = Math.floor((tempoRestante / (1000 * 60)) % 60);
    const segundos = Math.floor((tempoRestante / 1000) % 60);

    contadorElement.textContent =
        `${dias.toString().padStart(2, '0')} dias ` +
        `${String(horas).padStart(2, '0')}:${String(minutos).padStart(2, '0')}:${String(segundos).padStart(2, '0')}`;
}

// Inicia o contador assim que a página carrega
const intervalo = setInterval(atualizarContador, 1000);
atualizarContador();