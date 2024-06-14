<?php
    include '../models/conexao.php';
    // require '../controllers/userController.php'; 


// Seleciona os cursos do banco de dados
$sql = "SELECT nome_curso, descricao, areacurso, tipocurso, formato, quantidadevagas, duracao, turno, localidade, linksite, inicioinscricoes, terminoinscricoes, fotocurso FROM curso";
$stmt = $conn->prepare($sql);
$stmt->execute();
$cursos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Verificação para garantir que os cursos foram buscados corretamente
if ($cursos === false) {
    $cursos = [];
}

// Verifica se o formulário foi submetido para inserção de um novo curso
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recupera os dados do formulário
    $titulo = $_POST['nome_curso'];
    $descricao = $_POST['descricao'];
    $area = $_POST['areacurso'];
    $tipocurso = $_POST['tipocurso'];
    $formato = $_POST['formato'];
    $vagas = $_POST['quantidadevagas'];
    $duracao = $_POST['duracao'];
    $turno = $_POST['turno'];
    $localidade = $_POST['localidade'];
    $link = $_POST['linksite'];
    $inicio = $_POST['inicioinscricoes'];
    $termino = $_POST['terminoinscricoes'];
    $foto = $_POST['fotocurso'];

    try {
        // Prepara a instrução SQL para inserção
        $sql = "INSERT INTO curso (id_curso, nome_curso, descricao, areacurso, tipocurso, formato, quantidadevagas, duracao, turno, localidade, linksite, inicioinscricoes, terminoinscricoes, fotocurso) 
                VALUES (DEFAULT, :titulo, :descricao, :area, :tipocurso, :formato, :vagas, :duracao, :turno, :localidade, :link, :inicio, :termino, :foto)";
        $stmt = $conn->prepare($sql);

        // Bind dos parâmetros
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':area', $area);
        $stmt->bindParam(':tipocurso', $tipocurso);
        $stmt->bindParam(':formato', $formato);
        $stmt->bindParam(':vagas', $vagas);
        $stmt->bindParam(':duracao', $duracao);
        $stmt->bindParam(':turno', $turno);
        $stmt->bindParam(':localidade', $localidade);
        $stmt->bindParam(':link', $link);
        $stmt->bindParam(':inicio', $inicio);
        $stmt->bindParam(':termino', $termino);
        $stmt->bindParam(':foto', $foto);

        // Executa a instrução
        $stmt->execute();

        // Define a mensagem de feedback na sessão
        session_start();
        $_SESSION['error_message'] = 'Curso inserido com sucesso.';
        
        // Redireciona para a página de administração
        header("Location: ../views/admin/areaadm.php");
        exit(); // Certifique-se de sair após o redirecionamento
    } catch (PDOException $e) {
        // Em caso de erro, definir a mensagem de erro na sessão
        session_start();
        $_SESSION['error_message'] = "Erro ao inserir o curso: " . $e->getMessage();
        
        // Redireciona para a página de administração
        header("Location: ../views/admin/areaadm.php");
        exit(); // Certifique-se de sair após o redirecionamento
    }
}

?>
