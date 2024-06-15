<?php
session_start();

// Inclui o arquivo de conexão
require_once 'conexao.php';

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se a resposta foi fornecida
    if (isset($_POST['resposta']) && !empty($_POST['resposta'])) {
        $resposta = $_POST['resposta'];
        
        // Busca no banco de dados pelo usuário logado
        $usuario = $_SESSION['usuario']; // Supondo que você tenha armazenado o usuário na sessão
        
        $sql = "SELECT auth_factor, auth_answer FROM aluno WHERE usuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $stmt->bind_result($auth_factor, $auth_answer);
        $stmt->fetch();
        $stmt->close();
        
        // Verifica se a resposta está correta
        if ($resposta == $auth_answer) {
            // Resposta correta, pode redirecionar para alguma página de sucesso
            header("Location: sucesso.php");
            exit();
        } else {
            // Resposta incorreta, incrementa o contador de tentativas na sessão
            if (!isset($_SESSION['tentativas'])) {
                $_SESSION['tentativas'] = 1;
            } else {
                $_SESSION['tentativas']++;
            }
            
            // Verifica se excedeu o número máximo de tentativas
            if ($_SESSION['tentativas'] >= 3) {
                // Exibe mensagem de erro e redireciona para o login
                echo "3 tentativas sem sucesso! Favor realizar Login novamente.";
                session_unset();
                session_destroy();
                header("Location: login.php");
                exit();
            } else {
                // Ainda há tentativas restantes, pode redirecionar para a página atual
                header("Location: formulario.php");
                exit();
            }
        }
    } else {
        // Resposta não foi fornecida, deve exibir mensagem de erro
        echo "A resposta deve ser preenchida.";
    }
}
?>
