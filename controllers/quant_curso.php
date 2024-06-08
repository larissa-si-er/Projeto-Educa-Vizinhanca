<?php
require_once 'models/conexao.php';

// Consulta para obter a quantidade de cursos
$sql = "SELECT COUNT(*) AS quantidade_cursos FROM curso";
$result = $conn->query($sql);

if ($result !== false) {
    // Obter o resultado da consulta
    $row = $result->fetch(PDO::FETCH_ASSOC);
    echo isset($row["quantidade_cursos"]) ? $row["quantidade_cursos"] : "0";
} else {
    echo "0"; // Se houver um erro na consulta, mostrar 0
}

$conn = null; // Fechar a conexão
?>