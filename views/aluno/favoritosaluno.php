<?php
require_once '../../head.php';
include_once '../../views/menuinterno.php';
require_once '../../models/conexao.php';


if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../views/auth/login.php');
    exit();
}

$idAlunoLogado = $_SESSION['user_data']['id_aluno'] ?? null;

if (!$idAlunoLogado) {
    echo "ID do aluno não encontrado.";
    exit();
}

try {
    $sql = "SELECT curso.* FROM salvo 
            JOIN curso ON salvo.id_curso = curso.id_curso 
            WHERE salvo.id_aluno = :id_aluno";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_aluno', $idAlunoLogado, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro ao executar a consulta: " . $e->getMessage();
}

$conn = null;
?>  

<div class="voltar">
  <div class="meu_perfil">
    <ul>
      <li>
        <i class="fa-solid fa-arrow-left" style="margin-top: 0px; display: inline-block;"></i>
        <a href="areaaluno.php" style="display: inline-block; vertical-align: top;">Voltar</a>
      </li>
    </ul>
  </div>
</div>
<br>

<div class="container">
  <?php if ($result): ?>
    <?php foreach ($result as $curso): ?>
      <div class="card">
        <div id="pagina1" class="page">
        <?php $caminhoImagem = '/../views/fotos-banco/' . htmlspecialchars($curso['fotocurso']); ?>
        <img src="<?php echo $caminhoImagem; ?>" alt="<?php echo htmlspecialchars($curso['nome_curso']); ?>" class="curso-img">
          <div class="card-content">
            <div class="card-title"> <strong>Curso: </strong><?php echo htmlspecialchars($curso['nome_curso']); ?></div>
            <div class="card-price"><?php echo htmlspecialchars($curso['tipocurso']); ?></div>
          </div>
          <div class="card-description">
            <p><strong> Área do curso: </strong> <?php echo htmlspecialchars($curso['areacurso']); ?></p>
          </div>
          <br>

          <a href="<?php echo htmlspecialchars($curso['linksite']); ?>" target="_blank" class="botao-acessar">Acessar</a>
          
          <a href="../feed.php" class="botao-acessar"><i class="fa-regular fa-eye"></i></a>

    
        </div>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <p>Nenhum curso salvo.</p>
  <?php endif; ?>
</div>

<script>
    // Aqui vai o JavaScript que você já possui para interagir com o botão salvar
</script>

  <style>

.curso-buttons {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-top: 20px;
  margin-bottom: 3px;
}

.botao-acessar {
  display: inline-block;
  padding: 10px 20px;
  background-color: #74DCE6;
  color: #ffffff;
  text-decoration: none;
  border-radius: 5px;
  transition: background-color 0.3s ease;
  margin-right: 70px;
  margin-left: 19px;
}

.botao-acessar:hover {
  background-color: #65cad3;
}

 .meu_perfil ul {
  list-style: none;
  display: flex;
}
.meu_perfil li {
  margin-right: 100px; 
  
}
    .meu_perfil {
  overflow: hidden;
  padding-left: 12%;
  padding-top: 0.5%;
  background-color: #63D7E4;
}
    .voltar {
   justify-content: center; 
   margin-top: 10px;

}
.voltar a{
  text-decoration: none;
  color: #0d0c22;
  
}
       .titulo_pag h1{
            text-align: left;
            padding-left: 12%;
        }
    
    .container {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-around;
      padding: 20px;
      
    }

    .card {
  width: 400px;
  height: 380px;  
  margin-bottom: 20px;
  border: 1px solid #ccc;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);

}


.card img {
  border-radius: 20px;
  width: 380px; /* Largura desejada */
  height: auto; /* Altura automática para manter a proporção */
  object-fit: cover; /* Ajuste para cobrir o espaço do elemento */
  max-height: 200px; /* Altura máxima permitida */
  padding: 10px; /* Espaçamento interno */
}

    .card-content {
  display: flex;
  justify-content: space-between;
  padding: 10px 30px;
 
}

.card-title,
.card-price {
  flex: 1; 
  margin-right: 10px; 
}
.card-price{
  padding-left: 60px;
}

    .card-description p{
      margin-top: 10px;
      padding-left: 30px;
      color: #0d0c22;
    }

    /*pesquisar*/
.group {
 display: flex;
 line-height: 28px;
 align-items: center;
 position: relative;
 max-width: 450px;
}

.input {
 width: 320px;
 height: 40px;
 line-height: 28px;
 padding: 0 1rem;
 padding-left: 2.5rem;
 border: 2px solid transparent;
 border-radius: 8px;
 outline: none;
 background-color: #f3f3f4;
 color: #0d0c22;
 transition: .3s ease;
}

.input::placeholder {
 color: #9e9ea7;
}

.input:focus, input:hover {
 outline: none;
 border-color: #63D7E4;
 background-color: #fff;
 
}

#search {
 position: absolute;
 left: 1rem;
 width: 1rem;
 height: 1rem;
}

/*icons pregress*/
.progress{
  padding-left: 30px;
  display: flex;
  flex-wrap: wrap;
  
}
.item {
  display: flex;
  align-items: center;
  margin-right: 20px; 
  margin-bottom: 20px;
 
}

.item i {
  margin-right: 10px; 
}
progress {
  width: 100px;
  height: 10px;
  border-radius: 20px;
  -webkit-appearance: none;
}

progress::-webkit-progress-bar {
  background-color: #f2f2f2;
  border-radius: 20px;
}

progress::-webkit-progress-value {
  background-color: #63D7E4;
  border-radius: 20px;
}

progress:hover::after {
  content: attr(value);
  position: absolute;
  top: -30px;
  left: 50%;
  transform: translateX(-50%);
  background-color: rgba(0, 0, 0, 0.8);
  color: #fff;
  padding: 5px 10px;
  border-radius: 5px;
  font-size: 12px;
}

  </style>

  <?php
  require_once '../../footer.php';
  ?>