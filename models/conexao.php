<?php

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "educa_vizinhanca";
$port = 3306;

try{
    
    $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $user, $pass);
  
    echo "Conexão com banco de dados realizado com sucesso!";
}catch(PDOException $erro){
    echo "Erro: Conexão com banco de dados não realizada".$erro; 
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