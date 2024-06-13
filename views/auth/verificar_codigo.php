<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verificar Código</title>
</head>
<body>
    <?php if (isset($_SESSION['error_message'])): ?>
        <p style="color: red;"><?php echo $_SESSION['error_message']; unset($_SESSION['error_message']); ?></p>
    <?php endif; ?>
    <form action="forgot_password_handler.php" method="POST">
        <input type="email" name="email" placeholder="Seu e-mail" required>
        <input type="text" name="codigo" placeholder="Código de verificação" required>
        <button type="submit" name="verificarCodigo">Verificar</button>
    </form>
</body>
</html>
