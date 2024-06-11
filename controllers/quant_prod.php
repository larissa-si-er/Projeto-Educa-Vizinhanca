<?php
require_once 'models/conexao.php';

// Consulta para obter a quantidade de produtos
$sql = "SELECT COUNT(*) AS quantidade_estoque FROM produto";
$result = $conn->query($sql);

if ($result !== false) {
    // Obter o resultado da consulta
    $row = $result->fetch(PDO::FETCH_ASSOC);
    echo isset($row["quantidade_estoque"]) ? $row["quantidade_estoque"] : "0";
} else {
    echo "0"; // Se não houver produtos, mostrar 0
}

$conn = null; // Fechar a conexão
?>


