<?php
require_once '../../models/conexao.php';

// Iniciar a sessão
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo json_encode(['success' => false, 'message' => 'Usuário não está logado']);
    exit();
}

// Obter o ID do aluno logado
$idAlunoLogado = $_SESSION['user_data']['id_aluno'] ?? null;

// Verificar se o ID do aluno está disponível
if (!$idAlunoLogado) {
    echo json_encode(['success' => false, 'message' => 'ID do aluno não encontrado']);
    exit();
}

// Obter os dados enviados pelo AJAX
$data = json_decode(file_get_contents('php://input'), true);

// Verificar se o ID do curso foi enviado
if (!isset($data['id_curso'])) {
    echo json_encode(['success' => false, 'message' => 'ID do curso não enviado']);
    exit();
}

$idCurso = $data['id_curso'];

// Preparar a consulta SQL para inserir o curso salvo
try {
    $sql = "INSERT INTO salvo (id_aluno, id_curso) VALUES (:id_aluno, :id_curso)";
    $stmt = $conn->prepare($sql);

    // Vincular os parâmetros e executar a consulta
    $stmt->bindParam(':id_aluno', $idAlunoLogado, PDO::PARAM_INT);
    $stmt->bindParam(':id_curso', $idCurso, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // Obter detalhes do curso salvo para retornar ao JavaScript
        $sqlCurso = "SELECT * FROM curso WHERE id_curso = :id_curso";
        $stmtCurso = $conn->prepare($sqlCurso);
        $stmtCurso->bindParam(':id_curso', $idCurso, PDO::PARAM_INT);
        $stmtCurso->execute();
        $curso = $stmtCurso->fetch(PDO::FETCH_ASSOC);

        echo json_encode(['success' => true, 'curso' => $curso]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao salvar curso']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Erro: ' . $e->getMessage()]);
}

// Fechar a conexão
$conn = null;
?>
