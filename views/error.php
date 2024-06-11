<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Erro Inesperado</title>
  <link rel="stylesheet" href="./css/global.css">
</head>
<body>
  <div class="error-container">
    <svg xmlns="http://www.w3.org/2000/svg" width="100" height="80" fill="currentColor" class="bi bi-mortarboard-fill" viewBox="0 0 16 16" style="margin-top: -100%;
">
        <path d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917z"/>
        <path d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466z"/>
    </svg>
    <h1>Erro Inesperado</h1>
    <div class="error-background">500</div>
    <div class="error-content">
      <p>Ocorreu um erro inesperado. Por favor, tente novamente mais tarde.</p>
    </div>
    
    <a href="/">Voltar para a página inicial</a>
    <br>
    <i> ou fale conosco</i>
    <br>
    <img class="qr_insta" src="./img/insta.png" alt="">
    <svg xmlns="http://www.w3.org/2000/svg" width="400" height="400" fill="currentColor" class="bi bi-exclamation-diamond-fill" viewBox="0 0 16 16" style="
            position: fixed;
            color: #ff000045;
            top: 25%;
            right: 83%;
        ">
        <path d="M9.05.435c-.58-.58-1.52-.58-2.1 0L.436 6.95c-.58.58-.58 1.519 0 2.098l6.516 6.516c.58.58 1.519.58 2.098 0l6.516-6.516c.58-.58.58-1.519 0-2.098zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
    </svg>
    <svg xmlns="http://www.w3.org/2000/svg" width="400" height="400" fill="currentColor" class="bi bi-exclamation-diamond-fill" viewBox="0 0 16 16" style="
            position: fixed;
            color: #ff000045;
            top: 25%;
            right: 83%;
        ">
        <path d="M9.05.435c-.58-.58-1.52-.58-2.1 0L.436 6.95c-.58.58-.58 1.519 0 2.098l6.516 6.516c.58.58 1.519.58 2.098 0l6.516-6.516c.58-.58.58-1.519 0-2.098zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
    </svg>

    <!-- Se houver uma mensagem de erro personalizada, exiba-a -->
    <?php if (isset($_SESSION['error_message'])) : ?>
        <div style="background-color: #f8d7da; color: #721c24; padding: 10px; margin-top: 20px;">
            <?php echo $_SESSION['error_message']; ?>
        </div>
        <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>

  </div>


</body>



</html>
