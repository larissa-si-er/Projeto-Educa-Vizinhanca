<?php
include '../models/conexao.php';

// Verifique se há uma consulta de pesquisa
$searchQuery = $_GET['search'] ?? '';

// Modifique a consulta SQL para incluir a pesquisa em vários campos
$sql = "SELECT id_curso, nome_curso, descricao, areacurso, tipocurso, formato, quantidadevagas, duracao, turno, localidade, linksite, inicioinscricoes, terminoinscricoes, fotocurso, instituicao, id_instituicao, data_time 
        FROM curso";

if ($searchQuery) {
    $sql .= " WHERE nome_curso LIKE :search 
              OR descricao LIKE :search 
              OR areacurso LIKE :search 
              OR tipocurso LIKE :search 
              OR formato LIKE :search 
              OR localidade LIKE :search 
              OR instituicao LIKE :search";
}

$sql .= " ORDER BY data_time DESC";

$stmt = $conn->prepare($sql);

if ($searchQuery) {
    $searchTerm = '%' . $searchQuery . '%';
    $stmt->bindParam(':search', $searchTerm);
}

$stmt->execute();
$cursos = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Verificação para garantir que os cursos foram buscados corretamente
if ($cursos === false) {
    $cursos = [];
}

// Verifica se o formulário foi submetido para inserção de um novo curso
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    $instituicao = $_POST['instituicao'];
    $id_instituicao = $_POST['id_instituicao']; 


    // upload da imagem
    $foto = $_FILES['fotocurso'];

    if ($foto['error'] === UPLOAD_ERR_OK) {
        $nomeArquivo = $foto['name'];
        $caminhoTemp = $foto['tmp_name'];

        // Diretório a imagem
        $diretorioSalvar = '/../views/fotos-banco/';

        // Move para o diretório desejado
        if (move_uploaded_file($caminhoTemp, __DIR__ . $diretorioSalvar . $nomeArquivo)) {
        // Prepara a instrução SQL para inserção
        $sql = "INSERT INTO curso (nome_curso, descricao, areacurso, tipocurso, formato, quantidadevagas, duracao, turno, localidade, linksite, inicioinscricoes, terminoinscricoes, fotocurso, instituicao,  id_instituicao,  data_time) 
        VALUES (:titulo, :descricao, :area, :tipocurso, :formato, :vagas, :duracao, :turno, :localidade, :link, :inicio, :termino, :nomeArquivo, :instituicao, :id_instituicao, NOW())";
        $stmt = $conn->prepare($sql);

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
            $stmt->bindParam(':nomeArquivo', $nomeArquivo);
            $stmt->bindParam(':instituicao', $instituicao);
            $stmt->bindParam(':id_instituicao', $id_instituicao);

            if ($stmt->execute()) {
                session_start();
                $_SESSION['success_message'] = 'Curso inserido com sucesso.';
            } else {
                session_start();
                $_SESSION['error_message'] = "Erro ao inserir o curso.";
            }
        } else {
            session_start();
            $_SESSION['error_message'] = "Erro ao fazer o upload da imagem.";
        }
    } else {
        session_start();
        $_SESSION['error_message'] = "Erro ao enviar o arquivo.";
    }

    header("Location: ../views/admin/areaadm.php");
    exit(); 
}
?>
