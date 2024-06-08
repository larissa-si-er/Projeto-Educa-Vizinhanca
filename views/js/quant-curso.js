// Função para buscar a quantidade de cursos do servidor e atualizar o card
function atualizarQuantidadeCursos() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4) {
            if (this.status == 200) {
                document.getElementById("quantidadeCursos").innerHTML = this.responseText;
            } else {
                document.getElementById("quantidadeCursos").innerHTML = "0";
            }
        }
    };
    xhttp.open("GET", "quant_curso.php", true);
    xhttp.send();
}

// Atualizar a quantidade de cursos inicialmente
atualizarQuantidadeCursos();

// Atualizar a quantidade de cursos a cada 5 segundos (ou qualquer intervalo desejado)
setInterval(atualizarQuantidadeCursos, 5000); // 5000 milissegundos = 5 segundosjado)
    setInterval(atualizarQuantidadeCursos, 5000); // 5000 milissegundos = 5 segundos