<?php
include_once('../models/conexao.php'); 
include_once('../models/users.php');

// session_start();


$database = new conexao();
$db = $database->getConnection();

$user = new User($db);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        // formulário de login foi enviado:
        // echo "<script>alert('Tentativa de LOGIN detectada');</script>";

        login($user);
        } elseif (isset($_POST['submit-auth'])){
            
            $resposta = htmlspecialchars($_POST['answer-auth']);
            $campo_correto = htmlspecialchars($_POST['campo-correto']);
            
            verificarAutenticacao($resposta, $campo_correto);

        } elseif (isset($_POST['cadastrarAluno'])) {
            $cadastro_sucesso = cadastrarAluno($user);
            if ($cadastro_sucesso) {
                // Cadastro com sucesso
                echo "<script>alert('Cadastro realizado com sucesso.');</script>";
            } else {
                // Erro ao cadastrar
                header('Location: ../views/error.php');
            }

        } elseif (isset($_POST['cadastrarInstituicao'])) {
            $cadastro_sucesso = cadastrarInstituicao($user);
            if ($cadastro_sucesso) {
                // Cadastro sucesso
                echo "<script>alert('Cadastro realizado com sucesso.');</script>";
            } else {
                // Erro ao cadastrar
                header('Location: ../views/error.php');
            }

            // } elseif (isset($_POST['esqueceuSenha'])) {
                
            //     gerarEnviarEmailRedefinicaoSenha($user);
            //     echo "<script>alert('Cadastro realizado com sucesso.');</script>";

            // } elseif (isset($_POST['redefinirSenha'])) {
            //     redefinirSenha($user);
            // } elseif (isset($_POST['verificarCodigo'])) {
            //     verificarCodigo($user);
            // } elseif (isset($_POST['redefinirSenha'])) {
            //     redefinirSenha($user);
            } 
            elseif (isset($_POST['logout'])) {
            logout();
        }
        

} 
else 
{
    // Se não for POST
    echo "<script>alert('Tentativa de cadastro detectada');</script>";

    header('Location: ../views/error.php');

    exit();
}


function login($user) {
    // session_start(); // Inicia a sessão

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit']) && !empty($_POST['user']) && !empty($_POST['password'])) {
        $username = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $result = $user->login($username);

        if ($result) {

            if (password_verify($password, $result['dados']['senha'])) {
                // Autenticação bem-sucedida
                $_SESSION['loggedin'] = true;
                $_SESSION['user_type'] = $result['tipo'];
                $_SESSION['user_data'] = $result['dados'];


                // Obtém o primeiro nome do usuário
                $primeiroNome = getFirstName($result['dados']['nome']);

                // Obtém o primeiro nome do usuário
                $primeiroNome = getFirstName($result['dados']['nome']);
                $_SESSION['first_name'] = $primeiroNome;



                // echo "Bem-vindo, " . $result['dados']['nome'] . ", " . $result['tipo'] . "!";

                // header('Location: ../views/feed.php');
                header('Location: ../views/auth/auth.php');
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

function logout() {
    // session_start(); // Inicia a sessão se ainda não estiver iniciada

    // Remove todas as variáveis de sessão
    $_SESSION = array();

    // Se necessário, destrói a sessão
    if (session_status() === PHP_SESSION_ACTIVE) {
        session_destroy();
    }

    header('Location: ../views/auth/login.php');
    exit();
}

function verificarAutenticacao($resposta, $campo_correto) {
    if (!isset($_SESSION['user_data'])) {
        header("Location: ../views/auth/auth.php");
        exit;
    }

    // Inicializa tentativas de autenticação 
    if (!isset($_SESSION['auth_attempts'])) {
        $_SESSION['auth_attempts'] = 0;
    }


    $authFactor = $_SESSION['user_data']['auth_factor'];
    $isValid = false;

    switch ($authFactor) {
        case 'cep':
            if ($resposta === $_SESSION['user_data']['cep']) {
                $isValid = true;
            }
            break;
        case 'data_nasc':
            $dataFormatada = DateTime::createFromFormat('d/m/Y', $resposta) ?: DateTime::createFromFormat('d-m-Y', $resposta);
            if ($dataFormatada && $dataFormatada->format('Y-m-d') === $_SESSION['user_data']['data_nasc']) {
                $isValid = true;
            }
            break;
        case 'nome_materno':
            if (strcasecmp($resposta, $_SESSION['user_data']['nome_materno']) === 0) {
                $isValid = true;
            }
            break;
    }

    if ($isValid) {
        header("Location: ../views/feed.php");
        exit;
    } else {
        // tentativas de autenticação /3 [inicio]
        $_SESSION['auth_attempts'] += 1;

        if ($_SESSION['auth_attempts'] >= 3) {

            $_SESSION['auth_attempts_exceeded'] = "Você errou a autenticação 3 vezes. Por favor, faça login novamente.";
            session_unset();
            session_destroy();
            header("Location: ../views/auth/auth.php");
            exit;
        } else {
            $_SESSION['auth_error'] = "Resposta incorreta. Tentativa " . $_SESSION['auth_attempts'] . " de 3.";
            header("Location: ../views/auth/auth.php");
            exit;
        }
    }
}


function getFirstName($fullName) {
    $parts = explode(' ', $fullName);
    return $parts[0]; 
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
        'telefone_celular', 'telefone_fixo', 'cep', 'cidade', 'state',
        'logradouro', 'bairro', 'num', 'usuario', 'senha'
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


// testes







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
//         header('Location: ../views/auth/forgot_password.php');
//         exit();
//     }
// }

// function verificarCodigo($user) {
//     $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
//     $codigo = filter_input(INPUT_POST, 'codigo', FILTER_SANITIZE_NUMBER_INT);

//     if ($user->verificarCodigoRedefinicaoSenha($email, $codigo)) {
//         $_SESSION['email_validado'] = $email;
//         header('Location: ../views/auth/redefinir_senha.php');
//         exit();
//     } else {
//         header('Location: ../views/auth/verificar_codigo.php');
//         exit();
//     }
// }

// function redefinirSenha($user) {
//     $email = $_SESSION['email_validado'] ?? null;
//     $novaSenha = filter_input(INPUT_POST, 'nova_senha', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

//     if ($email && $novaSenha) {
//         if ($user->redefinirSenha($email, $novaSenha)) {
//             $_SESSION['success_message'] = 'Senha redefinida com sucesso!';
//             header('Location: ../views/auth/login.php');
//             exit();
//         } else {
//             header('Location: ../views/auth/redefinir_senha.php');
//             exit();
//         }
//     } else {
//         $_SESSION['error_message'] = 'Por favor, preencha todos os campos.';
//         header('Location: ../views/auth/redefinir_senha.php');
//         exit();
//     }
// }

// $conexao = new Conexao();
// $pdo = $conexao->getConnection();

?>
