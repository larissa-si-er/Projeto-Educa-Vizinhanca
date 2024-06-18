<?php
include '../models/conexao.php'; // Inclui a conexão com o banco de dados

try {
    // Conexão com o banco de dados (assumindo que as variáveis $host, $port, $dbname, $user e $pass estão definidas em conexao.php)
    $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta SQL para buscar os dados dos alunos
    $sql = "SELECT registro, nome_insti, cnpj, auth_factor FROM instituicao"; // Ajustado para selecionar 'registro' em vez de 'auth_last'
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // Buscar todos os registros
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Retornar os dados em formato JSON
    echo json_encode($result);
} catch(PDOException $e) {
    // Em caso de erro, retornar uma resposta JSON com a mensagem de erro
    http_response_code(500); // Definir código de resposta HTTP apropriado
    echo json_encode(array('message' => 'Erro ao buscar dados: ' . $e->getMessage()));
}

$conn = null; // Fechar a conexão com o banco de dados
?>


