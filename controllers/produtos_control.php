<?php
include '../models/conexao.php';

// Busca todos os produtos
$sql = "SELECT nome_produto, descricao, preco, imagem,id_produto FROM produto";
$stmt = $conn->prepare($sql);
$stmt->execute();
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Verifica se há produtos
if ($produtos === false) {
    $produtos = [];
}

// Função para gerar um nome de arquivo único
function gerarNomeArquivoUnico($nome_original) {
    $ext = pathinfo($nome_original, PATHINFO_EXTENSION);
    return "produto-" . uniqid() . '.' . $ext;
}

// Verifica se foi enviado um formulário POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se o campo de imagem não está vazio
    if (!empty($_FILES['imagem']['tmp_name'])) {
        $foto_original = $_FILES['imagem'];
        $origem = $foto_original['tmp_name'];
        $nome_original = $foto_original['name'];
        $destino = gerarNomeArquivoUnico($nome_original);
        $caminho_destino = __DIR__ . "/../views/fotos-banco/" . $destino;
        
        // Cria o diretório se não existir
        // if (!is_dir(__DIR__ . "/../views/fotos-banco/")) {
        //     mkdir(__DIR__ . "/../views/fotos-banco/", 0777, true);
        // }

        // Move o arquivo para o destino
        if (move_uploaded_file($origem, $caminho_destino)) {
            try {
                // Insere os dados do produto no banco de dados
                $sql = "INSERT INTO produto (nome_produto, descricao, preco, imagem, categoria, is_lancamento, cor) 
                        VALUES (:nome_produto, :descricao, :preco, :imagem, :categoria, :is_lancamento, :cor)";
                $stmt = $conn->prepare($sql);

                // Bind dos parâmetros
                $stmt->bindParam(':nome_produto', $_POST['nome_produto']);
                $stmt->bindParam(':descricao', $_POST['descricao']);
                $stmt->bindParam(':preco', $_POST['preco']);
                $stmt->bindParam(':imagem', $destino);
                $stmt->bindParam(':categoria', $_POST['categoria']);
                $stmt->bindParam(':is_lancamento', $_POST['is_lancamento']);
                $stmt->bindParam(':cor', $_POST['cor']);

                $stmt->execute();

                // Define a mensagem de sucesso na sessão
                session_start();
                $_SESSION['success_message'] = "Produto inserido com sucesso!";

                // Redireciona para a página de administração
                header("Location: ../views/admin/areaadm.php");
                exit();
            } catch (PDOException $e) {
                // Em caso de erro, define a mensagem de erro na sessão
                session_start();
                $_SESSION['error_message'] = "Erro ao inserir o produto: " . $e->getMessage();

                // Redireciona para a página de administração
                header("Location: ../views/admin/areaadm.php");
                exit();
            }
        } else {
            // Caso haja erro ao mover a imagem
            session_start();
            $_SESSION['error_message'] = "Erro ao mover a imagem para o destino.";
            header("Location: ../views/admin/areaadm.php");
            exit();
        }
    } else {
        // Caso nenhum arquivo de imagem tenha sido enviado
        session_start();
        $_SESSION['error_message'] = "Nenhuma imagem foi enviada.";
        header("Location: ../views/admin/areaadm.php");
        exit();
    }
}
?>
