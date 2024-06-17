<?php
include '../models/conexao.php';

try {
    // Seleciona todos os administradores
    $sql = "SELECT id_admin, senha FROM administracao";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $admins = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($admins as $admin) {
        $id = $admin['id_admin'];
        $senha = $admin['senha'];

        // criptografada começa com '$2y$')
        if (strpos($senha, '$2y$') === 0) {
            echo "Senha do admin $id já está criptografada.<br>";
            continue;
        }

        $senhaCriptografada = password_hash($senha, PASSWORD_BCRYPT);

        $sqlUpdate = "UPDATE administracao SET senha = :senha WHERE id_admin = :id";
        $stmtUpdate = $conn->prepare($sqlUpdate);
        $stmtUpdate->bindParam(':senha', $senhaCriptografada, PDO::PARAM_STR);
        $stmtUpdate->bindParam(':id', $id, PDO::PARAM_INT);
        $stmtUpdate->execute();

        echo "Senha do admin $id foi criptografada e atualizada.<br>";
    }

    echo "Processo de criptografia de senhas concluído com sucesso!";
} catch (PDOException $e) {
    echo "Erro ao atualizar administradores: " . $e->getMessage();
}
?>
