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
    <form class="form form-auth" action="" method="POST">
        <p class="title-auth">Sistema de segurança  •  Verificação de duas etapas</p>
        <img src="../img/auth.png" class="auth-img">

        <div class="question-auth">
            <div class="flex-column">
              <label class="label-auth">Autenticação </label>
            </div>
            <div class="inputForm-auth">
              <p class="p-question-auth" id="question-auth" name="name-auth">Qual nome da sua mãe?</p>
              <input type="text" class=" answer-auth" id="answer-auth" name="answer-auth" placeholder="Insira aqui sua resposta" maxlength="30">
            </div>
        </div>

        <button class="button-submit entrar" onclick="">Entrar</button>
    </form>
</body>
</html>