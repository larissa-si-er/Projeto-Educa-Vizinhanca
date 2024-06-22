<?php
session_start();
require_once '../../models/conexao.php'; // Verifique o caminho correto aqui

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se o ID do aluno foi fornecido
    if (!isset($_POST['id_aluno'])) {
        $_SESSION['error_message'] = 'ID do aluno não fornecido.';
        header('Location: areaaluno.php');
        exit();
    }

    $id_aluno = $_POST['id_aluno'];

    // Processa a atualização dos dados do aluno
    if (
        !empty($_POST['name']) && 
        !empty($_POST['data_nasc']) && 
        isset($_POST['sexo']) && 
        !empty($_POST['nome_materno']) && 
        !empty($_POST['cpf']) && 
        !empty($_POST['email']) && 
        !empty($_POST['phone']) && 
        !empty($_POST['phone_fixed']) && 
        !empty($_POST['usuario']) && 
        isset($_POST['cep']) && 
        !empty($_POST['cidade']) && 
        !empty($_POST['estado']) && 
        !empty($_POST['logradouro']) && 
        !empty($_POST['bairro']) && 
        !empty($_POST['num']) 
    ) {
        try {
            // Inicia a transação
            $conn->beginTransaction();

            // Sanitiza os dados do formulário
            $nome = htmlspecialchars($_POST['name']);
            $data_nasc = $_POST['data_nasc'];
            $sexo = $_POST['sexo'];
            $nome_materno = htmlspecialchars($_POST['nome_materno']);
            $cpf = $_POST['cpf'];
            $email = $_POST['email'];
            $telefone_celular = $_POST['phone'];
            $telefone_fixo = $_POST['phone_fixed'];
            $usuario = $_POST['usuario'];
            $cep = $_POST['cep'];
            $cidade = htmlspecialchars($_POST['cidade']);
            $estado = htmlspecialchars($_POST['estado']);
            $logradouro = htmlspecialchars($_POST['logradouro']);
            $bairro = htmlspecialchars($_POST['bairro']);
            $num = htmlspecialchars($_POST['num']);

            // SQL para atualizar os dados do aluno
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
                              cep = :cep, 
                              cidade = :cidade, 
                              estado = :estado, 
                              logradouro = :logradouro, 
                              bairro = :bairro,
                              num = :num
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
            $stmt_update->bindParam(':cidade', $cidade, PDO::PARAM_STR);
            $stmt_update->bindParam(':estado', $estado, PDO::PARAM_STR);
            $stmt_update->bindParam(':logradouro', $logradouro, PDO::PARAM_STR);
            $stmt_update->bindParam(':bairro', $bairro, PDO::PARAM_STR);
            $stmt_update->bindParam(':num', $num, PDO::PARAM_STR);
            $stmt_update->bindParam(':id_aluno', $id_aluno, PDO::PARAM_INT);

            if ($stmt_update->execute()) {
                // Commit se a atualização for bem-sucedida
                $conn->commit();
                $_SESSION['success_message'] = 'Dados do aluno atualizados com sucesso.';
            } else {
                // Rollback se houver erro na execução do SQL
                $conn->rollBack();
                $_SESSION['error_message'] = 'Erro ao atualizar dados do aluno.';
            }
        } catch (PDOException $e) {
            // Rollback se houver exceção
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
