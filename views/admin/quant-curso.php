
<?php
// quant-prod.php

// Incluir arquivo de conexão com o banco de dados
include_once "../../models/conexao.php";

try {
    // Verificar se $conn está definido
    if (isset($conn)) {
        // Consulta SQL para contar o número de registros na tabela curso
        $sql = "SELECT COUNT(*) AS total_cursos FROM curso";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        // Retornar a quantidade de cursos
        echo $resultado['total_cursos'];
    } else {
        echo "Erro: Variável de conexão não está definida.";
    }

} catch(PDOException $e) {
    echo "Erro ao consultar a quantidade de cursos: " . $e->getMessage();
}
?>
