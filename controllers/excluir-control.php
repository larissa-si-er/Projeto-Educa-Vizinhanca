<?php
// Verifica se o ID foi passado via GET
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Redireciona para alguma página de erro ou lista de instituições
    header('Location: controleinsti.php');
    exit;
}

// Conexão com o banco de dados
include '../models/conexao.php';


// Exclui o registro do banco de dados
$id = $_GET['id'];
$query = "DELETE FROM instituicao WHERE id_instituicao = :id";

try {
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    // Redireciona de volta para a página principal ou página de listagem
    header('Location: controleinsti.php');
    exit;
} catch (PDOException $e) {
    echo "Erro ao excluir registro: " . $e->getMessage();
}
?>
