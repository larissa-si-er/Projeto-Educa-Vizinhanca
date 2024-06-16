

// quant-prod.js
function atualizarQuantidadeCursos() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("quantidadeCursos").innerHTML = this.responseText;
        } else {
            document.getElementById("quantidadeCursos").innerHTML = "0";
        }
    };
    xhttp.open("GET", "quant-curso.php", true);
    xhttp.send();
}

// Atualizar a quantidade de produtos inicialmente
atualizarQuantidadeCursos();

// Atualizar a quantidade de produtos a cada 5 segundos
setInterval(atualizarQuantidadeCursos, 5000);
