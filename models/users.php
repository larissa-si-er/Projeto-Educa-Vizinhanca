<?php

session_start();

class User {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function login($username) {
        $user_types = ['aluno', 'instituicao', 'administracao'];

        foreach ($user_types as $type) {
            $sql = "SELECT * FROM $type WHERE email = :username OR usuario = :username";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                // Atualiza a data e hora do login
                $userIdField = $type == 'aluno' ? 'id_aluno' : ($type == 'instituicao' ? 'id_instituicao' : 'id_admin');
                $sql_update = "UPDATE $type SET registro = CURRENT_TIMESTAMP WHERE $userIdField = :id";
                $stmt_update = $this->conn->prepare($sql_update);
                $stmt_update->bindParam(':id', $result[$userIdField], PDO::PARAM_INT);
                $stmt_update->execute();

                // Armazena informações na sessão
                $_SESSION['loggedin'] = true;
                $_SESSION['user_type'] = $type;
                $_SESSION['user_data'] = $result;
                // $_SESSION['username'] = $username; // ou $result['usuario']
                // $_SESSION['user_email'] = $result['email'];
                // $_SESSION['last_login'] = $result['registro'];

                return array('tipo' => $type, 'dados' => $result);
            }
        }
        return false; // Retorna falso se o login falhar
    }


    // teste ok

    private function gerarAuthFactor() {
        $opcoes = array('cep', 'data_nasc', 'nome_materno');
        
        $index = array_rand($opcoes);
        return $opcoes[$index];
    }
    private function gerarAuthFactorInstituicao() {
        $opcoes = array('cep', 'data_fundacao', 'cnpj');
        
        $index = array_rand($opcoes);
        return $opcoes[$index];
    }

    public function cadastrarAluno($alunoData) {

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


        // Gerar auth_factor aleatório
        $auth_factor = $this->gerarAuthFactor();
    
            // tabela aluno
            $sql = "INSERT INTO aluno (nome, nome_materno, email, cpf, data_nasc, sexo, telefone_celular, telefone_fixo, usuario, senha, cep, registro, auth_factor) VALUES (:nome, :nomeM, :email, :cpf, :nasc, :genero, :cel, :tel, :usuario, :senha, :cep, :registro, :auth_factor)";
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
            $stmt->bindParam(':cep', $alunoData['cep']); 
            date_default_timezone_set('America/Sao_Paulo');
            $registro = date('Y-m-d H:i:s');
            $stmt->bindParam(':registro', $registro);
            $stmt->bindParam(':auth_factor', $auth_factor, PDO::PARAM_STR); 
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
    public function cadastrarInstituicao($instituicaoData) {
        // Verifica se já existe
        $sql = "SELECT COUNT(*) AS total FROM instituicao WHERE usuario = :usuario OR email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':usuario', $instituicaoData['usuario'], PDO::PARAM_STR);
        $stmt->bindParam(':email', $instituicaoData['email'], PDO::PARAM_STR);
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
            // Tabela endereco
            $enderecoSql = "INSERT INTO endereco (cep, cidade, estado, logradouro, bairro, num) VALUES (:cep, :cidade, :estado, :logradouro, :bairro, :num)";
            $stmtEndereco = $this->conn->prepare($enderecoSql);
            $stmtEndereco->bindParam(':cep', $instituicaoData['cep'], PDO::PARAM_STR);
            $stmtEndereco->bindParam(':cidade', $instituicaoData['cidade'], PDO::PARAM_STR);
            $stmtEndereco->bindParam(':estado', $instituicaoData['state'], PDO::PARAM_STR);
            $stmtEndereco->bindParam(':logradouro', $instituicaoData['logradouro'], PDO::PARAM_STR);
            $stmtEndereco->bindParam(':bairro', $instituicaoData['bairro'], PDO::PARAM_STR);
            $stmtEndereco->bindParam(':num', $instituicaoData['num'], PDO::PARAM_STR);
            $stmtEndereco->execute();

           // Gerar auth_factor aleatório
           $auth_factor = $this->gerarAuthFactorInstituicao();


            // Tabela instituicao
            $sql = "INSERT INTO instituicao (nome, nome_insti, email, data_fundacao, cnpj, telefone_celular, telefone_fixo, usuario, senha, cep, registro, auth_factor) VALUES (:nome, :nome_insti, :email, :data_fundacao, :cnpj, :telefone_celular, :telefone_fixo, :usuario, :senha, :cep, :registro, :auth_factor)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nome', $instituicaoData['nome'], PDO::PARAM_STR);
            $stmt->bindParam(':nome_insti', $instituicaoData['nome_insti'], PDO::PARAM_STR);
            $stmt->bindParam(':email', $instituicaoData['email'], PDO::PARAM_STR);
            $stmt->bindParam(':data_fundacao', $instituicaoData['data_fundacao'], PDO::PARAM_STR);
            $stmt->bindParam(':cnpj', $instituicaoData['cnpj'], PDO::PARAM_STR);
            $stmt->bindParam(':telefone_celular', $instituicaoData['telefone_celular'], PDO::PARAM_STR);
            $stmt->bindParam(':telefone_fixo', $instituicaoData['telefone_fixo'], PDO::PARAM_STR);
            $stmt->bindParam(':usuario', $instituicaoData['usuario'], PDO::PARAM_STR);
            $stmt->bindParam(':senha', $instituicaoData['senha'], PDO::PARAM_STR);
            $stmt->bindParam(':cep', $instituicaoData['cep']); 
            date_default_timezone_set('America/Sao_Paulo');
            $registro = date('Y-m-d H:i:s');
            $stmt->bindParam(':registro', $registro);
            $stmt->bindParam(':auth_factor', $auth_factor, PDO::PARAM_STR);
            $stmt->execute();

            // Commit da transação se tudo ocorrer bem
            $this->conn->commit();
            return true;
        } catch (PDOException $e) {
            // Reverter a transação em caso de erro
            $this->conn->rollBack();
            $_SESSION['error_message'] = "Erro ao cadastrar instituição: " . $e->getMessage();
            header('Location: ../views/error.php');
            return false;
        }
    }


   
    
