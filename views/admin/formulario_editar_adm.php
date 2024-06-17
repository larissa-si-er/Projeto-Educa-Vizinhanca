<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["usuario"]) && isset($_POST["email"]) && isset($_POST["senha"])) {
        $usuario = $_POST["usuario"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];


  
        $sql = "INSERT INTO administracao (usuario, email, senha) VALUES ('$usuario', '$email', '$senha')";

        if ($conn->query($sql) === TRUE) {
            echo "Dados inseridos com sucesso!";
        } else {
            echo "Erro ao inserir dados: " . $conn->error;
        }

        $conn->close();

    } else {
        echo "Por favor, preencha todos os campos.";
    }
}
?>
