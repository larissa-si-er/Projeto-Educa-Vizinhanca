<?php
require_once '../../models/conexao.php';


session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../views/auth/login.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se todos os campos estão preenchidos
    if (isset($_POST['id_instituicao']) && isset($_POST['nome_insti']) && isset($_POST['email']) && 
        isset($_POST['data_fundacao']) && isset($_POST['cnpj']) && isset($_POST['telefone_celular']) && isset($_POST['telefone_fixo']) && 
        isset($_POST['cep']) && isset($_POST['usuario']) && isset($_POST['senha'])) {

        $id_instituicao = $_POST['id_instituicao'];
        $nome_insti = $_POST['nome_insti'];
        $email = $_POST['email'];
        $data_fundacao = $_POST['data_fundacao'];
        $cnpj = $_POST['cnpj'];
        $telefone_celular = $_POST['telefone_celular'];
        $telefone_fixo = $_POST['telefone_fixo'];
        $cep = $_POST['cep'];
        $usuario = $_POST['usuario'];
        $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

        try {
            $sql = "UPDATE instituicao SET 
                     nome_insti = :nome_insti, email = :email, data_fundacao = :data_fundacao, cnpj = :cnpj, 
                    telefone_celular = :telefone_celular, telefone_fixo = :telefone_fixo, cep = :cep, usuario = :usuario, senha = :senha 
                    WHERE id_instituicao = :id_instituicao";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nome_insti', $nome_insti);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':data_fundacao', $data_fundacao);
            $stmt->bindParam(':cnpj', $cnpj);
            $stmt->bindParam(':telefone_celular', $telefone_celular);
            $stmt->bindParam(':telefone_fixo', $telefone_fixo);
            $stmt->bindParam(':cep', $cep);
            $stmt->bindParam(':usuario', $usuario);
            $stmt->bindParam(':senha', $senha);
            $stmt->bindParam(':id_instituicao', $id_instituicao, PDO::PARAM_INT);

            $stmt->execute();

            $_SESSION['success_message'] = 'Dados atualizados com sucesso!';
        } catch (PDOException $e) {
            $_SESSION['error_message'] = 'Erro ao atualizar dados: ' . $e->getMessage();
        }
    } else {
        $_SESSION['error_message'] = 'Todos os campos são obrigatórios.';
    }

    header('Location: areainsti.php');
    exit();
} else {
    $_SESSION['error_message'] = 'Método inválido para esta requisição.';
    header('Location: areainsti.php');
    exit();
}
?>
