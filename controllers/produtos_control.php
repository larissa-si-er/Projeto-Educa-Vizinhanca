<?php
    include '../models/conexao.php';

    $sql = "SELECT nome_produto, descricao, preco, imagem FROM produto";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Verificação para garantir que os produtos foram buscados
    if ($produtos === false) {
        $produtos = [];
    }
// Buscar produtos para a seção "CONFIRA NOSSOS LANÇAMENTOS"
$sqlLancamentos = "SELECT nome_produto, descricao, preco, imagem FROM produto WHERE is_lancamento = 1 LIMIT 4";
$stmtLancamentos = $conn->prepare($sqlLancamentos);
$stmtLancamentos->execute();
$lancamentos = $stmtLancamentos->fetchAll(PDO::FETCH_ASSOC);

if ($lancamentos === false) {
    $lancamentos = [];
}

// Verifica se o formulário foi submetido para inserção de um novo produto
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera os dados do formulário
    $nome_produto = $_POST['nome_produto'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $quantidade_estoque = $_POST['quantidade_estoque'];
    $imagem = $_POST['imagem'];
    $categoria = $_POST['categoria'];
    $is_lancamento = $_POST['is_lancamento'];
    $cor = $_POST['cor'];

    try {
        // Prepara a instrução SQL para inserção
        $sql = "INSERT INTO produto (nome_produto, descricao, preco, quantidade_estoque, imagem, categoria, is_lancamento, cor) 
                VALUES (:nome_produto, :descricao, :preco, :quantidade_estoque, :imagem, :categoria, :is_lancamento, :cor)";
        $stmt = $conn->prepare($sql);

        // Bind dos parâmetros
        $stmt->bindParam(':nome_produto', $nome_produto);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':quantidade_estoque', $quantidade_estoque);
        $stmt->bindParam(':imagem', $imagem);
        $stmt->bindParam(':categoria', $categoria);
        $stmt->bindParam(':is_lancamento', $is_lancamento);
        $stmt->bindParam(':cor', $cor);

        // Executa a instrução
        $stmt->execute();

        // Define a mensagem de feedback na sessão
        session_start();
        $_SESSION['error_message'] = '';
        
        // Redireciona para a página de administração
        header("Location: ../views/admin/areaadm.php");
        exit(); // Certifique-se de sair após o redirecionamento
    } catch (PDOException $e) {
        // Em caso de erro, definir a mensagem de erro na sessão
        session_start();
        $_SESSION['mensagem'] = "Erro ao inserir o produto: " . $e->getMessage();
        
        // Redireciona para a página de administração
        header("Location: areaadm.php");
        exit(); // Certifique-se de sair após o redirecionamento
    }
}

// IMAGEM LOGICA


