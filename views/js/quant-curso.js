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
    xhttp.open("GET", "../controllers/quant_curso.php", true);
    xhttp.send();
}

// Atualizar a quantidade de cursos inicialmente
atualizarQuantidadeCursos();

// Atualizar a quantidade de cursos a cada 5 segundos
setInterval(atualizarQuantidadeCursos, 5000);
