<?php
require '../models/conexao.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['id_curso']) || empty($_POST['id_curso'])) {
        $_SESSION['error_message'] = 'ID do curso não fornecido.';
        exit();
    }

    $id_curso = $_POST['id_curso'];

    try {
        if ($conn) {
            echo "Conexão estabelecida com sucesso.<br>";
            var_dump($_POST);
            var_dump($_SESSION['success_message']);
            
        } else {
            echo "Falha na conexão.<br>";
        }

        echo "ID do curso: $id_curso<br>";

        $sql = "DELETE FROM curso WHERE id_curso = :id_curso";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':id_curso', $id_curso, PDO::PARAM_INT);
        $stmt->execute();

        $_SESSION['success_message'] = 'Curso deletado com sucesso.';
        header('Location: ../views/feed.php?deletion=success');
        exit();


    } catch (PDOException $e) {
        $_SESSION['error_message'] = 'Erro ao deletar curso: ' . $e->getMessage();
    }
}
?>
