<?php
session_start();
require '../models/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['id_curso'])) {
        $_SESSION['error_message'] = 'ID do curso não fornecido.';
        header('Location: ../views/feed.php');
        exit();
    }

    $id_curso = $_POST['id_curso'];

    $nome_curso = $_POST['nome_curso'];
    $descricao = $_POST['descricao'];
    $areacurso = $_POST['areacurso'];
    $instituicao = $_POST['instituicao'];
    $formato = $_POST['formato'];
    $linksite = $_POST['linksite'];
    $quantidadevagas = $_POST['quantidadevagas'];
    $tipocurso = $_POST['tipocurso'];
    $duracao = $_POST['duracao'];
    $turno = $_POST['turno'];
    $localidade = $_POST['localidade'];
    $inicioinscricoes = $_POST['inicioinscricoes'];
    $terminoinscricoes = $_POST['terminoinscricoes'];
    $foto_curso = null;

    if (isset($_FILES['foto_curso']) && $_FILES['foto_curso']['error'] === UPLOAD_ERR_OK) {
        $nome_temporario = $_FILES['foto_curso']['tmp_name'];
        $nome_arquivo = $_FILES['foto_curso']['name'];
        $caminho_arquivo = '../views/fotos-banco/' . $nome_arquivo;

        if (move_uploaded_file($nome_temporario, $caminho_arquivo)) {
            $foto_curso = $nome_arquivo;
        } else {
            $_SESSION['error_message'] = 'Erro ao fazer upload da imagem.';
            header('Location: ../views/feed.php');
            exit();
        }
    }

    try {
        if ($foto_curso) {
            $sql = "UPDATE curso SET nome_curso = :nome_curso, descricao = :descricao, areacurso = :areacurso, instituicao = :instituicao, formato = :formato, linksite = :linksite, quantidadevagas = :quantidadevagas, tipocurso = :tipocurso, duracao = :duracao, turno = :turno, localidade = :localidade, inicioinscricoes = :inicioinscricoes, terminoinscricoes = :terminoinscricoes, fotocurso = :fotocurso WHERE id_curso = :id_curso";
        } else {
            $sql = "UPDATE curso SET nome_curso = :nome_curso, descricao = :descricao, areacurso = :areacurso, instituicao = :instituicao, formato = :formato, linksite = :linksite, quantidadevagas = :quantidadevagas, tipocurso = :tipocurso, duracao = :duracao, turno = :turno, localidade = :localidade, inicioinscricoes = :inicioinscricoes, terminoinscricoes = :terminoinscricoes WHERE id_curso = :id_curso";
        }

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nome_curso', $nome_curso, PDO::PARAM_STR);
        $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
        $stmt->bindParam(':areacurso', $areacurso, PDO::PARAM_STR);
        $stmt->bindParam(':instituicao', $instituicao, PDO::PARAM_STR);
        $stmt->bindParam(':formato', $formato, PDO::PARAM_STR);
        $stmt->bindParam(':linksite', $linksite, PDO::PARAM_STR);
        $stmt->bindParam(':quantidadevagas', $quantidadevagas, PDO::PARAM_INT);
        $stmt->bindParam(':tipocurso', $tipocurso, PDO::PARAM_STR);
        $stmt->bindParam(':duracao', $duracao, PDO::PARAM_STR);
        $stmt->bindParam(':turno', $turno, PDO::PARAM_STR);
        $stmt->bindParam(':localidade', $localidade, PDO::PARAM_STR);
        $stmt->bindParam(':inicioinscricoes', $inicioinscricoes, PDO::PARAM_STR);
        $stmt->bindParam(':terminoinscricoes', $terminoinscricoes, PDO::PARAM_STR);
        $stmt->bindParam(':id_curso', $id_curso, PDO::PARAM_INT);

        if ($foto_curso) {
            $stmt->bindParam(':fotocurso', $foto_curso, PDO::PARAM_STR);
        }

        if ($stmt->execute()) {
            $_SESSION['success_message'] = 'Curso atualizado com sucesso.';
        } else {
            $_SESSION['error_message'] = 'Erro ao atualizar curso.';
        }
    } catch (PDOException $e) {
        $_SESSION['error_message'] = 'Erro ao atualizar curso: ' . $e->getMessage();
    }

    header('Location: ../views/feed.php');
    exit();
} else {
    $_SESSION['error_message'] = 'Método inválido para esta requisição.';
    header('Location: ../views/feed.php');
    exit();
}
?>
