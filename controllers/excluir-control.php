<?php
// Verifica se o ID foi passado via GET
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Redireciona para alguma página de erro ou lista de instituições
    header('Location: ../views/error.php');
    exit;
}

// Conexão com o banco de dados
include '../models/conexao.php';

// Obtém o ID da instituição
$id = $_GET['id'];

try {
    // Inicia a transação
    $conn->beginTransaction();

    // Primeiro, obtemos o CEP da instituição
    $queryCep = "SELECT cep FROM instituicao WHERE id_instituicao = :id";
    $stmtCep = $conn->prepare($queryCep);
    $stmtCep->bindParam(':id', $id, PDO::PARAM_INT);
    $stmtCep->execute();

    // Verifica se a instituição existe
    if ($stmtCep->rowCount() > 0) {
        $cep = $stmtCep->fetchColumn(); // Obtém o CEP da instituição
    } else {
        // Redireciona para alguma página de erro ou tratamento específico
        header('Location: ../views/error.php');
        exit;
    }

    // Em seguida, exclui o registro da instituição
    $queryInstituicao = "DELETE FROM instituicao WHERE id_instituicao = :id";
    $stmtInstituicao = $conn->prepare($queryInstituicao);
    $stmtInstituicao->bindParam(':id', $id, PDO::PARAM_INT);
    $stmtInstituicao->execute();

    // Finalmente, exclui o registro de endereço usando o CEP
    $queryEndereco = "DELETE FROM endereco WHERE cep = :cep";
    $stmtEndereco = $conn->prepare($queryEndereco);
    $stmtEndereco->bindParam(':cep', $cep, PDO::PARAM_STR);
    $stmtEndereco->execute();

    // Verifica se algum registro foi afetado nas duas operações
    if ($stmtInstituicao->rowCount() > 0 && $stmtEndereco->rowCount() > 0) {
        // Confirma a transação
        $conn->commit();

        // Redireciona de volta para a página principal ou página de listagem
        header('Location: controleinsti.php');
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
