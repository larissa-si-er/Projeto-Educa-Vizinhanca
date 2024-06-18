<?php
session_start();
require '../models/conexao.php'; // Substitua pelo caminho correto ao seu arquivo de conexão ao banco de dados

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se o ID do curso foi fornecido
    if (!isset($_POST['id_curso']) || empty($_POST['id_curso'])) {
        $_SESSION['error_message'] = 'ID do curso não fornecido.';
        // header('Location: ../views/feed.php'); 
        exit();
    }

    $id_curso = $_POST['id_curso'];

    try {
        // Verifica a conexão
        if ($conn) {
            echo "Conexão estabelecida com sucesso.<br>";
            var_dump($_POST);
            var_dump($_SESSION['success_message']);
            
        } else {
            echo "Falha na conexão.<br>";
        }

        // Verifica o ID do curso
        echo "ID do curso: $id_curso<br>";

        $sql = "DELETE FROM curso WHERE id_curso = :id_curso";
        $stmt = $conn->prepare($sql);

        // Verifica a preparação da consulta
        if ($stmt) {
            echo "Consulta preparada com sucesso.<br>";
        } else {
            echo "Falha na preparação da consulta.<br>";
        }

        $stmt->bindParam(':id_curso', $id_curso, PDO::PARAM_INT);
        $stmt->execute();

        $_SESSION['success_message'] = 'Curso deletado com sucesso.';
    } catch (PDOException $e) {
        $_SESSION['error_message'] = 'Erro ao deletar curso: ' . $e->getMessage();
        
    }

    $_SESSION['error_message'] = 'Erro ao deletar curso';
    // var_dump($_POST);
    // var_dump($curso['areacurso']);

    header('Location: ../views/feed.php'); 
    exit();
}
?>