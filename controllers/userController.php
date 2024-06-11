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

    } elseif (isset($_POST['cadastrar'])) {
        // Verifica se o formulário de cadastro foi enviado
        $cadastro_sucesso = cadastrarAluno($user);
        if ($cadastro_sucesso) {
            // Cadastro realizado com sucesso
            echo "<script>alert('Cadastro realizado com sucesso.');</script>";
        } else {
            // Erro ao cadastrar
            echo "<script>alert('ERROR');</script>";
            header('Location: ../views/error.php');
        }
    }
} 
else 
{
    // Se o método de solicitação não for POST
    echo "<script>alert('Tentativa de cadastro detectada');</script>";
    echo "Tentativa de cadastro detectada";

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
                // header('Location: ../views/dash.php');
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
?>
