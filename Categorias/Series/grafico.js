// Função para gerar cores únicas em HSL
function gerarCoresUnicas(qtd) {
  const cores = [];                // Array para armazenar as cores geradas
  const passo = 360 / qtd;         // Calcula o passo para distribuir as cores uniformemente no círculo HSL
  for (let i = 0; i < qtd; i++) {
    // Para cada cor, cria uma cor HSL com matiz (hue) variando conforme o passo, saturação 70% e luminosidade 60%
    cores.push(`hsl(${i * passo}, 70%, 60%)`);
  }
  return cores;                   // Retorna o array com as cores geradas
}

// Função para montar o gráfico
function montarGrafico(labels, valores) {
  // Pega o contexto do canvas onde o gráfico será desenhado
  const ctx = document.getElementById('graficoPizza').getContext('2d');

  // Gera as cores para cada fatia do gráfico, baseado na quantidade de labels
  const cores = gerarCoresUnicas(labels.length);

  // Cria um novo gráfico do tipo "pie" usando Chart.js
  new Chart(ctx, {
    type: "pie",
    data: {
      labels: labels,            // Define os nomes das categorias do gráfico
      datasets: [{
        data: valores,           // Define os valores (quantidade de votos)
        backgroundColor: cores,  // Define as cores das fatias
        borderWidth: 1           // Define a largura da borda das fatias
      }]
    },
    options: {
      plugins: {
        legend: {
          position: 'bottom'     // Posição da legenda abaixo do gráfico
        },
        tooltip: {
          callbacks: {
            // Personaliza o texto do tooltip exibido ao passar o mouse nas fatias
            label: function (context) {
              // Soma todos os valores para calcular o total de votos
              const total = context.dataset.data.reduce((a, b) => a + b, 0);
              const valor = context.raw; // Valor da fatia atual
              // Calcula a porcentagem da fatia em relação ao total, com uma casa decimal
              const porcentagem = ((valor / total) * 100).toFixed(1);
              // Retorna o texto formatado para o tooltip
              return `${context.label}: ${porcentagem}% (${valor} votos)`;
            }
          }
        }
      }
    }
  });
}

// Dados passados do PHP para o JavaScript
const labels =  $labels 
const valores =  $valores 

// Chama a função para montar o gráfico com os dados recebidos
montarGrafico(labels, valores);