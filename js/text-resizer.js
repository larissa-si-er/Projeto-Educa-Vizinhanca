function aumentarTexto() {
    var elementosTexto = document.querySelectorAll('body *'); // Seleciona todos os elementos dentro do body

    elementosTexto.forEach(function(elemento) {
        var tamanhoAtual = window.getComputedStyle(elemento).fontSize; // Obtém o tamanho atual da fonte
        var novoTamanho = parseInt(tamanhoAtual) * 1.2; // Aumenta o tamanho da fonte em 20%

        elemento.style.fontSize = novoTamanho + 'px'; // Define o novo tamanho da fonte
    });
}

function diminuirTexto() {
    var elementosTexto = document.querySelectorAll('body *');

    elementosTexto.forEach(function(elemento) {
        var tamanhoAtual = window.getComputedStyle(elemento).fontSize;
        var novoTamanho = parseInt(tamanhoAtual) * 0.8; // Diminui o tamanho da fonte em 20%

        elemento.style.fontSize = novoTamanho + 'px';
    });
}
