<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Redefinir Senha</title>
</head>
<body>
    <?php if (isset($_SESSION['error_message'])): ?>
        <p style="color: red;"><?php echo $_SESSION['error_message']; unset($_SESSION['error_message']); ?></p>
    <?php endif; ?>
    <form action="forgot_password_handler.php" method="POST">
        <input type="password" name="nova_senha" placeholder="Nova senha" required>
        <button type="submit" name="redefinirSenha">Redefinir Senha</button>
    </form>
</body>
</html>
