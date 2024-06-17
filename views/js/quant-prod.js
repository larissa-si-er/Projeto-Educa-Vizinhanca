// quant-prod.js
function atualizarQuantidadeProdutos() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("quantidadeProdutos").innerHTML = this.responseText;
        } else {
            document.getElementById("quantidadeProdutos").innerHTML = "0";
        }
    };
    xhttp.open("GET", "quant-prod.php", true);
    xhttp.send();
}

// Atualizar a quantidade de produtos inicialmente
atualizarQuantidadeProdutos();

// Atualizar a quantidade de produtos a cada 5 segundos
setInterval(atualizarQuantidadeProdutos, 5000);
