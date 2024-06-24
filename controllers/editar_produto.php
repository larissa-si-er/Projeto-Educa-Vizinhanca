<?php
session_start();
require '../models/conexao.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['id_produto'])) {
        $_SESSION['error_message'] = 'ID do produto não fornecido.';
        header('Location: ../views/produtos.php');
        exit();
    }

    $id_produto = $_POST['id_produto'];

    $nome_produto = $_POST['nome_produto'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $quantidade_estoque = $_POST['quantidade_estoque'];
    $categoria = $_POST['categoria'];
    $cor = $_POST['cor'];
    $imagem = null;

    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        $nome_temporario = $_FILES['imagem']['tmp_name'];
        $nome_arquivo = $_FILES['imagem']['name'];
        $caminho_arquivo = '../views/fotos-banco/' . $nome_arquivo;

        if (move_uploaded_file($nome_temporario, $caminho_arquivo)) {
            $imagem = $nome_arquivo;
        } else {
            $_SESSION['error_message'] = 'Erro ao fazer upload da imagem.';
            header('Location: ../views/produtos.php');
            exit();
        }
    }

    try {
        if ($imagem) {
            $sql = "UPDATE produto SET nome_produto = :nome_produto, descricao = :descricao, preco = :preco, quantidade_estoque = :quantidade_estoque, imagem = :imagem, categoria = :categoria, cor = :cor WHERE id_produto = :id_produto";
        } else {
            $sql = "UPDATE produto SET nome_produto = :nome_produto, descricao = :descricao, preco = :preco, quantidade_estoque = :quantidade_estoque, categoria = :categoria, cor = :cor WHERE id_produto = :id_produto";
        }

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nome_produto', $nome_produto, PDO::PARAM_STR);
        $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
        $stmt->bindParam(':preco', $preco, PDO::PARAM_STR);
        $stmt->bindParam(':quantidade_estoque', $quantidade_estoque, PDO::PARAM_INT);
        $stmt->bindParam(':categoria', $categoria, PDO::PARAM_STR);
        $stmt->bindParam(':cor', $cor, PDO::PARAM_STR);
        $stmt->bindParam(':id_produto', $id_produto, PDO::PARAM_INT);

        if ($imagem) {
            $stmt->bindParam(':imagem', $imagem, PDO::PARAM_STR);
        }

        if ($stmt->execute()) {
            $_SESSION['success_message'] = 'Produto atualizado com sucesso.';
        } else {
            $_SESSION['error_message'] = 'Erro ao atualizar produto.';
        }
    } catch (PDOException $e) {
        $_SESSION['error_message'] = 'Erro ao atualizar produto: ' . $e->getMessage();
    }

    header('Location: ../views/produtos.php');
    exit();
} else {
    $_SESSION['error_message'] = 'Método inválido para esta requisição.';
    header('Location: ../views/produtos.php');
    exit();
}
?>
