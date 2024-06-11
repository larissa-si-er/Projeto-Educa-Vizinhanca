<?php
require_once '../../../vendor/autoload.php';
include_once '../../../models/conexao.php';

$data_atual = date("d/m/Y");

$query_aluno = "SELECT a.id_aluno, a.nome, a.data_nasc, a.sexo, a.nome_materno, a.cpf, a.email, 
                a.telefone_celular, a.telefone_fixo, a.usuario, a.cep, e.uf, e.logradouro, e.bairro, e.numero
                FROM aluno a
                LEFT JOIN endereco e ON a.cep = e.cep";

$result_aluno = $conn->prepare($query_aluno);
$result_aluno->execute(); 

$dados = "<!DOCTYPE html>";
$dados .= "<html lang='pt-br'>";
$dados .= "<head>";
$dados .= "<meta charset='UTF-8'>";
$dados .= "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
$dados .= "<title>Educa Vizinhança</title>";
$dados .= "<style>";
$dados .= "body { font-family: Arial, sans-serif; }"; 
$dados .= "h3 { color: #333; font-size:30px;}"; 
$dados .= "hr { border: 1px solid #ccc; }";
$dados .= "img { display: block; margin: 0 auto; }";
$dados .= "#data { font-size: 12px; text-align: center; }"; 
$dados .= "</style>";
$dados .= "</head>";
$dados .= "<body>";
$dados .= "<img src='http://localhost/Projeto-Educa-Vizinhanca/views/img/imgpdf.jpg'><br>";
$dados .= "<h3>Relatório de Clientes</h3>";
while($row_aluno = $result_aluno->fetch(PDO::FETCH_ASSOC)){
    extract($row_aluno);
    $dados .= "<strong>Nome:</strong> $nome <br>"; 
    $dados .= "<strong>Data Nasc:</strong> $data_nasc <br>"; 
    $dados .= "<strong>Sexo:</strong> $sexo <br>"; 
    $dados .= "<strong>Nome Materno:</strong> $nome_materno <br>"; 
    $dados .= "<strong>CPF:</strong> $cpf <br>"; 
    $dados .= "<strong>Email:</strong> $email <br>"; 
    $dados .= "<strong>Celular:</strong> $telefone_celular <br>"; 
    $dados .= "<strong>Telefone:</strong> $telefone_fixo <br>";
    $dados .= "<strong>Usuário:</strong> $usuario <br>";  
    $dados .= "<strong>CEP:</strong> $cep <br>"; 
    $dados .= "<strong>UF:</strong> $uf <br>";
    $dados .= "<strong>Logadouro:</strong> $logradouro <br>"; 
    $dados .= "<strong>Bairro:</strong> $bairro <br>";
    $dados .= "<strong>Número:</strong> $numero <br>"; 
    $dados .= "<hr>";
}
$dados .= "<p id='data'>Data de Geração do Relatório: $data_atual</p>";
$dados .= "</body>";
$dados .= "</html>";

use Dompdf\Dompdf;

$dompdf = new Dompdf(['enable_remote' => true]);
$dompdf->loadHtml($dados);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream();
?>
