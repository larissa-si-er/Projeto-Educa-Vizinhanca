<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome_curso = $_POST["nome_curso"];
    $horario = $_POST["horario"];
    $turno= $_POST["turno"];
    $localidade = $_POST["localidade"];
    $descricao = $_POST["descricao"];
    $areacurso = $_POST["areacurso"];
    $tipocurso = $_POST["tipocurso"];
    $formato = $_POST["formato"];
    $quantidadevagas = $_POST["quantidadevagas"];
    $duracao = $_POST["duracao"];
    $linksite = $_POST["linksite"];
    $inicioinscricoes = $_POST["inicioinscricoes"];
    $terminoinscricoes = $_POST["terminoinscricoes"];
    $fotocurso = $_POST["fotocurso"];
    
  
    echo "Título do Curso: " . $nome_curso . "<br>";
    echo "Horario: " . $horario. "<br>";
    echo "Turno: " . $turno . "<br>";
    echo "Localidade: " . $localidade . "<br>";
    echo "Descrição: " . $descricao . "<br>";
    echo "Área do curso: " . $areacurso . "<br>";
    echo "Tipo do curso: " . $tipocurso . "<br>";
    echo "Formato: " . $formato . "<br>";
    echo "Quantidade de Vagas: " . $quantidadevagas . "<br>";
    echo "Duracao: " . $duracao . "<br>";
    echo "Link Site: " . $linksite . "<br>";
    echo "Ínicio inscrições: " . $inicioinscricoes . "<br>";
    echo "Termino Inscrições: " . $terminoinscricoes . "<br>";
    echo "Foto Curso: " . $fotocurso . "<br>";
    
}
?>