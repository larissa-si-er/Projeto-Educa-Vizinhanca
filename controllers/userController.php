<?php
include_once('../models/conexao.php'); 
include_once('../models/users.php');

// Verifica se o usuário está logado
// User::verificaLogin();

$database = new conexao();
$db = $database->getConnection();

$user = new User($db);

// verificaLogin();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        // Verifica se o formulário de login foi enviado
        echo "<script>alert('Tentativa de LOGIN detectada');</script>";

        login($user);
        // verificaLogin(); 

    // } elseif (isset($_POST['cadastrar'])) {
    //     // Verifica se o formulário de cadastro foi enviado
    //     $cadastro_sucesso = cadastrarAluno($user);
    //     if ($cadastro_sucesso) {
    //         // Cadastro realizado com sucesso
    //         echo "<script>alert('Cadastro realizado com sucesso.');</script>";
    //     } else {
    //         // Erro ao cadastrar
    //         header('Location: ../views/error.php');
    //     }
    // }
        } elseif (isset($_POST['cadastrarAluno'])) {
            // Verifica se o formulário de cadastro de aluno foi enviado
            $cadastro_sucesso = cadastrarAluno($user);
            if ($cadastro_sucesso) {
                // Cadastro realizado com sucesso
                echo "<script>alert('Cadastro realizado com sucesso.');</script>";
            } else {
                // Erro ao cadastrar
                header('Location: ../views/error.php');
            }

        } elseif (isset($_POST['cadastrarInstituicao'])) {
            // Verifica se o formulário de cadastro de instituição foi enviado
            $cadastro_sucesso = cadastrarInstituicao($user);
            if ($cadastro_sucesso) {
                // Cadastro realizado com sucesso
                echo "<script>alert('Cadastro realizado com sucesso.');</script>";
            } else {
                // Erro ao cadastrar
                header('Location: ../views/error.php');
            }

            } elseif (isset($_POST['esqueceuSenha'])) {
                // Verifica se o formulário de "Esqueceu sua senha?" foi enviado
                
                gerarEnviarEmailRedefinicaoSenha($user);
                echo "<script>alert('Cadastro realizado com sucesso.');</script>";

            } elseif (isset($_POST['redefinirSenha'])) {
                // Verifica se o formulário de redefinição de senha foi enviado
                redefinirSenha($user);
            } elseif (isset($_POST['verificarCodigo'])) {
                verificarCodigo($user);
            } elseif (isset($_POST['redefinirSenha'])) {
                redefinirSenha($user);
            }
        

} 
else 
{
    // Se o método de solicitação não for POST
    echo "<script>alert('Tentativa de cadastro detectada');</script>";

    header('Location: ../views/error.php');
    // header('Location: ../views/auth/cadastro.php');


    exit();
}

function login($user) {
    session_start();

    if (isset($_SESSION['usuario']) && isset($_SESSION['senha'])) {
        echo "Sessao: " . $_SESSION['usuario'] . "<br>" . "Sessao: " . $_SESSION['senha'];
    } else {
        echo "Variáveis de sessão não estão definidas.";
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit']) && !empty($_POST['user']) && !empty($_POST['password'])) {
        $username = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $result = $user->login($username, $password);

        if ($result) {
            // Verifica se a senha fornecida corresponde à senha criptografada no banco de dados
            echo "Senha fornecida: " . $password . "<br>";
            echo "Senha hash no banco de dados: " . $result['dados']['senha'] . "<br>";


            if (password_verify($password, $result['dados']['senha'])) {
                // Autenticação bem-sucedida
                echo "Bem-vindo, " . $result['dados']['nome'] . ", " . $result['tipo'] ."!";
                // Redirecionar para o painel apropriado com base no tipo de usuário
                // header('Location: ../views/' . $result['tipo'] . '/dashboard.php');
                // exit();

                header('Location: ../views/dash.php');

                // armazena o usuário na sessão
                $_SESSION['usuario'] = $username;
                $_SESSION['senha'] = $password;

                header('Location: ../views/auth/auth.php');
                // header('Location: ../views/feed.php');
                exit();

            } else {
                // Senha incorreta
                $_SESSION['login_error'] = 'Credenciais inválidas. Tente novamente.';
                header('Location: ../views/auth/login.php');
                exit();
            }
        } else {
            // Usuário não encontrado
            $_SESSION['login_error'] = 'Usuário não encontrado.';
            header('Location: ../views/auth/login.php');
            exit();
        }
    } else {
        // Se o método de solicitação não for POST ou se os campos estiverem vazios
        $_SESSION['login_error'] = 'Erro ao logar. Por favor, preencha todos os campos.';
        header('Location: ../views/auth/login.php');
        exit();
    }
}

