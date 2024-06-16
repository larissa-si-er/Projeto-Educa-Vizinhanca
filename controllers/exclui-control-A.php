<?php
// Verifica se o ID foi passado via GET
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Redireciona para alguma página de erro ou lista de instituições
    header('Location: ../views/error.php');
    exit;
}

// Conexão com o banco de dados
include '../models/conexao.php';

// Exclui o registro do banco de dados
$id = $_GET['id'];
$query = "DELETE FROM aluno WHERE id_aluno = :id";

try {
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Define o tipo de dado como inteiro
    $stmt->execute();

    // Verifica se algum registro foi afetado
    if ($stmt->rowCount() > 0) {
        // Redireciona de volta para a página principal ou página de listagem
        header('Location: controlealuno.php');
        exit;
    } else {
        // Redireciona para alguma página de erro ou tratamento específico
        header('Location: ../views/error.php');
        exit;
    }
} catch (PDOException $e) {
    echo "Erro ao excluir registro: " . $e->getMessage();
}
?>
