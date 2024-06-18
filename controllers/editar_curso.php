<?php
session_start();
require '../models/conexao.php'; // Substitua pelo caminho correto ao seu arquivo de conexão ao banco de dados

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se o usuário tem permissão para editar cursos
    if ($_SESSION['user_type'] !== 'administracao' && $_SESSION['user_type'] !== 'instituicao') {
        $_SESSION['error_message'] = 'Você não tem permissão para editar este curso.';
        header('Location: cursos.php'); // Redirecione para a página de cursos
        exit();
    }

    // Verifica se o ID do curso foi fornecido
    if (!isset($_POST['id_curso'])) {
        $_SESSION['error_message'] = 'ID do curso não fornecido.';
        header('Location: cursos.php'); // Redirecione para a página de cursos
        exit();
    }

    $id_curso = $_POST['id_curso'];

    // Recupere os dados do curso para edição
    try {
        $sql = "SELECT * FROM curso WHERE id_curso = :id_curso";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_curso', $id_curso, PDO::PARAM_INT);
        $stmt->execute();
        $curso = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$curso) {
            $_SESSION['error_message'] = 'Curso não encontrado.';
            header('Location: cursos.php'); // Redirecione para a página de cursos
            exit();
        }
    } catch (PDOException $e) {
        $_SESSION['error_message'] = 'Erro ao recuperar dados do curso: ' . $e->getMessage();
        header('Location: cursos.php'); // Redirecione para a página de cursos
        exit();
    }

    // Se os dados foram recebidos corretamente, mostre o formulário de edição
    if (!empty($_POST['nome_curso'])) {
        // Atualize os dados do curso no banco de dados
        try {
            $sql = "UPDATE cursos SET nome_curso = :nome_curso, areacurso = :areacurso, instituicao = :instituicao, formato = :formato, linksite = :linksite WHERE id_curso = :id_curso";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nome_curso', $_POST['nome_curso'], PDO::PARAM_STR);
            $stmt->bindParam(':areacurso', $_POST['areacurso'], PDO::PARAM_STR);
            $stmt->bindParam(':instituicao', $_POST['instituicao'], PDO::PARAM_STR);
            $stmt->bindParam(':formato', $_POST['formato'], PDO::PARAM_STR);
            $stmt->bindParam(':linksite', $_POST['linksite'], PDO::PARAM_STR);
            $stmt->bindParam(':id_curso', $id_curso, PDO::PARAM_INT);
            $stmt->execute();

            $_SESSION['success_message'] = 'Curso atualizado com sucesso.';
            header('Location: cursos.php'); // Redirecione para a página de cursos
            exit();
        } catch (PDOException $e) {
            $_SESSION['error_message'] = 'Erro ao atualizar curso: ' . $e->getMessage();
            header('Location: cursos.php'); // Redirecione para a página de cursos
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Curso</title>
</head>
<body>
    <h1>Editar Curso</h1>

    <form action="editar_curso.php" method="post">
        <input type="hidden" name="id_curso" value="<?php echo htmlspecialchars($curso['id_curso']); ?>">
        <label for="nome_curso">Nome do Curso:</label>
        <input type="text" name="nome_curso" id="nome_curso" value="<?php echo htmlspecialchars($curso['nome_curso']); ?>" required>
        <br>
        <label for="areacurso">Área do Curso:</label>
        <input type="text" name="areacurso" id="areacurso" value="<?php echo htmlspecialchars($curso['areacurso']); ?>" required>
        <br>
        <label for="instituicao">Instituição:</label>
        <input type="text" name="instituicao" id="instituicao" value="<?php echo htmlspecialchars($curso['instituicao']); ?>" required>
        <br>
        <label for="formato">Modalidade:</label>
        <input type="text" name="formato" id="formato" value="<?php echo htmlspecialchars($curso['formato']); ?>" required>
        <br>
        <label for="linksite">Link do Site:</label>
        <input type="url" name="linksite" id="linksite" value="<?php echo htmlspecialchars($curso['linksite']); ?>" required>
        <br>
        <button type="submit">Salvar Alterações</button>
    </form>
</body>
</html>
