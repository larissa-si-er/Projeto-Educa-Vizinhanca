<?php
require_once '../../head.php';
include_once '../menuinterno.php';
require_once '../../models/conexao.php';

// Verifica se o usuário não está logado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redireciona para a página de login
    header('Location: ../views/auth/login.php');
    exit();
}

$idAlunoLogado = $_SESSION['user_data']['id_aluno'] ?? null;

// Verifica se $idAlunoLogado está definido antes de continuar
if (!$idAlunoLogado) {
    $_SESSION['error_message'] = 'ID do aluno não encontrado.';
    header('Location: algum_lugar.php'); // Redirecione para onde for apropriado
    exit();
}

// Consultar dados do aluno associado ao usuário logado
$sql = "SELECT * FROM aluno WHERE id_aluno = :id_aluno";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_aluno', $idAlunoLogado, PDO::PARAM_INT);
$stmt->execute();
$aluno = $stmt->fetch(PDO::FETCH_ASSOC);

// Verificar se $aluno foi encontrado antes de acessar seus dados
if (!$aluno) {
    $_SESSION['error_message'] = 'Dados do aluno não encontrados.';
    header('Location: algum_lugar.php'); // Redirecione para onde for apropriado
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Área do Aluno</title>
</head>
<body>
    <h1>Dados do Aluno</h1>
    <form id="formAluno" action="form_editar_aluno.php" method="post">
        <input type="hidden" id="id_aluno" name="id_aluno" value="<?php echo $aluno['id_aluno']; ?>">
        
        <label for="name">Nome:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($aluno['nome']); ?>"><br><br>
        
        <!-- Outros campos do formulário -->
        
        <button type="submit">Salvar</button>
    </form>
</body>
</html>
