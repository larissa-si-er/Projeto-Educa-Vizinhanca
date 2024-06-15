<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Resposta</title>
</head>
<body>
    <h2>Formulário de Resposta</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <?php
        // Gera aleatoriamente uma pergunta
        $perguntas = [
            "a" => "Qual o nome da sua mãe?",
            "b" => "Qual a data do seu nascimento?",
            "c" => "Qual o CEP do seu endereço?"
        ];
        
        $pergunta = array_rand($perguntas);
        ?>
        <label><?php echo $perguntas[$pergunta]; ?></label><br>
        <input type="hidden" name="pergunta" value="<?php echo $pergunta; ?>">
        <input type="text" name="resposta"><br><br>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>