function cadastrarAluno($user) {
    include_once('../models/conexao.php'); 
    include_once('../models/users.php');

    $database = new conexao();
    $db = $database->getConnection();

    $user = new User($db);

    // Lista de campos obrigatórios
    $requiredFields = [
        'nome', 'nomeM', 'email', 'cpf', 'nasc', 'genero',
        'cel', 'tel', 'cep', 'cidade', 'state',
        'logradouro', 'bairro', 'num', 'usuario', 'senha'  ];

    // Array para armazenar os dados do aluno
    $alunoData = [];

    // Verifica se todos os campos obrigatórios foram recebidos
    foreach ($requiredFields as $field) {
        if (!isset($_POST[$field])) {
            // Campos obrigatórios não foram recebidos
            var_dump($_POST);
            error_log("Campo obrigatório '$field' não recebido.");
            echo json_encode(['message' => 'Por favor, preencha todos os campos obrigatórios.']);
            return;
        }
        // Sanitiza os dados contra caracteres especiais
        $alunoData[$field] = htmlspecialchars($_POST[$field]);
    }


    // Criptografa a senha antes de armazenar
    $alunoData['senha'] = password_hash($alunoData['senha'], PASSWORD_DEFAULT);

    session_start();
    // cadastrar o aluno
    if ($user->cadastrarAluno($alunoData)) {
        // Cadastro realizado com sucesso
        echo json_encode(['message' => 'Cadastro realizado com sucesso.']);

        $_SESSION['login_sucess'] = 'Cadastrado com sucesso.';
        header('Location: ../views/auth/login.php');
        exit();

    } else {
        // Erro ao cadastrar
        echo json_encode(['message' => 'Erro ao cadastrar aluno.']);
        // $_SESSION['error_message'] = 'A conta já existe.';
        // header('Location: ../views/auth/cadastro.php');
        // exit();


    }
}

function cadastrarInstituicao($user) {
    $requiredFields = [
        'nome', 'nome_insti', 'email', 'data_fundacao', 'cnpj',
        'telefone_celular', 'telefone_fixo', 'cep', 'usuario', 'senha'
    ];

    // armazenar os dados da instituição
    $instituicaoData = [];

    // Verifica se todos os campos obrigatórios foram recebidos
    foreach ($requiredFields as $field) {
        if (!isset($_POST[$field])) {
            // Campos obrigatórios não foram recebidos
            error_log("Campo obrigatório '$field' não recebido.");
            echo json_encode(['message' => 'Por favor, preencha todos os campos obrigatórios.']);
            return false;
        }
        // Sanitiza os dados contra caracteres especiais
        $instituicaoData[$field] = htmlspecialchars($_POST[$field]);
    }

    // Criptografa a senha antes de armazenar
    $instituicaoData['senha'] = password_hash($instituicaoData['senha'], PASSWORD_DEFAULT);

    session_start();
    // Cadastrar a instituição
    if ($user->cadastrarInstituicao($instituicaoData)) {
        // Cadastro realizado com sucesso
        echo json_encode(['message' => 'Cadastro realizado com sucesso.']);

        $_SESSION['login_sucess'] = 'Cadastrado com sucesso.';
        header('Location: ../views/auth/login.php');
        exit();
    } else {
        // Erro ao cadastrar
        echo json_encode(['message' => 'Erro ao cadastrar instituição.']);
    }

}



function gerarEnviarEmailRedefinicaoSenha($user) {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

    if (empty($email)) {
        $_SESSION['error_message'] = 'Por favor, forneça um e-mail válido.';
        header('Location: ../views/auth/forgot_password.php');
        exit();
    }

    if ($user->gerarCodigoRedefinicaoSenha($email)) {
        $_SESSION['success_message'] = 'Um e-mail com instruções para redefinir sua senha foi enviado.';
        header('Location: ../views/auth/forgot_password.php');
        exit();
    } else {
        header('Location: ../views/auth/forgot_password.php');
        exit();
    }
}

function verificarCodigo($user) {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $codigo = filter_input(INPUT_POST, 'codigo', FILTER_SANITIZE_NUMBER_INT);

    if ($user->verificarCodigoRedefinicaoSenha($email, $codigo)) {
        $_SESSION['email_validado'] = $email;
        header('Location: ../views/auth/redefinir_senha.php');
        exit();
    } else {
        header('Location: ../views/auth/verificar_codigo.php');
        exit();
    }
}

