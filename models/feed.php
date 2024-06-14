<?php
require_once('../models/conexao.php'); // Arquivo de configuração do banco de dados

class Curso {
    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    // Método para curtir um curso
    public function like($user_id, $curso_id) {
        try {
            $stmt = $this->conn->prepare("INSERT INTO likes (id_aluno, id_curso, date_time) VALUES (?, ?, NOW())");
            $stmt->execute([$user_id, $curso_id]);
            return true;
        } catch(PDOException $e) {
            echo 'Erro ao curtir o curso: ' . $e->getMessage();
            return false;
        }
    }

    // Método para comentar em um curso
    public function comment($user_id, $curso_id, $comment_text) {
        try {
            $stmt = $this->conn->prepare("INSERT INTO comments (id_aluno, id_curso, texto, date_time) VALUES (?, ?, ?, NOW())");
            $stmt->execute([$user_id, $curso_id, $comment_text]);
            return true;
        } catch(PDOException $e) {
            echo 'Erro ao adicionar o comentário: ' . $e->getMessage();
            return false;
        }
    }

    // Método para compartilhar um curso
    public function share($user_id, $curso_id) {
        try {
            $stmt = $this->conn->prepare("INSERT INTO shares (id_aluno, id_curso, date_time) VALUES (?, ?, NOW())");
            $stmt->execute([$user_id, $curso_id]);
            return true;
        } catch(PDOException $e) {
            echo 'Erro ao compartilhar o curso: ' . $e->getMessage();
            return false;
        }
    }
}
?>
