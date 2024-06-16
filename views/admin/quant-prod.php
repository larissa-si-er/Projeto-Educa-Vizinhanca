<?php
// quant-prod.php

// Incluir arquivo de conexão com o banco de dados
include_once "../../models/conexao.php";

try {
    // Verificar se $conn está definido
    if (isset($conn)) {
        // Consulta SQL para contar o número de registros na tabela produtos
        $sql = "SELECT COUNT(*) AS total_produtos FROM produto";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        // Retornar a quantidade de produtos
        echo $resultado['total_produtos'];
    } else {
        echo "Erro: Variável de conexão não está definida.";
    }

} catch(PDOException $e) {
    echo "Erro ao consultar a quantidade de produtos: " . $e->getMessage();
}
?>
