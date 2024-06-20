<?php
session_start();

require_once 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['resposta']) && !empty($_POST['resposta'])) {
        $resposta = $_POST['resposta'];
        
        $usuario = $_SESSION['usuario']; 
        
        $sql = "SELECT auth_factor, auth_answer FROM aluno WHERE usuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $stmt->bind_result($auth_factor, $auth_answer);
        $stmt->fetch();
        $stmt->close();
        
        if ($resposta == $auth_answer) {
            header("Location: sucesso.php");
            exit();
        } else {
            // Resposta incorreta, incrementa o contador de tentativas na sessão
            if (!isset($_SESSION['tentativas'])) {
                $_SESSION['tentativas'] = 1;
            } else {
                $_SESSION['tentativas']++;
            }
            
            if ($_SESSION['tentativas'] >= 3) {
                echo "3 tentativas sem sucesso! Favor realizar Login novamente.";
                session_unset();
                session_destroy();
                header("Location: ../views/auth/login.php");
                exit();
            } else {
                header("Location: ../views/auth/login.php");
                exit();
            }
        }
    } else {
        echo "A resposta deve ser preenchida.";
    }
}
?>
