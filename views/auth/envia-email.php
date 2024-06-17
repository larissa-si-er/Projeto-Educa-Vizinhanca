<?php
session_start();
require_once '../../models/conexao.php'; // Inclua o arquivo de conexão com o banco de dados

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['enviar-email'])) {
    $email = $_POST['email'];
    $user_types = ['aluno', 'administracao', 'instituicao'];
    $user_type_found = null;

    foreach ($user_types as $user_type) {
        $sql = "SELECT email FROM $user_type WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $user_type_found = $user_type;
            break;
        }
    }

    if ($user_type_found) {
        $_SESSION['email'] = $email;
        $_SESSION['user_type'] = $user_type_found;
        header('Location: ./esqueceu-senha.php');
        exit();
    } else {
        $_SESSION['error-message'] = 'Email não encontrado.';
        header('Location: envia-email.php');
        exit();
    }
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>
    <script src="../js/login.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- icones -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="icon" type="image/png" href="../img/home-ic.png">
    <title>Verificar Email</title>
</head>
<body>
    <div class="menu">
        <div class="menu-bar">
            <a href="../auth/login.php"><i class="bi bi-box-arrow-left"></i></a>
            <img src="" alt="" srcset="">
        </div>
    </div>
    <form class="form" action="envia-email.php" method="POST">

        <div class="icon-principal"><i class="bi bi-envelope-at-fill"></i></div>
        <p class="legenda-h1">Verifique o seu e-mail!</p>
        <p class="legenda-h2">Clique no botão abaixo para confirmar seu
            <br>
             endereço de e-mail.</p>
        <div class="flex-column">
            <label>Digite o seu email:</label>
        </div>
        <div class="inputForm">
            <i class="bi bi-envelope-paper-fill"></i>
            <input type="email" class="input" id="email" name="email" placeholder="Example@com" maxlength="30">
        </div>
        <button class="button-submit confirmar" type="submit" name="enviar-email">Enviar o Código</button>

        <?php if (isset($_SESSION['error-message'])): ?>
            <div class="error-message">
                <?php echo $_SESSION['error-message']; unset($_SESSION['error-message']); ?>
            </div>
        <?php endif; ?>

    </form>
</body>
</html>
