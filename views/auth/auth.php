<?php
session_start();

// obter a pergunta 
function gerarPergunta($authFactor) {
    switch ($authFactor) {
        case 'cep':
            return "Qual é o seu CEP?";
        case 'data_nasc':
            return "Qual é a sua data de nascimento? "; 
        case 'nome_materno':
            return "Qual é o nome da sua mãe?";
        default:
            return "Pergunta não especificada";
    }
}

if (isset($_SESSION['user_data'])) {
    $authFactor = $_SESSION['user_data']['auth_factor'];
    $pergunta = gerarPergunta($authFactor);
} else {
    header("Location: ./login.php");
    exit;
}
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
    <script src="../js/login.js"></script>
    <link href="
    https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css
    " rel="stylesheet">
    <!-- icones -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="icon" type="image/png" href="../img/home-ic.png">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Login</title>
</head>
<body>
    <div class="menu">
        <div class="menu-bar">
            <a href="../auth/login.php"><i class="bi bi-box-arrow-left"></i></a>
            <img src="" alt="" srcset="">
        </div>
    </div>
    <form class="form form-auth" action="../../controllers/userController.php" method="POST">
        <p class="title-auth">Sistema de segurança  •  Verificação de duas etapas</p>
        <img src="../img/auth.png" class="auth-img">

        <div class="question-auth">
            <div class="flex-column">
              <label class="label-auth">Autenticação </label>
            </div>
            <div class="inputForm-auth">

              <p class="p-question-auth" id="question-auth"><?php echo $pergunta; ?></p>
              <!-- <p class="p-question-auth" id="question-auth"><?php echo  $_SESSION['user_data']['auth_factor']; ?></p> -->
              <!-- <p class="p-question-auth" id="question-auth"><?php echo isset($pergunta) ? $pergunta : 'Pergunta de autenticação não disponível'; ?></p> -->


              <input type="text" class=" answer-auth" id="answer-auth" name="answer-auth" placeholder="Insira aqui sua resposta" maxlength="30">
            </div>
        </div>

        <button class="button-submit entrar" name="submit-auth">Entrar</button>
        <input type="hidden" name="campo-correto" value="<?php echo isset($campo_correto) ? $campo_correto : ''; ?>">

        <?php
        if (isset($_SESSION['auth_error']) && $_SESSION['auth_error'] !== '') {
            echo '<p class="error_message">' . $_SESSION['auth_error'] . '</p>';
            unset($_SESSION['auth_error']);
        }
        ?>


<?php
    if (isset($_SESSION['auth_attempts_exceeded']) && $_SESSION['auth_attempts_exceeded'] !== '') {
        $authAttemptsExceeded = $_SESSION['auth_attempts_exceeded'];
        unset($_SESSION['auth_attempts_exceeded']);
        echo '<script>
            Swal.fire({
                icon: "error",
                title: "Erro",
                text: "' . $authAttemptsExceeded . '",
                confirmButtonText: "OK"
            }).then(() => {
                setTimeout(function() {
                    window.location.href = "./login.php";
                }, 800); 
            });
        </script>';
    } 
    ?>

    </form>
</body>
</html>