<?php
session_start();
?>

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
            <a href="../../index.php"><i class="bi bi-box-arrow-left"></i></a>
            <img src="../img/Home-ic.png" alt="" class="img_lg">
        </div>
    </div>


    <form class="form" action="../../controllers/userController.php" method="post">
        <div class="flex-column">
          <label for="user">Usuário </label></div>
          <div class="inputForm">
            <svg height="20" viewBox="0 0 32 32" width="20" xmlns="http://www.w3.org/2000/svg"><g id="Layer_3" data-name="Layer 3"><path d="m30.853 13.87a15 15 0 0 0 -29.729 4.082 15.1 15.1 0 0 0 12.876 12.918 15.6 15.6 0 0 0 2.016.13 14.85 14.85 0 0 0 7.715-2.145 1 1 0 1 0 -1.031-1.711 13.007 13.007 0 1 1 5.458-6.529 2.149 2.149 0 0 1 -4.158-.759v-10.856a1 1 0 0 0 -2 0v1.726a8 8 0 1 0 .2 10.325 4.135 4.135 0 0 0 7.83.274 15.2 15.2 0 0 0 .823-7.455zm-14.853 8.13a6 6 0 1 1 6-6 6.006 6.006 0 0 1 -6 6z"></path></g></svg>
            <input type="text" name="user" id="user" class="input" placeholder="Digite seu username" maxlength="55" required>
          </div>
        
        <div class="flex-column">
          <label for="password">Senha </label></div>
          <div class="inputForm">
            <svg height="20" viewBox="-64 0 512 512" width="20" xmlns="http://www.w3.org/2000/svg"><path d="m336 512h-288c-26.453125 0-48-21.523438-48-48v-224c0-26.476562 21.546875-48 48-48h288c26.453125 0 48 21.523438 48 48v224c0 26.476562-21.546875 48-48 48zm-288-288c-8.8125 0-16 7.167969-16 16v224c0 8.832031 7.1875 16 16 16h288c8.8125 0 16-7.167969 16-16v-224c0-8.832031-7.1875-16-16-16zm0 0"></path><path d="m304 224c-8.832031 0-16-7.167969-16-16v-80c0-52.929688-43.070312-96-96-96s-96 43.070312-96 96v80c0 8.832031-7.167969 16-16 16s-16-7.167969-16-16v-80c0-70.59375 57.40625-128 128-128s128 57.40625 128 128v80c0 8.832031-7.167969 16-16 16zm0 0"></path></svg>        
            <input type="password" name="password" id="password" class="input" placeholder="Digite sua senha"  maxlength="30" required>
          </div>

          <!-- ERROR -->
          <?php
          // session_start();
          if (isset($_SESSION['login_error'])): ?>
              <div class="error-message">
                  <?php echo $_SESSION['login_error']; unset($_SESSION['login_error']); ?>
              </div>
          <?php endif; ?>
          <!-- ERROR -->


          <!-- sucesso -->
          <?php
          if (isset($_SESSION['login_sucess'])): ?>
              <div id="success-message" class="sucess-message">
                  <?php echo $_SESSION['login_sucess']; unset($_SESSION['login_sucess']); ?>
              </div>
          <?php endif; ?>
          <!-- sucesso -->
          

        <div class="flex-row">
          <div>
            <input type="checkbox" id="checkbox">
            <label for="checkbox">Lembre-me </label>
          </div>
          <span class="span">
        </div>
        <button type="submit" name="submit" class="button-submit" onclick="">Entrar</button>
        <!-- <input type="submit" class="button-submit" value="Entrar" onclick=""> -->
        <a class="p" href="./envia-email.php">Esqueceu a senha?</a></span>

        <p class="p">Não tem uma conta? <span class="span"> 
            <a class="p" href="./cadastro.php">         Cadastre-se                                            </a>
        </span>

       
    </div>
    </form>
</body>
</html>