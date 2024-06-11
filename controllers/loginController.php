<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit']) && !empty($_POST['user']) && !empty($_POST['password'])) {
    include_once('../models/conexao.php'); 
    include_once('../models/users.php');

    $database = new conexao();
    $db = $database->getConnection();

    $user = new User($db);

    $username = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $result = $user->login($username, $password);

    if ($result) {
        // Verifica se a senha fornecida corresponde à senha criptografada no banco de dados
        echo "Senha fornecida: " . $password . "<br>";
        echo "Senha hash no banco de dados: " . $result['dados']['senha'] . "<br>";
        if (password_verify($password, $result['dados']['senha'])) {
            // Autenticação bem-sucedida
            // echo "Bem-vindo, " . $result['tipo'] . "!";
            // echo "<br>";
            echo "Bem-vindo, " . $result['dados']['nome'] . ", " . $result['tipo'] ."!";
            // var_dump($result['dados']);
    
            // Redirecionar para o painel apropriado com base no tipo de usuário
            // header('Location: ../views/' . $result['tipo'] . '/dashboard.php');
            // exit();
        } else {
            // Senha incorreta
            $_SESSION['login_error'] = 'Credenciais inválidas. Tente novamente.';
            header('Location: ../views/auth/login.php');
            exit();
        }
    } else {
        // Usuário não encontrado
        $_SESSION['login_error'] = 'Usuário nao encontrado.';
        echo "User not found!<br>";
        header('Location: ../views/auth/login.php');
        // echo "Username: " . $username . "<br>";
        // echo "Password: " . $password . "<br>";
        // header('Location: ../views/auth/login.php');
        exit();
    }
} else {
    // Se o método de solicitação não for POST ou se os campos estiverem vazios
    $_SESSION['login_error'] = 'Erro ao logar. Por favor, preencha todos os campos.';
    header('Location: ../views/auth/login.php');
    exit();
}
?>
