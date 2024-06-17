<?php
// conexao.php

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "educa_vizinhanca";
$port = 3306;

try {
    $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Configura o modo de erro para lançar exceções
} catch(PDOException $erro) {
    die("Erro: Conexão com banco de dados não realizada: " . $erro->getMessage());
}

function consultarAlunos($idAluno) {
    global $conn; // Importante: garantir que $conn esteja definido globalmente

    try {
        // Consulta SQL para selecionar dados dos alunos associados ao usuário logado
        $sql = "SELECT a.id_aluno, a.nome, a.data_nasc, a.sexo, a.nome_materno, a.cpf, a.email, 
                       a.telefone_celular, a.telefone_fixo, e.estado, e.logradouro, e.bairro, e.num, e.cep
                FROM aluno a
                INNER JOIN endereco e ON a.cep = e.cep
                WHERE a.id_aluno = :id_aluno";

        // Preparar a consulta
        $stmt = $conn->prepare($sql);

        // Bind do parâmetro idAluno
        $stmt->bindParam(':id_aluno', $idAluno, PDO::PARAM_INT);

        // Executar a consulta
        $stmt->execute();

        // Retornar o resultado da consulta
        return $stmt;
    } catch (PDOException $e) {
        echo "Erro ao executar a consulta: " . $e->getMessage();
        return false;
    }
}
function consultarInsti($idInsti) {
    global $conn; // Importante: garantir que $conn esteja definido globalmente

    try {
        // Consulta SQL para selecionar dados da instituição associada ao ID informado
        $sql = "SELECT i.id_instituicao, i.nome_insti, i.telefone_fixo, i.telefone_celular, i.cep, i.email, 
                       i.cnpj, e.estado, e.logradouro, e.bairro, e.num
                FROM instituicao i
                INNER JOIN endereco e ON i.cep = e.cep
                WHERE i.id_instituicao = :id_instituicao";

        // Preparar a consulta
        $stmt = $conn->prepare($sql);

        // Bind do parâmetro idInsti
        $stmt->bindParam(':id_instituicao', $idInsti, PDO::PARAM_INT);

        // Executar a consulta
        $stmt->execute();

        // Retornar o resultado da consulta
        return $stmt;
    } catch (PDOException $e) {
        echo "Erro ao executar a consulta: " . $e->getMessage();
        return false;
    }
}

?>



<?php 
// CLASSE CONEXAO
class conexao {
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $dbname = "educa_vizinhanca";
    private $port = 3306;
    private $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=$this->host;port=$this->port;dbname=$this->dbname", $this->user, $this->pass);
        } catch (PDOException $e) {
            echo "Erro: Conexão com banco de dados não realizada. " . $e->getMessage();
        }

        return $this->conn;
    }
}
?>