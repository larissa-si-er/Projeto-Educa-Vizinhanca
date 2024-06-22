<?php
// Inclua o arquivo de conexão com o banco de dados
require_once '../../models/conexao.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Verifica se todos os dados necessários foram recebidos
    if (isset($_POST['id_curso'], $_POST['comentario'])) {
        $id_curso = $_POST['id_curso'];
        $comentario = $_POST['comentario'];

        // Busca o id do usuário logado
        if (isset($_SESSION['user_data']['id_aluno'])) {
            $id_usuario = $_SESSION['user_data']['id_aluno'];
        } else {
            echo json_encode(['error' => 'Usuário não logado']);
            exit();
        }

        try {
            // Insere o comentário no banco de dados
            $stmt = $conn->prepare("INSERT INTO comentario (id_aluno, id_curso, texto) VALUES (:id_aluno, :id_curso, :texto)");
            $stmt->bindParam(':id_aluno', $id_usuario, PDO::PARAM_INT);
            $stmt->bindParam(':id_curso', $id_curso, PDO::PARAM_INT);
            $stmt->bindParam(':texto', $comentario, PDO::PARAM_STR);
            $stmt->execute();
            $stmt->closeCursor();

            // Retorna a lista atualizada de comentários
            fetchComentarios($id_curso);
        } catch (PDOException $e) {
            echo json_encode(['error' => "Erro ao processar o comentário: " . $e->getMessage()]);
            exit();
        }
    }
} elseif ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['id_curso'], $_GET['page'], $_GET['limit'])) {
    $id_curso = $_GET['id_curso'];
    fetchComentarios($id_curso, $_GET['page'], $_GET['limit']);
}

function fetchComentarios($id_curso, $page = 1, $limit = 5) {
    global $conn;
    try {
        $offset = ($page - 1) * $limit;
        $stmt = $conn->prepare("SELECT c.texto, a.usuario, c.data_time 
                               FROM comentario c
                               INNER JOIN aluno a ON c.id_aluno = a.id_aluno
                               WHERE c.id_curso = :id_curso
                               ORDER BY c.data_time DESC
                               LIMIT :limit OFFSET :offset");
        $stmt->bindParam(':id_curso', $id_curso, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $comentarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        // Verifica se há mais comentários
        $stmt = $conn->prepare("SELECT COUNT(*) FROM comentario WHERE id_curso = :id_curso");
        $stmt->bindParam(':id_curso', $id_curso, PDO::PARAM_INT);
        $stmt->execute();
        $totalComentarios = $stmt->fetchColumn();
        $stmt->closeCursor();

        $hasMore = ($totalComentarios > $page * $limit);

        // Formatando a data antes de enviar como resposta JSON
        foreach ($comentarios as &$comentario) {
            $comentario['data_time'] = date('d/m/Y H:i', strtotime($comentario['data_time']));
        }

        echo json_encode(['comentarios' => $comentarios, 'hasMore' => $hasMore]);
        exit();
    } catch (PDOException $e) {
        echo json_encode(['error' => "Erro ao buscar os comentários: " . $e->getMessage()]);
        exit();
    }
}
?>