// ----------------------OUTROS RELACIONADOS A LOGIN----------------------------


// function verificarEmail($email) {
//     global $pdo;

//     // Array com os tipos de usuário e suas respectivas tabelas
//     $tiposUsuario = [
//         'aluno' => 'aluno',
//         'instituicao' => 'instituicao',
//         'administracao' => 'administracao'
//     ];

//     // Percorre os tipos de usuário para encontrar o e-mail
//     foreach ($tiposUsuario as $tipo => $tabela) {
//         $stmt = $pdo->prepare("SELECT * FROM {$tabela} WHERE email = :email LIMIT 1");
//         $stmt->execute(['email' => $email]);
//         $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        
//         if ($usuario) {
//             // E-mail encontrado, retorna o tipo de usuário e os dados
//             return ['tipo' => $tipo, 'dados' => $usuario];
//         }
//     }

//     // Se não encontrou em nenhuma tabela, retorna false
//     return false;
// }

// // Função para alterar a senha do usuário
// function alterarSenha($email, $novaSenha, $tipoUsuario) {
//     global $pdo;

//     // Verifica qual tabela corresponde ao tipo de usuário
//     switch ($tipoUsuario) {
//         case 'aluno':
//             $tabela = 'aluno';
//             break;
//         case 'instituicao':
//             $tabela = 'instituicao';
//             break;
//         case 'administracao':
//             $tabela = 'administracao';
//             break;
//         default:
//             return false; // Tipo de usuário inválido
//     }

//     // Hash da nova senha
//     $hashedSenha = password_hash($novaSenha, PASSWORD_DEFAULT);

