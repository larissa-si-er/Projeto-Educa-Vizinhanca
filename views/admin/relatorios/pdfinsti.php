<?php

require_once '../../../vendor/autoload.php';
include_once '../../../models/conexao.php';

$data_atual = date("d/m/Y");

$query_instituicao = "SELECT  i.nome, i.nome_insti, i.telefone_fixo, i.telefone_celular, i.email, i.cnpj,  i.cep, e.estado, e.logradouro, e.bairro, e.num
                FROM instituicao i
                LEFT JOIN endereco e ON i.cep = e.cep";
$result_instituicao = $conn->prepare($query_instituicao);
$result_instituicao->execute(); 

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
$dados .= "#data { font-size: 12px; text-align: center;}"; 
$dados .= "</style>";
$dados .= "</head>";
$dados .= "<body>";
$dados .= "<img src='http://localhost/Projeto-Educa-Vizinhanca/views/img/imgpdf.jpg'><br>";
$dados .= "<h3>Relatório de Instituições</h3>";
while($row_instituicao = $result_instituicao->fetch(PDO::FETCH_ASSOC)){
    //var_dump($row_instituicao);
    extract($row_instituicao);
    $dados .= "<p><strong>Instituição:</strong> $nome <br>";
    $dados .= "<strong>Telefone:</strong> $telefone_fixo <br>";
    $dados .= "<strong>Celular:</strong> $telefone_celular<br>";
    $dados .= "<strong>Email:</strong> $email </p>";
    $dados .= "<strong>CNPJ:</strong> $cnpj <br>";
    $dados .= "<strong>CEP:</strong> $cep <br>";
    $dados .= "<strong>Estado:</strong> $estado <br>";
    $dados .= "<strong>Logadouro:</strong> $logradouro <br>"; 
    $dados .= "<strong>Bairro:</strong> $bairro <br>";
    $dados .= "<strong>Número:</strong> $num <br>"; 
    $dados .= "<hr>";
}
$dados .= "<p id='data'>Data de Geração do Relatório: $data_atual</p>";
$dados .= "</body>";
$dados .= "</html>";

// Referenciar o namespace Dompdf
use Dompdf\Dompdf;

// Instanciar e usar a classe dompdf
$dompdf = new Dompdf(['enable_remote' => true]);

// Instanciar o metodo loadHtml e enviar o conteudo do PDF
$dompdf->loadHtml($dados);

// Configurar o tamanho e a orientacao do papel
// landscape - Imprimir no formato paisagem
//$dompdf->setPaper('A4', 'landscape');
// portrait - Imprimir no formato retrato
$dompdf->setPaper('A4', 'portrait');

// Renderizar o HTML como PDF
$dompdf->render();

// Gerar o PDF
$dompdf->stream();
?>
