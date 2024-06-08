<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome_produto = $_POST["nome_produto"];
    $descricao = $_POST["descricao"];
    $preco = $_POST["preco"];
    $quantidade_estoque = $_POST["quantidade_estoque"];
    $cor = $_POST["cor"];
    $inicioinscricoes = $_POST["inicioinscricoes"];
    $categoria = $_POST["categoria"];
    $imagem = $_POST["imagem"];
    
  
    echo "Nome do Produto: " . $nome_produto . "<br>";
    echo "Descrição: " . $descricao . "<br>";
    echo "Valor: " . $preco . "<br>";
    echo "Estoque: " . $quantidade_estoque . "<br>";
    echo "Cor: " . $cor . "<br>";
    echo "Categoria: " . $categoria . "<br>";
    echo "Foto Produto: " . $imagem . "<br>";
    
}
?>		