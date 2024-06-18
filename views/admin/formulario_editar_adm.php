<?php
session_start();

// Verifica se o administrador está logado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../views/auth/login.php');
    exit();
}

// Verifica se o ID do administrador está definido na sessão
if (!isset($_SESSION['id_admin'])) {
    echo "Erro: ID do administrador não encontrado na sessão.";
    exit();
}

// Obtém o ID do administrador da sessão
$id_admin = $_SESSION['id_admin'];

// Inclui o arquivo de conexão com o banco de dados
include '../../models/conexao.php';

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se todos os campos foram preenchidos
    if (isset($_POST["usuario"]) && isset($_POST["email"])) {
        $usuario = $_POST["usuario"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];

        // Verifica se o campo de senha não está vazio para evitar alterações acidentais
        if (!empty($senha)) {
            // Atualiza os dados na tabela
            $sql = "UPDATE administracao SET usuario = :usuario, email = :email, senha = :senha WHERE id_admin = :id_admin";

            try {
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':usuario', $usuario);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':senha', $senha);
                $stmt->bindParam(':id_admin', $id_admin);

                $stmt->execute();

                echo "Dados atualizados com sucesso!";
            } catch (PDOException $e) {
                echo "Erro ao atualizar dados: " . $e->getMessage();
            }
        } else {
            echo "Por favor, preencha todos os campos.";
        }
    } else {
        echo "Por favor, preencha todos os campos.";
    }
}
?>
