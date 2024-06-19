<?php
session_start();
require '../models/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se o usuário tem permissão para editar cursos
    if ($_SESSION['user_type'] !== 'administracao' && $_SESSION['user_type'] !== 'instituicao') {
        $_SESSION['error_message'] = 'Você não tem permissão para editar este curso.';
        header('Location: ../views/feed.php');
        exit();
    }

    // Verifica se o ID do curso foi fornecido
    if (!isset($_POST['id_curso'])) {
        $_SESSION['error_message'] = 'ID do curso não fornecido.';
        header('Location: ../views/feed.php');
        exit();
    }

    $id_curso = $_POST['id_curso'];

    // Recupera os dados do curso para edição
    try {
        $sql = "SELECT * FROM curso WHERE id_curso = :id_curso";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_curso', $id_curso, PDO::PARAM_INT);
        $stmt->execute();
        $curso = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$curso) {
            $_SESSION['error_message'] = 'Curso não encontrado.';
            header('Location: ../views/feed.php');
            exit();
        }
    } catch (PDOException $e) {
        $_SESSION['error_message'] = 'Erro ao recuperar dados do curso: ' . $e->getMessage();
        header('Location: ../views/feed.php');
        exit();
    }

    // Processa a atualização dos dados do curso
    if (!empty($_POST['nome_curso']) && !empty($_POST['areacurso']) && !empty($_POST['instituicao']) && !empty($_POST['formato']) && !empty($_POST['linksite'])) {
        $nome_curso = $_POST['nome_curso'];
        $areacurso = $_POST['areacurso'];
        $instituicao = $_POST['instituicao'];
        $formato = $_POST['formato'];
        $linksite = $_POST['linksite'];

        // Verifica se foi enviado um novo arquivo de foto
        if (isset($_FILES['foto_curso']) && $_FILES['foto_curso']['error'] === UPLOAD_ERR_OK) {
            $nome_temporario = $_FILES['foto_curso']['tmp_name'];
            $nome_arquivo = $_FILES['foto_curso']['name'];
            $caminho_arquivo = '../views/fotos-banco/' . $nome_arquivo;

            // Move o arquivo para o diretório desejado
            if (move_uploaded_file($nome_temporario, $caminho_arquivo)) {
                // Atualiza o caminho da foto no banco de dados
                $foto_curso = $nome_arquivo;
                $sql_update = "UPDATE curso SET nome_curso = :nome_curso, areacurso = :areacurso, instituicao = :instituicao, formato = :formato, linksite = :linksite, fotocurso = :fotocurso WHERE id_curso = :id_curso";

                try {
                    $stmt_update = $conn->prepare($sql_update);
                    $stmt_update->bindParam(':nome_curso', $nome_curso, PDO::PARAM_STR);
                    $stmt_update->bindParam(':areacurso', $areacurso, PDO::PARAM_STR);
                    $stmt_update->bindParam(':instituicao', $instituicao, PDO::PARAM_STR);
                    $stmt_update->bindParam(':formato', $formato, PDO::PARAM_STR);
                    $stmt_update->bindParam(':linksite', $linksite, PDO::PARAM_STR);
                    $stmt_update->bindParam(':fotocurso', $foto_curso, PDO::PARAM_STR);
                    $stmt_update->bindParam(':id_curso', $id_curso, PDO::PARAM_INT);

                    if ($stmt_update->execute()) {
                        $_SESSION['success_message'] = 'Curso atualizado com sucesso.';
                    } else {
                        $_SESSION['error_message'] = 'Erro ao atualizar curso.';
                    }
                } catch (PDOException $e) {
                    $_SESSION['error_message'] = 'Erro ao atualizar curso: ' . $e->getMessage();
                }
            } else {
                $_SESSION['error_message'] = 'Erro ao fazer upload do arquivo.';
            }
        } else {
            // Se não foi enviado um novo arquivo, atualiza apenas os dados do curso
            $sql_update = "UPDATE curso SET nome_curso = :nome_curso, areacurso = :areacurso, instituicao = :instituicao, formato = :formato, linksite = :linksite WHERE id_curso = :id_curso";

            try {
                $stmt_update = $conn->prepare($sql_update);
                $stmt_update->bindParam(':nome_curso', $nome_curso, PDO::PARAM_STR);
                $stmt_update->bindParam(':areacurso', $areacurso, PDO::PARAM_STR);
                $stmt_update->bindParam(':instituicao', $instituicao, PDO::PARAM_STR);
                $stmt_update->bindParam(':formato', $formato, PDO::PARAM_STR);
                $stmt_update->bindParam(':linksite', $linksite, PDO::PARAM_STR);
                $stmt_update->bindParam(':id_curso', $id_curso, PDO::PARAM_INT);

                if ($stmt_update->execute()) {
                    $_SESSION['success_message'] = 'Curso atualizado com sucesso.';
                } else {
                    $_SESSION['error_message'] = 'Erro ao atualizar curso.';
                }
            } catch (PDOException $e) {
                $_SESSION['error_message'] = 'Erro ao atualizar curso: ' . $e->getMessage();
            }
        }
    } else {
        $_SESSION['error_message'] = 'Todos os campos são obrigatórios.';
    }

    header('Location: ../views/feed.php');
    exit();
} else {
    $_SESSION['error_message'] = 'Método inválido para esta requisição.';
    header('Location: ../views/feed.php');
    exit();
}
?>
