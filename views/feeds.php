<?php
// Aqui você faz a conexão com o banco de dados e busca os cursos
// Exemplo simplificado:
$cursos = []; // Array simulado de cursos
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Cursos</title>
</head>
<body>
    <h1>Lista de Cursos</h1>
    
    <?php foreach ($cursos as $curso): ?>
        <div class="curso">
            <h2><?php echo $curso['nome']; ?></h2>
            <p><?php echo $curso['descricao']; ?></p>
            
            <!-- Formulário para curtir -->
            <form action="actions.php" method="post">
                <input type="hidden" name="action" value="like">
                <input type="hidden" name="curso_id" value="<?php echo $curso['id']; ?>">
                <button type="submit">Curtir</button>
            </form>
            
            <!-- Formulário para comentar -->
            <form action="actions.php" method="post">
                <input type="hidden" name="action" value="comment">
                <input type="hidden" name="curso_id" value="<?php echo $curso['id']; ?>">
                <textarea name="comment_text" placeholder="Digite seu comentário"></textarea><br>
                <button type="submit">Comentar</button>
            </form>
            
            <!-- Formulário para compartilhar -->
            <form action="actions.php" method="post">
                <input type="hidden" name="action" value="share">
                <input type="hidden" name="curso_id" value="<?php echo $curso['id']; ?>">
                <button type="submit">Compartilhar</button>
            </form>
            
            <hr>
        </div>
    <?php endforeach; ?>
</body>
</html>
