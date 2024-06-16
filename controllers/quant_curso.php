<?php
require_once '../models/conexao.php';

try {
    // Consulta para obter a quantidade de cursos
    $sql = "SELECT COUNT(*) AS quantidade_cursos FROM curso";
    $stmt = $conn->query($sql);

    if ($stmt !== false) {
        // Obter o resultado da consulta
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        echo isset($row["quantidade_cursos"]) ? $row["quantidade_cursos"] : "0";
    } else {
        echo "0"; // Se houver um erro na consulta, mostrar 0
    }
} catch (PDOException $e) {
    echo "0"; // Em caso de exceção, mostrar 0
}

$conn = null; // Fechar a conexão
?>
