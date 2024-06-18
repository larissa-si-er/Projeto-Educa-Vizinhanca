<?php
// feedController.php

// Verificar se o método é DELETE e se o id_curso está presente na requisição
if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET['id_curso'])) {
    // Simular conexão com o banco de dados
    // Substitua isso com sua lógica de conexão real
    $pdo = new PDO('mysql:host=localhost;dbname=seu_banco_de_dados', 'seu_usuario', 'sua_senha');
    $id_curso = $_GET['id_curso'];
    
    // Exemplo de código para exclusão (substitua pelo seu código real)
    $sql = "DELETE FROM cursos WHERE id_curso = :id_curso";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_curso', $id_curso, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        // Exemplo de resposta JSON
        header('Content-Type: application/json');
        echo json_encode(['deleted' => true]);
        exit;
    } else {
        // Se houver um erro na exclusão, retorna um erro
        http_response_code(500); // Erro interno do servidor
        echo json_encode(['error' => 'Erro ao deletar o curso']);
        exit;
    }
} else {
    // Se o método não for DELETE ou o id_curso não estiver presente, retorna um erro
    http_response_code(400); // Requisição inválida
    echo json_encode(['error' => 'Método não permitido ou id_curso não fornecido']);
    exit;
}
?>
