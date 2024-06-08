<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de Controle de Produtos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>


<div class="card_quant_prod">
    <div class="card-header-prod"></div>
    <div class="card-body-prod">
        <h1 class="card-number-prod" id="quantidadeProdutos">Carregando...</h1>
        <p class="card-products">Produtos</p>
    </div>
</div>

<script>
    // Função para buscar a quantidade de produtos do servidor e atualizar o card
    function atualizarQuantidadeProdutos() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("quantidadeProdutos").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "quant_prod.php", true);
        xhttp.send();
    }

    // Atualizar a quantidade de produtos inicialmente
    atualizarQuantidadeProdutos();

    // Atualizar a quantidade de produtos a cada 5 segundos (ou qualquer intervalo desejado)
    setInterval(atualizarQuantidadeProdutos, 5000); // 5000 milissegundos = 5 segundos
</script>

<style>
    /*quant prod quant curso*/
   .card_quant_prod {
    background-color: white;
    border-radius: 5px;
    padding: 20px;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 150px; /* Largura fixa para um card pequeno */
    margin: 0 auto; /* Centraliza o card horizontalmente */
    position: relative;
}

.card-header-prod {
    background-color: blue;
    height: 5px;
    width: 100%;
    position: absolute;
    top: 0;
    left: 0;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
}

.card-body-prod {
    padding-top: 20px; /* Espaço para a linha azul */
}

.card-number-prod {
    font-size: 50px; /* Tamanho da fonte ajustado para um card pequeno */
    margin: 0;
    color: blue;
}

.card-products {
    font-size: 16px;
    margin-top: 30px;
    padding-right: 50%; /* Distância entre o número e o texto "Produtos" */
}


</style>
     

</body>
</html>



