<?php
include '../models/conexao.php';

// Seleciona os cursos do banco de dados
$sql = "SELECT nome_curso, descricao, areacurso, tipocurso, formato, quantidadevagas, duracao, turno, localidade, linksite, inicioinscricoes, terminoinscricoes, fotocurso, instituicao FROM curso";
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
    $instituicao = $_POST['instituicao'];

    // Processamento do upload da imagem
    $foto = $_FILES['fotocurso'];

    // Verifica se foi enviado um arquivo
    if ($foto['error'] === UPLOAD_ERR_OK) {
        $nomeArquivo = $foto['name'];
        $caminhoTemp = $foto['tmp_name'];

        // Diretório para salvar a imagem
        $diretorioSalvar = '/../views/fotos-banco/';

        // Move o arquivo para o diretório desejado
        if (move_uploaded_file($caminhoTemp, __DIR__ . $diretorioSalvar . $nomeArquivo)) {
            // Prepara a instrução SQL para inserção
            $sql = "INSERT INTO curso (nome_curso, descricao, areacurso, tipocurso, formato, quantidadevagas, duracao, turno, localidade, linksite, inicioinscricoes, terminoinscricoes, fotocurso, instituicao) 
            VALUES (:titulo, :descricao, :area, :tipocurso, :formato, :vagas, :duracao, :turno, :localidade, :link, :inicio, :termino, :nomeArquivo, :instituicao)";
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
            $stmt->bindParam(':nomeArquivo', $nomeArquivo);
            $stmt->bindParam(':instituicao', $instituicao);

            // Executa a instrução
            if ($stmt->execute()) {
                // Define a mensagem de feedback na sessão
                session_start();
                $_SESSION['success_message'] = 'Curso inserido com sucesso.';
            } else {
                // Em caso de erro na execução da consulta
                session_start();
                $_SESSION['error_message'] = "Erro ao inserir o curso.";
            }
        } else {
            // Em caso de erro ao mover o arquivo
            session_start();
            $_SESSION['error_message'] = "Erro ao fazer o upload da imagem.";
        }
    } else {
        // Em caso de erro no envio do arquivo
        session_start();
        $_SESSION['error_message'] = "Erro ao enviar o arquivo.";
    }

    // Redireciona para a página de administração
    header("Location: ../views/admin/areaadm.php");
    exit(); // Certifique-se de sair após o redirecionamento
}
?>
