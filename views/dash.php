<?php
require '../controllers/userController.php'; // Inclui o controlador que 
// include_once('../models/conexao.php'); 
// include_once('../models/users.php');

// Verifica se o usuário está logado
// verificaLogin();
?>
<!DOCTYPE html>
<html lang="PT-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css"/>
    <title>Dashboard</title>
</head>
<body>
    <h1>Bem-vindo ao Dashboard</h1>
    <p>Olá, <?php echo $_SESSION['user']['nome']; ?>!</p>
    <a href="logout.php">Logout</a>
</body>
</html>
