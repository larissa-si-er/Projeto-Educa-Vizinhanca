<?php
include_once('../models/conexao.php'); 
include_once('../models/users.php');

// session_start();

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
        } elseif (isset($_POST['submit-auth'])){
            
            $resposta = htmlspecialchars($_POST['answer-auth']);
            $campo_correto = htmlspecialchars($_POST['campo-correto']);
            
            // Chamada da função para processar a autenticação de dois fatores
            verificarAutenticacao($resposta, $campo_correto);

            

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
            elseif (isset($_POST['logout'])) {
            // Função de logout
            logout();
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

// } else {
//     // Gera a pergunta de autenticação quando a página é carregada
//     list($pergunta, $campo_correto) = gerarPerguntaAutenticacao($db);
//     $_SESSION['pergunta'] = $pergunta;
//     $_SESSION['campo_correto'] = $campo_correto;
//     header("Location: auth.php");
//     exit();
// }




function login($user) {
    // session_start(); // Inicia a sessão

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit']) && !empty($_POST['user']) && !empty($_POST['password'])) {
        $username = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $result = $user->login($username);

        if ($result) {
            // Verifica se a senha fornecida corresponde à senha criptografada no banco de dados
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

    // Redireciona para a página de login após o logout
    header('Location: ../views/auth/login.php');
    exit();
}

// Função para obter o auth_factor e gerar a pergunta de autenticação
// function gerarPerguntaAutenticacao($db) {
//     if (!isset($_SESSION['usuario'])) {
//         // Usuário não está logado, redirecionar para página de login
//         $_SESSION['auth_error'] = "Usuário não está logado.";
//         header("Location: login.php");
//         exit();
//     }

//     $usuario = $_SESSION['usuario']; // Supondo que você tenha armazenado o usuário na sessão

//     // Busca o auth_factor do usuário no banco de dados
//     $sql = "SELECT auth_factor FROM aluno WHERE usuario = ?";
//     $stmt = $db->prepare($sql);
//     $stmt->bind_param("s", $usuario);
//     $stmt->execute();
//     $result = $stmt->get_result();

//     if ($result->num_rows === 1) {
//         $row = $result->fetch_assoc();
//         $auth_factor = $row['auth_factor'];
//     } else {
//         // Usuário não encontrado ou múltiplos usuários encontrados (situação inválida)
//         $_SESSION['auth_error'] = "Erro ao carregar fator de autenticação.";
//         header("Location: auth.php");
//         exit();
//     }

//     $stmt->close();

//     if (!isset($auth_factor)) {
//         // Auth_factor não foi encontrado no banco de dados
//         $_SESSION['auth_error'] = "Erro ao carregar fator de autenticação.";
//         header("Location: auth.php");
//         exit();
//     }

//     if (isset($_SESSION['user_data']['auth_factor'])) {
//         $auth_factor = $_SESSION['user_data']['auth_factor'];

//         // Determina a pergunta com base no auth_factor
//         switch ($auth_factor) {
//             case 'cep':
//                 $_SESSION['pergunta'] = "Qual é o seu CEP?";
//                 $_SESSION['campo_correto'] = 'cep';
//                 break;
//             case 'data_nasc':
//                 $_SESSION['pergunta'] = "Qual é a sua data de nascimento?";
//                 $_SESSION['campo_correto'] = 'data_nasc';
//                 break;
//             case 'nome_materno':
//                 $_SESSION['pergunta'] = "Qual é o nome de solteira da sua mãe?";
//                 $_SESSION['campo_correto'] = 'nome_materno';
//                 break;
//             default:
//                 $_SESSION['auth_error'] = "Fator de autenticação desconhecido.";
//                 header("Location: ../views/auth/login.php");
//                 exit();
//                 break;
//     }

//     // return [$pergunta, $campo_correto];
// }
// }

// // Função para autenticação de dois fatores
// function verificarAutenticacao($db, $resposta, $campo_correto) {
//     if (!isset($_SESSION['usuario'])) {
//         // Usuário não está logado, redirecionar para página de login
//         $_SESSION['auth_error'] = "Usuário não está logado.";
//         echo "Usuário não está logado.";

//         // header("Location: ../views/auth/login.php");
//         exit();
//     }

//     $usuario = $_SESSION['usuario']; // Supondo que você tenha armazenado o usuário na sessão

//     // Verifica se a resposta do usuário corresponde ao campo correto
//     $sql_verificacao = "SELECT $campo_correto FROM aluno WHERE usuario = ? AND $campo_correto = ?";
//     $stmt_verificacao = $db->prepare($sql_verificacao);
//     $stmt_verificacao->bind_param("ss", $usuario, $resposta);
//     $stmt_verificacao->execute();
//     $stmt_verificacao->store_result();

//     if ($stmt_verificacao->num_rows > 0) {
//         // Resposta correta, pode redirecionar para alguma página de sucesso
//         $_SESSION['auth_success'] = true;
//         header("Location: sucesso.php");
//         exit();
//     } else {
//         // Resposta incorreta, incrementa o contador de tentativas na sessão
//         if (!isset($_SESSION['tentativas'])) {
//             $_SESSION['tentativas'] = 1;
//         } else {
//             $_SESSION['tentativas']++;
//         }

//         // Verifica se excedeu o número máximo de tentativas
//         if ($_SESSION['tentativas'] >= 3) {
//             // Exibe mensagem de erro e redireciona para o login
//             $_SESSION['auth_error'] = "3 tentativas sem sucesso! Favor realizar Login novamente.";
//             header("Location: login.php");
//             exit();
//         } else {
//             // Ainda há tentativas restantes, redireciona de volta para o formulário de autenticação
//             $_SESSION['auth_error'] = "Resposta incorreta. Tente novamente.";
//             header("Location: auth.php");
//             exit();
//         }
//     }
// }
function verificarAutenticacao($resposta, $campo_correto) {
    if (!isset($_SESSION['user_data'])) {
        header("Location: ../views/auth/auth.php");
        exit;
    }

    // Inicializar tentativas de autenticação se não estiverem definidas
    if (!isset($_SESSION['auth_attempts'])) {
        $_SESSION['auth_attempts'] = 0;
    }


    $authFactor = $_SESSION['user_data']['auth_factor'];
    $isValid = false;

    // Validar a resposta com base no auth factor
    switch ($authFactor) {
        case 'cep':
            if ($resposta === $_SESSION['user_data']['cep']) {
                $isValid = true;
            }
            break;
        case 'data_nasc':
            // Converter a data do formato d-m-Y ou d/m/Y para Y-m-d
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
        // Autenticação adicional bem-sucedida, redirecionar para feed.php
        header("Location: ../views/feed.php");
        exit;
    } else {
        // Incrementar tentativas de autenticação
        $_SESSION['auth_attempts'] += 1;

        if ($_SESSION['auth_attempts'] >= 3) {
            // Autenticação falhou 3 vezes, encerrar sessão e redirecionar para login com mensagem de erro

            $_SESSION['auth_attempts_exceeded'] = "Você errou a autenticação 3 vezes. Por favor, faça login novamente.";
            session_unset();
            session_destroy();
            header("Location: ../views/auth/auth.php");
            exit;
        } else {
            // Autenticação adicional falhou, redirecionar de volta para auth.php com mensagem de erro
            $_SESSION['auth_error'] = "Resposta incorreta. Tentativa " . $_SESSION['auth_attempts'] . " de 3.";
            header("Location: ../views/auth/auth.php");
            exit;
        }
    }
}





// function processarAutenticacao($db, $usuario) {
//     // Verifica se o usuário está logado
//     if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
//         // Redireciona para a página de login
//         $_SESSION['auth_error'] = "Você precisa estar logado para acessar esta página.";
//         header('Location: ../views/auth/login.php');
//         exit();
//     }

//     // Busca o auth_factor do usuário no banco de dados
//     $sql = "SELECT auth_factor FROM aluno WHERE usuario = ?";
//     $stmt = $db->prepare($sql);
//     $stmt->bind_param("s", $usuario);
//     $stmt->execute();
//     $result = $stmt->get_result();

//     if ($result->num_rows === 1) {
//         $row = $result->fetch_assoc();
//         $auth_factor = $row['auth_factor'];

//         // Determina a pergunta com base no auth_factor
//         switch ($auth_factor) {
//             case 'cep':
//                 $_SESSION['pergunta'] = "Qual é o seu CEP?";
//                 $_SESSION['campo_correto'] = 'cep';
//                 break;
//             case 'data_nasc':
//                 $_SESSION['pergunta'] = "Qual é a sua data de nascimento?";
//                 $_SESSION['campo_correto'] = 'data_nasc';
//                 break;
//             case 'nome_materno':
//                 $_SESSION['pergunta'] = "Qual é o nome de solteira da sua mãe?";
//                 $_SESSION['campo_correto'] = 'nome_materno';
//                 break;
//             default:
//                 $_SESSION['auth_error'] = "Fator de autenticação desconhecido.";
//                 header("Location: ../views/auth/login.php");
//                 exit();
//                 break;
//         }
//     } else {
//         $_SESSION['auth_error'] = "Erro ao carregar fator de autenticação.";
//         header("Location: ../views/auth/login.php");
//         exit();
//     }

//     $stmt->close();
// }








function getFirstName($fullName) {
    $parts = explode(' ', $fullName);
    return $parts[0]; // Retorna o primeiro nome
}



// function login($user) {
//     session_start();

//     if (isset($_SESSION['usuario']) && isset($_SESSION['senha'])) {
//         echo "Sessao: " . $_SESSION['usuario'] . "<br>" . "Sessao: " . $_SESSION['senha'];
//     } else {
//         echo "Variáveis de sessão não estão definidas.";
//     }

//     if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit']) && !empty($_POST['user']) && !empty($_POST['password'])) {
//         $username = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
//         $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

//         $result = $user->login($username, $password);

//         if ($result) {
//             // Verifica se a senha fornecida corresponde à senha criptografada no banco de dados
//             echo "Senha fornecida: " . $password . "<br>";
//             echo "Senha hash no banco de dados: " . $result['dados']['senha'] . "<br>";


//             if (password_verify($password, $result['dados']['senha'])) {
//                 // Autenticação bem-sucedida
//                 echo "Bem-vindo, " . $result['dados']['nome'] . ", " . $result['tipo'] ."!";
//                 // Redirecionar para o painel apropriado com base no tipo de usuário
//                 // header('Location: ../views/' . $result['tipo'] . '/dashboard.php');
//                 // exit();

//                 header('Location: ../views/dash.php');

//                 // armazena o usuário na sessão
//                 $_SESSION['usuario'] = $username;
//                 $_SESSION['senha'] = $password;

//                 header('Location: ../views/auth/auth.php');
//                 // header('Location: ../views/feed.php');
//                 exit();

//             } else {
//                 // Senha incorreta
//                 $_SESSION['login_error'] = 'Credenciais inválidas. Tente novamente.';
//                 header('Location: ../views/auth/login.php');
//                 exit();
//             }
//         } else {
//             // Usuário não encontrado
//             $_SESSION['login_error'] = 'Usuário não encontrado.';
//             header('Location: ../views/auth/login.php');
//             exit();
//         }
//     } else {
//         // Se o método de solicitação não for POST ou se os campos estiverem vazios
//         $_SESSION['login_error'] = 'Erro ao logar. Por favor, preencha todos os campos.';
//         header('Location: ../views/auth/login.php');
//         exit();
//     }
// }

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