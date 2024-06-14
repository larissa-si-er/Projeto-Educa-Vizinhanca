<?php
// include_once '../models/Feed.php';

// class FeedController {
//     private $feedModel;

//     public function __construct() {
//         $this->feedModel = new Feed();
//     }

//     public function index() {
//         $feeds = $this->feedModel->getAllFeeds();
//         // Aqui você pode passar os dados para a view (feed.php)
//         include_once '../views/feed.php';
//     }

//     // Métodos para curtir, comentar e compartilhar podem ser adicionados aqui
// }

?>

<?php
session_start();

require_once('../models/conexao.php'); // Arquivo de configuração do banco de dados

// Função para curtir um curso
function likeCourse($id_aluno, $id_curso) {
    global $conn;

    try {
        $stmt = $conn->prepare("INSERT INTO likes (id_aluno, id_curso, data_time) VALUES (?, ?, NOW())");
        $stmt->execute([$id_aluno, $id_curso]);
        return true;
    } catch(PDOException $e) {
        echo 'Erro ao curtir o curso: ' . $e->getMessage();
        return false;
    }
}

// Função para comentar em um curso
function commentCourse($id_aluno, $id_curso, $comment_text) {
    global $conn;

    try {
        $stmt = $conn->prepare("INSERT INTO comments (id_aluno, id_curso, texto, data_time) VALUES (?, ?, ?, NOW())");
        $stmt->execute([$id_aluno, $id_curso, $comment_text]);
        return true;
    } catch(PDOException $e) {
        echo 'Erro ao adicionar o comentário: ' . $e->getMessage();
        return false;
    }
}

// Função para compartilhar um curso
function shareCourse($id_aluno, $id_curso) {
    global $conn;

    try {
        $stmt = $conn->prepare("INSERT INTO shares (id_aluno, id_curso, data_time) VALUES (?, ?, NOW())");
        $stmt->execute([$id_aluno, $id_curso]);
        return true;
    } catch(PDOException $e) {
        echo 'Erro ao compartilhar o curso: ' . $e->getMessage();
        return false;
    }
}

// Verifica se uma ação foi enviada pelo formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        
        switch ($action) {
            case 'like':
                if (isset($_POST['id_curso'])) {
                    $id_aluno = $_SESSION['id_aluno']; // Supondo que você tenha o id do usuário na sessão
                    $id_curso = $_POST['id_curso'];
                    if (likeCourse($id_aluno, $id_curso)) {
                        echo 'Curso curtido com sucesso!';
                    } else {
                        echo 'Erro ao curtir o curso.';
                    }
                }
                break;
                
            case 'comment':
                if (isset($_POST['id_curso'], $_POST['comment_text'])) {
                    $id_aluno = $_SESSION['id_aluno'];
                    $id_curso = $_POST['id_curso'];
                    $comment_text = $_POST['comment_text'];
                    if (commentCourse($id_aluno, $id_curso, $comment_text)) {
                        echo 'Comentário adicionado com sucesso!';
                    } else {
                        echo 'Erro ao adicionar o comentário.';
                    }
                }
                break;
                
            case 'share':
                if (isset($_POST['id_curso'])) {
                    $id_aluno = $_SESSION['id_aluno'];
                    $id_curso = $_POST['id_curso'];
                    if (shareCourse($id_aluno, $id_curso)) {
                        echo 'Curso compartilhado com sucesso!';
                    } else {
                        echo 'Erro ao compartilhar o curso.';
                    }
                }
                break;
                
            default:
                echo 'Ação inválida.';
                break;
        }
    } else {
        echo 'Nenhuma ação especificada.';
    }
}
?>
