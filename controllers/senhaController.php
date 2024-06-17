<?php
session_start();
require_once '../models/conexao.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['redefinir-senha'])) {
    $nova_senha = $_POST['nova_senha'];
    $confirmar_senha = $_POST['confirmar_senha'];
    $email = $_SESSION['email'];
    $user_type = $_SESSION['user_type'];

    if ($nova_senha !== $confirmar_senha) {
        $_SESSION['error-message'] = 'As senhas não coincidem.';
        header('Location: ../views/auth/esqueceu-senha.php');
        exit();
    }

    $nova_senha_hashed = password_hash($nova_senha, PASSWORD_DEFAULT);

    $sql = "UPDATE $user_type SET senha = :senha WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':senha', $nova_senha_hashed);
    $stmt->bindValue(':email', $email);

    if ($stmt->execute()) {
        $_SESSION['success-message'] = 'Senha alterada com sucesso!';
        header('Location: ../views/auth/login.php');
    } else {
        $_SESSION['error-message'] = 'Erro ao alterar a senha. Tente novamente.';
        header('Location: ../views/auth/esqueceu-senha.php');
    }
}
?>
