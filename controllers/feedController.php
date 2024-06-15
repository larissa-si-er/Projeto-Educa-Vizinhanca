<?php
// controllers/curso_control.php

// session_start();
require_once('../models/conexao.php');
require_once('../models/feed.php');
// require_once('../models/curso.php');

// Criar uma instância da classe Curso
$cursoModel = new Curso($conn);

// Verifica se uma ação foi enviada pelo formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        
        switch ($action) {
            case 'like':
                if (isset($_POST['id_curso'])) {
                    $id_aluno = $_SESSION['id_aluno']; // Supondo que você tenha o id do usuário na sessão
                    $id_curso = $_POST['id_curso'];
                    if ($cursoModel->like($id_aluno, $id_curso)) {
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
                    if ($cursoModel->comment($id_aluno, $id_curso, $comment_text)) {
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
                    if ($cursoModel->share($id_aluno, $id_curso)) {
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
