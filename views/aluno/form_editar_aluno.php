<?php
session_start();
require_once '../../models/conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['id_aluno'])) {
        $_SESSION['error_message'] = 'ID do aluno não fornecido.';
        header('Location: areaaluno.php');
        exit();
    }

    $id_aluno = $_POST['id_aluno'];

    if (!empty($_POST['name']) && 
        !empty($_POST['data_nasc']) && 
        isset($_POST['sexo']) && 
        !empty($_POST['nome_materno']) && 
        !empty($_POST['cpf']) && 
        !empty($_POST['email']) && 
        !empty($_POST['phone']) && 
        !empty($_POST['phone_fixed']) && 
        !empty($_POST['usuario']) && 
        isset($_POST['cep'])) {
        
        try {
            $conn->beginTransaction();
            echo 'Iniciando a atualização...';

            $nome = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
            $data_nasc = $_POST['data_nasc'];
            $sexo = $_POST['sexo'];
            $nome_materno = htmlspecialchars($_POST['nome_materno'], ENT_QUOTES, 'UTF-8');
            $cpf = $_POST['cpf'];
            $email = $_POST['email'];
            $telefone_celular = $_POST['phone'];
            $telefone_fixo = $_POST['phone_fixed'];
            $usuario = htmlspecialchars($_POST['usuario'], ENT_QUOTES, 'UTF-8');
            $cep = $_POST['cep'];
   

            $sql_update = "UPDATE aluno 
                           SET nome = :nome, 
                               data_nasc = :data_nasc, 
                               sexo = :sexo, 
                               nome_materno = :nome_materno, 
                               cpf = :cpf, 
                               email = :email, 
                               telefone_celular = :telefone_celular, 
                               telefone_fixo = :telefone_fixo, 
                               usuario = :usuario, 
                               cep = :cep
                           WHERE id_aluno = :id_aluno";

            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->bindParam(':nome', $nome, PDO::PARAM_STR);
            $stmt_update->bindParam(':data_nasc', $data_nasc, PDO::PARAM_STR);
            $stmt_update->bindParam(':sexo', $sexo, PDO::PARAM_STR);
            $stmt_update->bindParam(':nome_materno', $nome_materno, PDO::PARAM_STR);
            $stmt_update->bindParam(':cpf', $cpf, PDO::PARAM_STR);
            $stmt_update->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt_update->bindParam(':telefone_celular', $telefone_celular, PDO::PARAM_STR);
            $stmt_update->bindParam(':telefone_fixo', $telefone_fixo, PDO::PARAM_STR);
            $stmt_update->bindParam(':usuario', $usuario, PDO::PARAM_STR);
            $stmt_update->bindParam(':cep', $cep, PDO::PARAM_STR);
            $stmt_update->bindParam(':id_aluno', $id_aluno, PDO::PARAM_INT);

            if ($stmt_update->execute()) {
                $conn->commit();
                $_SESSION['success_message'] = 'Dados do aluno atualizados com sucesso.';
            } else {
                $conn->rollBack();
                $_SESSION['error_message'] = 'Erro ao atualizar dados do aluno.';
            }
        } catch (PDOException $e) {
            $conn->rollBack();
            $_SESSION['error_message'] = 'Erro ao atualizar dados do aluno: ' . $e->getMessage();
        }
    } else {
        $_SESSION['error_message'] = 'Todos os campos são obrigatórios.';
    }

    header('Location: areaaluno.php');
    exit();
} else {
    $_SESSION['error_message'] = 'Método inválido para esta requisição.';
    header('Location: areaaluno.php');
    exit();
}
?>
