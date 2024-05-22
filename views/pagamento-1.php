<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="./img/home-ic.png">
    <title> Pagamento </title>
    <link rel="stylesheet" href="./css/style-pag.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!-- icones -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="./js/pagamento.js"></script>
</head>
<body>
<div class="container">
   <div class="menu">
        <div class="menu-bar">
            <a href="../../views/produtos.php"><i class="bi bi-box-arrow-left"></i></a>
            <img src="./img/Home-ic.png" alt="" class="img_lg">
        </div>
    </div>

    <form action="" onsubmit="">

        <div class="row">

            <div class="col">

                <h3 class="title">Endereço de Cobrança</h3>

                <div class="inputBox">
                    <span>Nome Completo :</span>
                    <input type="text" placeholder="Name">
                </div>
                <div class="inputBox">
                    <span>Email :</span>
                    <input type="email" placeholder="example@example.com">
                </div>
                <div class="inputBox">
                    <span>Endereço :</span>
                    <input type="text" placeholder="">
                </div>
                <div class="inputBox">
                    <span>Cidade :</span>
                    <input type="text" placeholder="">
                </div>

                <div class="flex">
                    <div class="inputBox">
                        <span>Estado :</span>
                        <input type="text" placeholder="">
                    </div>
                    <div class="inputBox">
                        <span>CEP :</span>
                        <input type="text" placeholder="123456">
                    </div>
                </div>

            </div>

            <div class="col">

                <h3 class="title">Pagamento</h3>

                <div class="inputBox">
                    <span>Cartões aceitos :</span>
                    <img src="./img/imgcards.png" alt="">
                </div>
                <div class="inputBox">
                    <span>Nome no cartão :</span>
                    <input type="text">
                </div>
                <div class="inputBox">
                    <span>Numero do cartão :</span>
                    <input type="text" placeholder="1111-2222-3333-4444">
                </div>
                <div class="inputBox">
                    <span>Mês da validade :</span>
                    <input type="text" placeholder="00">
                </div>

                <div class="flex">
                    <div class="inputBox">
                        <span>Ano :</span>
                        <input type="text" placeholder="2022">
                    </div>
                    <div class="inputBox">
                        <span>CVV :</span>
                        <input type="text" placeholder="1234">
                    </div>
                </div>

            </div>
    
        </div>

        <input type="submit" value="Confirmar" class="submit-btn">

    </form>

</div>  
</body>
</html>
