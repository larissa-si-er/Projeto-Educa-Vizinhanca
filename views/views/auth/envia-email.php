<!DOCTYPE html>
<html lang="PT-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css"/>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="
    https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js
    "></script>
    <script src="../js/login.js"></script>
    <link href="
    https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css
    " rel="stylesheet">
    <!-- icones -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="icon" type="image/png" href="../img/home-ic.png">
    <title>Login</title>
</head>
<body>
    <div class="menu">
        <div class="menu-bar">
            <a href="../auth/login.php"><i class="bi bi-box-arrow-left"></i></a>
            <img src="" alt="" srcset="">
        </div>
    </div>
    <form class="form" action="" method="POST">
        <i class="bi bi-envelope-at-fill"></i>
        <p class="legenda-h1">Verifique o seu e-mail!</p>
        <p class="legenda-h2">Clique no botão abaixo para confirmar seu <br>  endereço de e-mail e 
        receber um código<br> para confirmação de usuário.</p>
        <div class="flex-column">
          <label>Digite o seu email: </label>
        </div>
        <div class="inputForm">
          <i class="bi bi-envelope-paper-fill"></i>
          <input type="email" class="input" id="email" name="email" placeholder="Example@com" maxlength="30">
        </div>
        <div class="div-codigo" id="div-codigo">
          <input type="text" class="input-codigo"
          id="cod" name="cod" placeholder="Digite o código aqui" maxlength="10">
        </div>
        <button class="button-submit confirmar" onclick="block_codigo(event)">Enviar o Codigo</button>
    </form>
</body>
</html>