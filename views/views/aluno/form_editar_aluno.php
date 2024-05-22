<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["user"]) && isset($_POST["email"]) && isset($_POST["senha"])) {
        $nome = $_POST["user"];
        $data_nasc = $_POST["data_nasc"];
        $telefone_fixo = $_POST["telefone"];
        $endereco = $_POST["endereco"];
        $cnpj = $_POST["cnpj"];
        $cep = $_POST["cep"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];
        
        echo " Nome Instituição: " . $user . "<br>";
        echo " Telefone Fixo: " . $user . "<br>";
        echo " Endereço: " . $user . "<br>";
        echo " CNPJ: " . $user . "<br>";
        echo " CEP: " . $user . "<br>";
        echo "Email: " . $email . "<br>";
        echo "Senha: " . $senha . "<br>";
    } else {
        echo "Por favor, preencha todos os campos.";
    }
}