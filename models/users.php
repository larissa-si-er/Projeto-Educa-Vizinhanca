<?php

session_start();

class User {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // public function login($username, $password) {
    //     $user_types = ['aluno', 'instituicao', 'administracao'];

    //     foreach ($user_types as $type) {
    //         $sql = "SELECT * FROM $type WHERE (email = :username OR usuario = :username) AND senha = :pass";
    //         $stmt = $this->conn->prepare($sql);
    //         $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    //         $stmt->bindParam(':pass', $password, PDO::PARAM_STR);
    //         $stmt->execute();
    //         $result = $stmt->fetch(PDO::FETCH_ASSOC);

    //         if ($result) {
    //             return array('tipo' => $type, 'dados' => $result);
    //         }
    //     }

    
    //     return false;
    // }

    public function login($username) {
        $user_types = ['aluno', 'instituicao', 'administracao'];

        foreach ($user_types as $type) {
            $sql = "SELECT * FROM $type WHERE email = :username OR usuario = :username";
            // echo "SQL: " . $sql . "<br>";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                // echo "User data: <br>";
                // var_dump($result);
                // echo "<br>";
                // data e hora atuais - login
                $sql_update = "UPDATE aluno SET registro = CURRENT_TIMESTAMP WHERE id_aluno = :aluno_id";
                $stmt_update = $this->conn->prepare($sql_update);
                $stmt_update->bindParam(':aluno_id', $result['id_aluno'], PDO::PARAM_INT);
                $stmt_update->execute();  
                
                
                return array('tipo' => $type, 'dados' => $result);
  
            }
        }

        return false;
    }


    public function cadastrarAluno($alunoData) {
        // Verifica se já existe 
        $sql = "SELECT COUNT(*) AS total FROM aluno WHERE usuario = :usuario OR email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':usuario', $alunoData['usuario'], PDO::PARAM_STR);
        $stmt->bindParam(':email', $alunoData['email'], PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($result['total'] > 0) {
            // Já existe um usuário com o mesmo nome de usuário ou e-mail
            $_SESSION['error_message'] = 'A conta já existe.';
            header('Location: ../views/auth/cadastro.php');
            exit();

            return false;
        }
    
        // Iniciar uma transação
        $this->conn->beginTransaction();
    
        try {
            // tabela endereco
            $enderecoSql = "INSERT INTO endereco (cep, cidade, estado, logradouro, bairro, num) VALUES (:cep, :cidade, :estado, :logradouro, :bairro, :num)";
            $stmtEndereco = $this->conn->prepare($enderecoSql);
            $stmtEndereco->bindParam(':cep', $alunoData['cep'], PDO::PARAM_STR);
            $stmtEndereco->bindParam(':cidade', $alunoData['cidade'], PDO::PARAM_STR);
            $stmtEndereco->bindParam(':estado', $alunoData['state'], PDO::PARAM_STR);
            $stmtEndereco->bindParam(':logradouro', $alunoData['logradouro'], PDO::PARAM_STR);
            $stmtEndereco->bindParam(':bairro', $alunoData['bairro'], PDO::PARAM_STR);
            $stmtEndereco->bindParam(':num', $alunoData['num'], PDO::PARAM_STR);
            $stmtEndereco->execute();
    
            // tabela aluno
            $sql = "INSERT INTO aluno (nome, nome_materno, email, cpf, data_nasc, sexo, telefone_celular, telefone_fixo, usuario, senha, cep, registro, auth_factor) VALUES (:nome, :nomeM, :email, :cpf, :nasc, :genero, :cel, :tel, :usuario, :senha, :cep, :registro, '')";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nome', $alunoData['nome'], PDO::PARAM_STR);
            $stmt->bindParam(':nomeM', $alunoData['nomeM'], PDO::PARAM_STR);
            $stmt->bindParam(':email', $alunoData['email'], PDO::PARAM_STR);
            $stmt->bindParam(':cpf', $alunoData['cpf'], PDO::PARAM_STR);
            $stmt->bindParam(':nasc', $alunoData['nasc'], PDO::PARAM_STR);
            $stmt->bindParam(':genero', $alunoData['genero'], PDO::PARAM_STR);
            $stmt->bindParam(':cel', $alunoData['cel'], PDO::PARAM_STR);
            $stmt->bindParam(':tel', $alunoData['tel'], PDO::PARAM_STR);
            $stmt->bindParam(':usuario', $alunoData['usuario'], PDO::PARAM_STR);
            $stmt->bindParam(':senha', $alunoData['senha'], PDO::PARAM_STR);
            $stmt->bindParam(':cep', $alunoData['cep']); // Usar o ID do endereco
            date_default_timezone_set('America/Sao_Paulo');
            $registro = date('Y-m-d H:i:s');
            $stmt->bindParam(':registro', $registro);
            $stmt->execute();
    
            // Commit da transação se tudo ocorrer bem
            $this->conn->commit();
            return true;
        } catch (PDOException $e) {
            // Reverter a transação em caso de erro
            $this->conn->rollBack();
            // echo "Erro ao cadastrar aluno: " . $e->getMessage();
            // $_SESSION['error_message'] = "Erro ao cadastrar aluno: " . $e->getMessage();
            // header('Location: ../views/error.php');
            // return false;
            $_SESSION['error_message'] = "Erro ao cadastrar aluno: " . $e->getMessage();
            // Adicione esta linha para verificar se a mensagem de erro está sendo definida corretamente
            var_dump($_SESSION['error_message']);
            header('Location: ../views/error.php');
            return false;
        }
    }

    // public static function verificaLogin() {        
    //     // verificação se tá logado
    //     if (!isset($_SESSION['user'])) {
    //         session_destroy();
    //         header('Location: ../views/auth/login.php');
    //         exit();
    //     }
    // }   
}

// function verificaLogin() {
//     // Verificação se o usuário está logado
//     if (!isset($_SESSION['usuario']) || !isset($_SESSION['senha'])) {
//         session_destroy();
//         // header('Location: ../views/auth/login.php');
//         exit();
//     }
// }
?>