//     try {
//         // Atualiza a senha na tabela correspondente
//         $stmt = $pdo->prepare("UPDATE {$tabela} SET senha = :senha WHERE email = :email");
//         $stmt->execute(['senha' => $hashedSenha, 'email' => $email]);
//         return true;
//     } catch (PDOException $e) {
//         return false; // Erro ao atualizar a senha
//     }
// }





    // public function gerarCodigoRedefinicaoSenha($email) {
    //     try {
    //         $user_types = ['aluno', 'instituicao', 'administracao'];

    //         foreach ($user_types as $type) {
    //             $sql = "SELECT * FROM $type WHERE email = :email";
    //             $stmt = $this->conn->prepare($sql);
    //             $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    //             $stmt->execute();
    //             $result = $stmt->fetch(PDO::FETCH_ASSOC);

    //             if ($result) {
    //                 $resetCode = mt_rand(100000, 999999);
    //                 $expiryCode = date('Y-m-d H:i:s', strtotime('+1 hour'));

    //                 $sql_update = "UPDATE $type SET reset_code = :resetCode, reset_code_expiry = :expiryCode WHERE email = :email";
    //                 $stmt_update = $this->conn->prepare($sql_update);
    //                 $stmt_update->bindParam(':resetCode', $resetCode, PDO::PARAM_INT);
    //                 $stmt_update->bindParam(':expiryCode', $expiryCode, PDO::PARAM_STR);
    //                 $stmt_update->bindParam(':email', $email, PDO::PARAM_STR);
    //                 $stmt_update->execute();

    //                 if ($this->enviarEmailRedefinicaoSenha($email, $resetCode)) {
    //                     return true;
    //                 } else {
    //                     $_SESSION['error_message'] = 'Erro ao enviar e-mail.'; 
    //                     return false;
    //                 }
    //             }
    //         }

    //         $_SESSION['error_message'] = 'O e-mail fornecido não está registrado.';
    //         return false;
    //     } catch (PDOException $e) {
    //         error_log("Erro ao gerar código de redefinição de senha: " . $e->getMessage());
    //         $_SESSION['error_message'] = 'Erro ao gerar código de redefinição de senha.' . $e->getMessage();;
    //         return false;
    //     }
    // }

    // private function enviarEmailRedefinicaoSenha($email, $resetCode) {
    //     $to = $email;
    //     $subject = 'Redefinição de senha';
    //     $message = "Olá,\n\nPara redefinir sua senha, utilize o seguinte código:\n\n";
    //     $message .= $resetCode;
    //     $message .= "\n\nEste código expirará em 1 hora.";
    //     $headers = 'From: seuemail@seusite.com';

    //     return mail($to, $subject, $message, $headers);
    // }

    // public function verificarCodigoRedefinicaoSenha($email, $codigo) {
    //     $user_types = ['aluno', 'instituicao', 'administracao'];

    //     foreach ($user_types as $type) {
    //         $sql = "SELECT * FROM $type WHERE email = :email AND reset_pass_code = :codigo AND expiry_code > NOW()";
    //         $stmt = $this->conn->prepare($sql);
    //         $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    //         $stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);
    //         $stmt->execute();
    //         $result = $stmt->fetch(PDO::FETCH_ASSOC);

    //         if ($result) {
    //             return $type;
    //         }
    //     }

    //     $_SESSION['error_message'] = 'Código inválido ou expirado.';
    //     return false;
    // }

    // public function redefinirSenha($email, $novaSenha) {
    //     $user_types = ['aluno', 'instituicao', 'administracao'];

    //     foreach ($user_types as $type) {
    //         $sql = "UPDATE $type SET senha = :novaSenha WHERE email = :email";
    //         $stmt = $this->conn->prepare($sql);
    //         $novaSenhaHashed = password_hash($novaSenha, PASSWORD_DEFAULT);
    //         $stmt->bindParam(':novaSenha', $novaSenhaHashed, PDO::PARAM_STR);
    //         $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    //         $stmt->execute();

    //         if ($stmt->rowCount() > 0) {
    //             return true;
    //         }
    //     }

    //     $_SESSION['error_message'] = 'Erro ao redefinir a senha.';
    //     return false;
    // }

}

?>


