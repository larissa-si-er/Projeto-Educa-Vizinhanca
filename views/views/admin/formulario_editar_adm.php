<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["user"]) && isset($_POST["email"]) && isset($_POST["senha"])) {
        $user = $_POST["user"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];
        
        echo "User: " . $user . "<br>";
        echo "Email: " . $email . "<br>";
        echo "Senha: " . $senha . "<br>";
    } else {
        echo "Por favor, preencha todos os campos.";
    }
}
?>