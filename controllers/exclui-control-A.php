<?php
// Verifica se o ID foi passado via GET
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Redireciona para alguma página de erro ou lista de instituições
    header('Location: ../views/error.php');
    exit;
}

// Conexão com o banco de dados
include '../models/conexao.php';

// Obtém o ID do aluno
$id = $_GET['id'];

try {
    // Inicia a transação
    $conn->beginTransaction();

    // Primeiro, obtemos o CEP do aluno
    $queryCep = "SELECT cep FROM aluno WHERE id_aluno = :id";
    $stmtCep = $conn->prepare($queryCep);
    $stmtCep->bindParam(':id', $id, PDO::PARAM_INT);
    $stmtCep->execute();

    // Verifica se o aluno existe
    if ($stmtCep->rowCount() > 0) {
        $cep = $stmtCep->fetchColumn(); // Obtém o CEP do aluno
    } else {
        // Redireciona para alguma página de erro ou tratamento específico
        header('Location: ../views/error.php');
        exit;
    }

    // Em seguida, exclui o registro do aluno
    $queryAluno = "DELETE FROM aluno WHERE id_aluno = :id";
    $stmtAluno = $conn->prepare($queryAluno);
    $stmtAluno->bindParam(':id', $id, PDO::PARAM_INT);
    $stmtAluno->execute();

    // Finalmente, exclui o registro de endereço usando o CEP
    $queryEndereco = "DELETE FROM endereco WHERE cep = :cep";
    $stmtEndereco = $conn->prepare($queryEndereco);
    $stmtEndereco->bindParam(':cep', $cep, PDO::PARAM_STR);
    $stmtEndereco->execute();

    // Verifica se algum registro foi afetado nas duas operações
    if ($stmtAluno->rowCount() > 0 && $stmtEndereco->rowCount() > 0) {
        // Confirma a transação
        $conn->commit();

        // Redireciona de volta para a página principal ou página de listagem
        header('Location: controlealuno.php');
        exit;
    } else {
        // Desfaz a transação em caso de falha
        $conn->rollBack();

        // Redireciona para alguma página de erro ou tratamento específico
        header('Location: ../views/error.php');
        exit;
    }
} catch (PDOException $e) {
    // Desfaz a transação em caso de exceção
    $conn->rollBack();

    echo "Erro ao excluir registro: " . $e->getMessage();
}
?>