function redefinirSenha($user) {
    $email = $_SESSION['email_validado'] ?? null;
    $novaSenha = filter_input(INPUT_POST, 'nova_senha', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if ($email && $novaSenha) {
        if ($user->redefinirSenha($email, $novaSenha)) {
            $_SESSION['success_message'] = 'Senha redefinida com sucesso!';
            header('Location: ../views/auth/login.php');
            exit();
        } else {
            header('Location: ../views/auth/redefinir_senha.php');
            exit();
        }
    } else {
        $_SESSION['error_message'] = 'Por favor, preencha todos os campos.';
        header('Location: ../views/auth/redefinir_senha.php');
        exit();
    }
}









// function gerarEnviarEmailRedefinicaoSenha($user) {
//     $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

//     if (empty($email)) {
//         $_SESSION['error_message'] = 'Por favor, forneça um e-mail válido.';
//         header('Location: ../views/auth/forgot_password.php');
//         exit();
//     }

//     if ($user->gerarCodigoRedefinicaoSenha($email)) {
//         $_SESSION['success_message'] = 'Um e-mail com instruções para redefinir sua senha foi enviado.';
//         header('Location: ../views/auth/forgot_password.php');
//         exit();
//     } else {
//         $_SESSION['error_message'] = 'Erro ao gerar código de redefinição de senha ou e-mail não encontrado.';
//         header('Location: ../views/auth/forgot_password.php');
//         exit();
//     }
// }
// function gerarEnviarEmailRedefinicaoSenha($user) {
//     echo '<script>alert("Função gerarEnviarEmailRedefinicaoSenha foi acessada!");</script>';

//     // Verifica se o e-mail foi enviado
//     if (!isset($_POST['email'])) {
//         $_SESSION['error_message'] = 'Por favor, insira seu endereço de e-mail.';
//         header('Location: ../views/auth/envia-email.php');
//         exit();
//     }

//     // Obtém o endereço de e-mail do formulário
//     $email = $_POST['email'];

//     $result = $user->gerarCodigoRedefinicaoSenha($email);

//     if ($result) {
//         echo '<script>alert("Função gerarEnviarEmailRedefinicaoSenha foi acessada!");</script>';
//         $_SESSION['success_message'] = 'Um e-mail com instruções para redefinir sua senha foi enviado para o seu endereço de e-mail.';
//         header('Location: ../views/auth/envia-email.php');
//         exit();
//     } else {
//         $_SESSION['error_message'] = 'Ocorreu um erro ao enviar o e-mail de redefinição de senha. Por favor, tente novamente mais tarde.';
//         header('Location: ../views/auth/envia-email.php');
//         exit();
//     }
// }

// // function redefinirSenha($user) {
// //     // Verifica se os campos foram recebidos
// //     if (!isset($_POST['reset_code']) || !isset($_POST['nova_senha']) || !isset($_POST['cod'])) {
// //         $_SESSION['error_message'] = 'Por favor, insira o código de redefinição, a nova senha e o código recebido por e-mail.';
// //         header('Location: ../views/auth/esqueceu-senha.php');
// //         exit();
// //     }

// //     // Obtém os dados do formulário
// //     $resetCode = $_POST['reset_code'];
// //     $novaSenha = $_POST['nova_senha'];
// //     $codigoInserido = $_POST['cod'];

// //     // Verifica se o código inserido pelo usuário corresponde ao código enviado por e-mail
// //     $result = $user->verificarCodigoRedefinicaoSenha($resetCode, $codigoInserido);

// //     if (!$result) {
// //         $_SESSION['error_message'] = 'O código inserido não corresponde ao código enviado por e-mail.';
// //         header('Location: ../views/auth/redefinir_senha.php');
// //         exit();
// //     }

// //     // Redefinir a senha usando o código de redefinição
// //     $result = $user->redefinirSenhaComCodigo($resetCode, $novaSenha);

// //     if ($result) {
// //         $_SESSION['success_message'] = 'Sua senha foi redefinida com sucesso.';
// //         header('Location: ../views/auth/login.php');
// //         exit();
// //     } else {
// //         $_SESSION['error_message'] = 'Ocorreu um erro ao redefinir sua senha. Certifique-se de que o código de redefinição é válido e não expirou.';
// //         header('Location: ../views/auth/redefinir-senha.php');
// //         exit();
// //     }
// }

?>
