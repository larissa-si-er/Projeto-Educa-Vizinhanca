

<?php
    require_once '../../head.php';
    include_once '../menuinterno.php';
    require_once '../../models/conexao.php';

?>  
<?php
// session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../views/auth/login.php');
    exit();
}

$primeiroNome = $_SESSION['first_name'] ?? '';

// var_dump($_SESSION);

?>
<!-- Script [inicio] -->
<script src="../js/modal.js"></script>
<script src="../js/quant-prod.js"></script>
<script src="../js/quant-curso.js"></script>
<script src="../js/produtos.js"></script>
<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.0/dist/sweetalert2.min.css">
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.0/dist/sweetalert2.min.js"></script>
<!-- Script [fim] -->
    
  <!-- Exibição do feedback, se houver -->
<?php if (isset($feedback)): ?>
  <div class="feedback">
  <?php echo $feedback; ?>
  </div>
<?php endif; ?>

<div class="voltar">
  <div class="meu_perfil">
  <ul>
    <li>
    <i class="fa-solid fa-arrow-left" style="margin-top: 0px; display: inline-block;"></i>
    <a href="../feed.php" style="display: inline-block; vertical-align: top;">Voltar</a>
  </ul>
  </div>
  </div>
  <div class="bem_vindo">
    <h1>Bem Vindo!</h1>
    <P>Área do Administrador - Painel de Controle</P>
  </div>
<div class="container" id="i-container" >
  <div class="div1">
    <h1>Seus dados abaixo</h1>
    <br>
    <?php

        // Verifica se o usuário está logado
       if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && isset($_SESSION['user_data'])) {
       $user = $_SESSION['user_data'];
       echo '<p>User: ' . htmlspecialchars($user['usuario']) . '</p>';
       echo '<p>Email: ' . htmlspecialchars($user['email']) . '</p>';
       echo '<p>Senha: *********</p>';
        } else {
          // Usuário não está logado
           echo '<p><strong>User:</strong> Não logado</p>';
           echo '<p><strong>Email:</strong> Não logado</p>';
           }
    ?>
    <!--<button id="vermais"><a href="#">Ver mais</a>
                 <svg
                   xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="4"
                  >
                    <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M14 5l7 7m0 0l-7 7m7-7H3"
                    ></path>
                  </svg>
              </button>-->
    <br>
    <div class="acoes">
  <ul>
<!--modal editar-->
<li>
<button id="abrirModalEditar" title="Editar Curso"><i class="fa-solid fa-user-pen" style="cursor: pointer;" title="Editar Perfil"></i></button>
    <div id="modalEditar" class="modal">
        <div class="modal-content">
            <span class="fechar">&times;</span>
            <h2>Editar Perfil</h2>
            <form id="formEditarAdm" action="formulario_editar_adm.php" method="post">
    <label for="usuario">User:</label>
    <input type="text" id="usuario" name="usuario" value="<?php echo isset($_SESSION['usuario']) ? htmlspecialchars($_SESSION['usuario']) : ''; ?>" required>
    
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : ''; ?>" required>
    
    <label for="senha">Nova Senha:</label>
    <input type="password" id="senha" name="senha" required>

    <button type="submit" class="alterar">Salvar Alterações</button>
</form>

        </div>
    </div>
</li>
    <li><a href=""><i class="fa-solid fa-arrow-right-from-bracket" title="Sair"></i></a></li>
  </ul>
</div>
    <br>
    <script>
    $(document).ready(function() {
            // Exibe o modal de edição ao clicar no botão
            $('#abrirModalEditar').click(function() {
                $('#modalEditar').modal('show');
            });

            // Verifica se houve sucesso ao submeter o formulário
            <?php if (!empty($mensagemSucesso)) : ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso!',
                    text: '<?php echo addslashes($mensagemSucesso); ?>',
                    showConfirmButton: false,
                    timer: 2000 // Fecha automaticamente após 2 segundos
                }).then((result) => {
                    // Redireciona para outra página após a mensagem de sucesso (opcional)
                    window.location.href = "areaadm.php";
                });
            <?php endif; ?>

            // Verifica se houve erro ao submeter o formulário
            <?php if (!empty($mensagemErro)) : ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Erro!',
                    text: '<?php echo addslashes($mensagemErro); ?>',
                    showConfirmButton: false,
                    timer: 3000 // Fecha automaticamente após 3 segundos
                });
            <?php endif; ?>
        });
    </script>
    
    <!--cursos_add-->
    <h1>Adicionados</h1><br>
<div class="prod-container">
    <div class="card_quant_prod">
        <div class="card-header-prod"></div>
        <div class="card-body-prod">
            <h1 class="card-number-prod" id="quantidadeProdutos">Carregando...</h1>
            <p class="card-products">Produtos </p>
            <button id="vermais"><a href="">Ver mais</a>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                </svg>
            </button>
        </div>
    </div>
    <div class="card_quant_prod">
        <div class="card-header-prod"></div>
        <div class="card-body-prod">
            <h1 class="card-number-prod" id="quantidadeCursos">Carregando...</h1>
            <p class="card-products">Cursos</p>
            <button id="vermais"><a href="cursosaddadm.php">Ver mais</a>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                </svg>
            </button>
        </div>
    </div>
</div>
<script src="../js/quant-curso.js"></script>
<script src="../js/quant-prod.js"></script>
   <!-- <div class="card">
      <h3 class="card__title"><i class="fa-solid fa-graduation-cap"></i></h3>
      <p class="card__content"><a href="cursosaddadm.php" >Veja seus cursos adicionados na plataforma aqui.</a></p>
      <div class="card__date"></div>
      <div class="card__arrow">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" height="15" width="15">
          <path fill="#fff" d="M13.4697 17.9697C13.1768 18.2626 13.1768 18.7374 13.4697 19.0303C13.7626 19.3232 14.2374 19.3232 14.5303 19.0303L20.3232 13.2374C21.0066 12.554 21.0066 11.446 20.3232 10.7626L14.5303 4.96967C14.2374 4.67678 13.7626 4.67678 13.4697 4.96967C13.1768 5.26256 13.1768 5.73744 13.4697 6.03033L18.6893 11.25H4C3.58579 11.25 3.25 11.5858 3.25 12C3.25 12.4142 3.58579 12.75 4 12.75H18.6893L13.4697 17.9697Z"></path>
        </svg>
      </div>
    </div> 
   APAGAR CSS-->

    <div class="button-container">
        
<!--add produto-->
<button class="button" id="abrirModalProduto" title="Adicionar Produto" style="cursor: pointer;">Adicionar Produto<i class="fa-regular fa-square-plus"></i></button>
    <div id="modalAdicionarP" class="modal">
        <div class="modal-content">
            <span class="fechar">&times;</span>
            <h2>Adicionar Produto</h2>
      <form action="../../controllers/produtos_control.php" id="formProduto" method="post" enctype="multipart/form-data">

        <label for="titulo">Nome do Produto:</label>
        <input type="text" id="nome_produto" name="nome_produto" required>
        
        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao" rows="4" required></textarea>
        
        <label for="preco">Preço:</label>
        <input type="number" class="form-control" id="preco" name="preco" step="0.01" required>
       
        <label for="quantidade">Quantidade:</label>
        <input type="number" class="form-control" id="quantidade" name="quantidade_estoque" required>

        <label for="cor">Cor:</label>
        <input type="text" class="form-control" id="cor" name="cor" required>

        <label for="categoria">Categoria:</label>
        <input type="text" class="form-control" id="categoria" name="categoria" required>

        <label class="checkbox-container" for="is_lancamento">É lançamento?
        <!-- <input type="checkbox" id="is_lancamento" name="is_lancamento" value="1"> -->
        <div class="checkbox-wrapper-12">
        <div class="cbx">
          <input checked="" type="checkbox" id="cbx-12" name="is_lancamento" value="1" >
          <label for="cbx-12"></label>
          <svg fill="none" viewBox="0 0 15 14" height="14" width="15">
            <path d="M2 8.36364L6.23077 12L13 2"></path>
          </svg>
        </div>
        
        <svg version="1.1" xmlns="http://www.w3.org/2000/svg">
          <defs>
            <filter id="goo-12">
              <feGaussianBlur result="blur" stdDeviation="4" in="SourceGraphic"></feGaussianBlur>
              <feColorMatrix result="goo-12" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 22 -7" mode="matrix" in="blur"></feColorMatrix>
              <feBlend in2="goo-12" in="SourceGraphic"></feBlend>
            </filter>
          </defs>
        </svg>
      </div>
        </label>
         <label for="imagem">Foto do Produto:</label>
         <input  type="file" id="imagem" name="imagem" >
         <!-- accept="image/*" -->
         
        <button type="submit" class="adicionar">Adicionar</button>
        </form>
    </form>
  </div>
</div>


  <!--modal adicionar curso-->
  <button class="button" id="abrirModalAdicionar" title="Adicionar Curso" style="cursor: pointer;">Adicionar Curso<i class="fa-regular fa-square-plus"></i></button>
    <div id="modalAdicionar" class="modal">
        <div class="modal-content">
            <span class="fechar">&times;</span>
            <h2>Adicionar Curso</h2>
    <form action="../../controllers/curso_control.php" id="formCurso" method="post" enctype="multipart/form-data">
        <label for="titulo">Título do Curso:</label>
        <input type="text" id="nome_curso" name="nome_curso" required>
        
        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao" rows="4" required></textarea>
        
        <label for="area">Área do Curso:</label>
        <input type="text" id="areacurso" name="areacurso" required>
       
        <label for="tipo">Tipo do curso:</label>
        <select id="tipocurso" name="tipocurso" required>
            <option value="Manhã">Extenção</option>
            <option value="Tarde">Livre</option>
        </select>

        <label for="formato">Formato:</label>
        <select id="formato" name="formato" required>
            <option value="Manhã">Pesencial</option>
            <option value="Tarde">Ead</option>
        </select>

        <label for="vagas">Quantidade de Vagas:</label>
        <input type="number" id="quantidadevagas" name="quantidadevagas" min="0" required>
        
        <label for="duracao">Duração:</label>
        <input type="text" id="duracao" name="duracao" required>
        
        <label for="turno">Turno:</label>
        <select id="turno" name="turno" required>
            <option value="Manhã">Manhã</option>
            <option value="Tarde">Tarde</option>
            <option value="Noite">Noite</option>
        </select>
        
        <label for="local">Local:</label>
        <input type="text" id="localidade" name="localidade" required>
        
        <label for="link">Link do Site:</label>
        <input type="url" id="linksite" name="linksite" placeholder="https://example.com" required>
        
        <label for="instituicao">Instituição:</label>
        <input type="text" id="instituicao" name="instituicao">

        <label for="inicio">Início das Inscrições:</label>
        <input type="date" id="inicioinscricoes" name="inicioinscricoes" required>
        
        <label for="termino">Término das Inscrições:</label>
        <input type="date" id="terminoinscricoes" name="terminoinscricoes" required>
         
         <label for="foto">Foto do Curso:</label>
         <input type="file" id="fotocurso" name="fotocurso" accept="image/*">
         
        <button type="submit" class="adicionar">Adicionar</button>
    </form>
  </div>
</div>
</div>
    <br>
  </div>
  <div class="div2">
    <h1>Controle</h1>
    <div class="card-container">
    <div class="card_plano" >
  <div class="img"></div>
  <div class="textBox">
    <div class="textContent">
     <p class="h1"><a href="../../controllers/controlealuno.php">Controle de Aluno</a><i class="fa-solid fa-angle-right"></i></p>
    </div>
    <p class="p">Operações perfomadas.</p>
  <div>
</div>
</div>
</div> 
    <div class="card_plano" >
  <div class="img"></div>
  <div class="textBox">
    <div class="textContent">
     <p class="h1"><a href="../../controllers/controleinsti.php">Controle de Instituições</a><i class="fa-solid fa-angle-right"></i></p>
      <span class="span"></span>
    </div>
    <p class="p">Operações perfomadas.</p>
  <div>
</div>
</div>
</div>
<div class="card_plano" >
  <div class="img"></div>
  <div class="textBox">
    <div class="textContent">
     <p class="h1"><a href="../../controllers/tela-log-aluno.php">Logs de Autenticação</a><i class="fa-solid fa-angle-right"></i></p>
    </div>
    <p class="p">Alunos.</p>
  <div>
</div>
</div>
</div> 
    <div class="card_plano" >
  <div class="img"></div>
  <div class="textBox">
    <div class="textContent">
     <p class="h1"><a href="../../controllers/tela-log-insti.php">Logs de Autenticação</a><i class="fa-solid fa-angle-right"></i></p>
      <span class="span"></span>
    </div>
    <p class="p">Instituições.</p>
  <div>
</div>
</div>
</div>
</div>
<br>

<?php
    // Consulta para buscar o número de inscrições de alunos e instituições
$consulta_alunos = "SELECT COUNT(id_aluno) as total_alunos FROM aluno;";
$consulta_instituicoes = "SELECT COUNT(id_instituicao) as total_instituicoes FROM instituicao;";
$resultado_alunos = $conn->query($consulta_alunos);
$resultado_instituicoes = $conn->query($consulta_instituicoes);

// Obtendo o número total de inscrições de alunos e instituições
$total_alunos = $resultado_alunos->fetch(PDO::FETCH_ASSOC)['total_alunos'];
$total_instituicoes = $resultado_instituicoes->fetch(PDO::FETCH_ASSOC)['total_instituicoes'];
?>
    <h1>Overview</h1>
    <canvas id="myChart" width="200" height="200"></canvas>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  var ctx = document.getElementById('myChart').getContext('2d');
//cor do grafico
  var data = {
    labels: ['Inscrições de Alunos', 'Inscrições de Instituições'],
    datasets: [{
        data: [<?php echo $total_alunos; ?>, <?php echo $total_instituicoes; ?>],
        backgroundColor: [
            'rgba(116, 220, 230, 0.6)',   // Azul claro para os alunos (#74DCE6)
            'rgba(186, 186, 186, 0.6)'     // Cinza para as instituições (#bababa)
        ],
        borderColor: [
            'rgba(116, 220, 230, 1)',     // Azul claro para os alunos (#74DCE6)
            'rgba(186, 186, 186, 1)'       // Cinza para as instituições (#bababa)
        ],
        borderWidth: [1, 1] //  borda- conjunto de dados
    }]
};

  var options = {
    responsive: false,
    maintainAspectRatio: false,
    legend: {
      position: 'bottom'
    }
  };

  var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: data,
    options: options
  });
</script>
</div>
</div>

<br>
<br>
<?php
require_once '../../footer.php';
?>


<style>
  /*icon modal*/
  #abrirModalEditar {
    border: none; 
    background-color: transparent; 
    padding: 0; 
}

#abrirModalEditar {
    padding: 8px;
    font-size: 24px; 
    color: #111; 
}
#abrirModalEditar i:hover{
  color: #63D7E4;
}

  /* Estilos para o modal */
  .modal {
      display: none;
      position: fixed;
      z-index: 1000;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0,0,0,0.5);
      overflow: auto;
  }
  
  /* Estilos para o conteúdo do modal */
  .modal-content {
      background-color: #fefefe;
      margin: 10% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 80%;
      max-width: 600px;
      border-radius: 8px;
  }
  
  /* Estilos para o botão de fechar o modal */
  .fechar {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
      cursor: pointer;
  }
  
  .fechar:hover,
  .fechar:focus {
      color: black;
      text-decoration: none;
      cursor: pointer;
  }
  
  /* Estilos para o formulário dentro do modal */
  form {
      display: grid;
      grid-gap: 10px;
  }
  
  label {
      font-weight: bold;
  }
  
  input[type="text"],
  input[type="password"],
  input[type="email"],
  input[type="number"],
  input[type="date"],
  select,
  textarea {
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
  }
  
  input[type="url"] {
      width: calc(100% - 24px); /* ajusta o tamanho para caber o ícone de link */
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
  }

  .adicionar{
  margin-left: 50%; 
  cursor: pointer;
  border-radius: 7px;
  width: 140px;
  height: 35px;
  color: #007491;
  border: 1px solid #007491;
}
.adicionar:hover, .add-img-curso:hover{
    -webkit-box-shadow: 0px 0px 2px 3px rgba(0, 45, 246, 0.1); 
    box-shadow: 0px 0px 2px 3px rgba(0, 68, 151, 0.146);
}



.meu_perfil {
  overflow: hidden;
  padding-left: 12%;
  padding-top: 0.5%;
  background-color: #63D7E4;
}

.meu_perfil ul {
  list-style: none;
  display: flex;
 
}

.meu_perfil li {
  margin-right: 100px; /* Espaçamento entre os itens */
  
}

.meu_perfil li:meu_perfil {
  margin-right: 0; /* Remove o espaçamento do último item */
}

.meu_perfil li a {
  text-decoration:none;
  color: #333;
  display: block;
  
}

.meu_perfil li a:hover {
  text-decoration:underline;
}
.voltar {
   justify-content: center; 
   margin-top: 10px;
  
}
.container {
  display: flex;
  flex-wrap: wrap; 
  justify-content: center; 
  margin-top: 1px;
  border-radius: 20px;
background: #FFFFFF;
box-shadow:  25px 25px 50px #d0d0d0,
             -25px -25px 50px #ffffff;
}

#i-container {
  padding-left: 5%;
  padding-right: 5%;
  padding-top: 0.5%;
}

.bem_vindo h1{
 text-align: center;
 margin-top:5px;
 padding: 10px;
 font-weight: 600;  
}
.bem_vindo p{
 text-align: center;
 margin-top: -20px;
 padding: 15px;
}
.div1{
    border-right: 1px solid #ccc;
}
.div1 h1{
 font-size: 25px;
 font-weight: 600;
}
.div1 h3{
 font-weight: 300;
}
 .div2 h1{
  font-size: 28px;
  font-weight: 600; 
}
.div1, .div2 {
  flex: 1 1 50%; 
  padding: 20px;

  box-sizing: border-box;
}
/*button add produto e add curso*/
.button-container {
  margin-top: 30px;
    display: flex;
}

.button {
    padding: 10px 10px;
    margin-right: 10px; /* Espaço entre os botões */
    background-color: #63D7E4; /* Cor de fundo */
    border: none;
    
    color: white;
    font-weight: 500;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 15px;
    cursor: pointer;
    border-radius: 5px;
}
.button i{ margin: 10px; font-size: 20;}

.button:last-child {
    margin-right: 0; /* Remove a margem do último botão para que não haja espaço extra */
}

.button:hover {
    background-color: #ccc; /* Cor de fundo ao passar o mouse */
}
/*quant prod quant curso*/
/*button add produto e add curso*/
.prod-container {
  display: flex; 
   
    
}
#vermais {
  padding: 0;
  margin: 0;
  border: none;
  background: none;
  cursor: pointer;
}

#vermais {
  --primary-color: #111;
  --hovered-color:  #63D7E4;
  position: relative;
  display: flex;
  font-weight: 600;
  font-size: 20px;
  gap: 0.5rem;
  align-items: center;
  margin-top: 2%;
}

#vermais a {
  margin: 0;
  position: relative;
  font-size: 15px;
  text-decoration: none;
  color: var(--primary-color);
}

#vermais::after {
  position: absolute;
  content: "";
  width: 0;
  left: 0;
  bottom: -7px;
  background: var(--hovered-color);
  height: 2px;
  transition: 0.3s ease-out;
}

#vermais a::before {
  position: absolute;
  /*   box-sizing: border-box; */
  content: "Ver mais";
  width: 0%;
  inset: 0;
  color: var(--hovered-color);
  overflow: hidden;
  transition: 0.3s ease-out;
}

#vermais:hover::after {
  width: 100%;
}

#vermais:hover a::before {
  width: 100%;
}

#vermais:hover svg {
  transform: translateX(4px);
  color: var(--hovered-color);
}

#vermais svg {
  color: var(--primary-color);
  transition: 0.2s;
  position: relative;
  width: 15px;
  transition-delay: 0.2s;
}

.card_quant_prod {
  background-color: white;
        border-radius: 5px;
        padding: 10px;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 10px; /* Largura fixa para um card pequeno */
        position: relative;
        margin-right: 5px; /* Adiciona uma margem entre as divs */
        flex: 1; /* Faz com que cada div ocupe a mesma largura */
}


.card-header-prod {
    background-color: #63D7E4;
    height: 5px;
    width: 100%;
    position: absolute;
    top: 0;
    left: 0;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
}

.card-body-prod {
    padding-top: 20px; /* Espaço para a linha azul */
}

.card-number-prod {
    font-size: 60px; /* Tamanho da fonte ajustado para um card pequeno */
    margin: 0;
    color: black;
}

.card-products{
    font-size: 16px;
    font-weight: 700;
    margin-top: 30px;
    padding-right: 80%; /* Distância entre o número e o texto "Produtos" */
}
.card-products {
        display: flex; /* Colocar os elementos em linha */
        align-items: center; /* Centralizar verticalmente os elementos */
    }



/*card cursos adicionados*/
.card {
  --border-radius: 0.75rem;
  --primary-color: #7257fa;
  --secondary-color: #3c3852;
  width: 210px;
  font-family: "Arial";
  padding: 1rem;
  cursor: pointer;
  border-radius: var(--border-radius);
  background: #f1f1f3;
  box-shadow: 0px 8px 16px 0px rgb(0 0 0 / 3%);
  position: relative;
}


.card > * + * {
  margin-top: 1.1em;
}

.card .card__content a{
  color: var(--secondary-color);
  font-size: 0.86rem;
}

.card .card__title {
  padding: 0;
  font-size: 1.3rem;
  font-weight: bold;
}

.card .card__date {
  color: #6e6b80;
  font-size: 0.8rem;
}

.card .card__arrow {
  position: absolute;
  background: #63D7E4;
  padding: 0.4rem;
  border-top-left-radius: var(--border-radius);
  border-bottom-right-radius: var(--border-radius);
  bottom: 0;
  right: 0;
  transition: 0.2s;
  display: flex;
  justify-content: center;
  align-items: center;
}

.card svg {
  transition: 0.2s;
}

/* hover */
.card:hover .card__title {
  color:  #63D7E4;;
  text-decoration: underline;
}

.card:hover .card__arrow {
  background: #111;
}

.card:hover .card__arrow svg {
  transform: translateX(3px);
}


@media screen and (max-width: 600px) {
  .div1, .div2 {
    flex-basis: 100%; 
  }
}

/*acoes do perfil*/
.acoes i{
  font-size: 20px;
  margin-top: 10px;
  
}
.acoes i:hover{
    color: #63D7E4;
}


.acoes ul {
  list-style: none;
  display: flex;
 
}

.acoes li {
  margin-right: 3px; 
  
}

.acoes li:meu_perfil {
  margin-right: 0; 
}
.acoes li a {
  text-decoration: none;
  color: #333;
  padding: 10px;
  display: block;
  transition: all 0.3s ease;
}

/*cards controle*/
.card-container {
    display: flex;
    justify-content: space-between; /* Para distribuir as divs igualmente ao longo do contêiner */
    flex-wrap: wrap; /* Para permitir que as divs quebrem para a próxima linha se necessário */
}
.card_plano {
  margin-top: 40px;
  width: 100%;
  max-width: 200px;
  height: 85px;
  background: #63D7E4;
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: left;
 
  
}


.textBox {
  width: calc(100% - 10px);
  margin-left: 10px;
  color: white;
  font-family: 'Poppins' sans-serif;
}

.textContent {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.span {
  font-size: 10px;
}

.h1 {
  font-size: 16px;
  font-weight: bold;
}

.p {
  font-size: 15px;
  font-weight: 400;
}
.h1 a{
    text-decoration: none;
    color: #FFFFFF;
    padding-right: 15px;
}

.checkbox-wrapper-12 {
  position: relative;
  margin-top: 2%;
}

.checkbox-wrapper-12 > svg {
  position: absolute;
  top: -130%;
  left: -170%;
  width: 110px;
  pointer-events: none;
}

.checkbox-wrapper-12 * {
  box-sizing: border-box;
}

.checkbox-wrapper-12 input[type="checkbox"] {
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  -webkit-tap-highlight-color: transparent;
  cursor: pointer;
  margin: 0;
}

.checkbox-wrapper-12 input[type="checkbox"]:focus {
  outline: 0;
}

.checkbox-wrapper-12 .cbx {
  width: 24px;
  height: 24px;
  top: calc(100px - 12px);
  left: calc(100px - 12px);
}

.checkbox-wrapper-12 .cbx input {
  position: absolute;
  top: 0;
  left: 0;
  width: 24px;
  height: 24px;
  border: 2px solid #63d7e4;
  border-radius: 50%;
}

.checkbox-wrapper-12 .cbx label {
  width: 24px;
  height: 24px;
  background: none;
  border-radius: 50%;
  position: absolute;
  top: 0;
  left: 0;
  transform: trasnlate3d(0, 0, 0);
  pointer-events: none;
}

.checkbox-wrapper-12 .cbx svg {
  position: absolute;
  top: 5px;
  left: 4px;
  z-index: 1;
  pointer-events: none;
}

.checkbox-wrapper-12 .cbx svg path {
  stroke: #fff;
  stroke-width: 3;
  stroke-linecap: round;
  stroke-linejoin: round;
  stroke-dasharray: 19;
  stroke-dashoffset: 19;
  transition: stroke-dashoffset 0.3s ease;
  transition-delay: 0.2s;
}

.checkbox-wrapper-12 .cbx input:checked + label {
  animation: splash-12 0.6s ease forwards;
}

.checkbox-wrapper-12 .cbx input:checked + label + svg path {
  stroke-dashoffset: 0;
}

@-moz-keyframes splash-12 {
  40% {
    background: #63d7e4;
    box-shadow: 0 -18px 0 -8px #63d7e4, 16px -8px 0 -8px #63d7e4, 16px 8px 0 -8px #63d7e4, 0 18px 0 -8px #63d7e4, -16px 8px 0 -8px #63d7e4, -16px -8px 0 -8px #63d7e4;
  }

  100% {
    background: #63d7e4;
    box-shadow: 0 -36px 0 -10px transparent, 32px -16px 0 -10px transparent, 32px 16px 0 -10px transparent, 0 36px 0 -10px transparent, -32px 16px 0 -10px transparent, -32px -16px 0 -10px transparent;
  }
}

@-webkit-keyframes splash-12 {
  40% {
    background: #63d7e4;
    box-shadow: 0 -18px 0 -8px #63d7e4, 16px -8px 0 -8px #63d7e4, 16px 8px 0 -8px #63d7e4, 0 18px 0 -8px #63d7e4, -16px 8px 0 -8px #63d7e4, -16px -8px 0 -8px #63d7e4;
  }

  100% {
    background: #63d7e4;
    box-shadow: 0 -36px 0 -10px transparent, 32px -16px 0 -10px transparent, 32px 16px 0 -10px transparent, 0 36px 0 -10px transparent, -32px 16px 0 -10px transparent, -32px -16px 0 -10px transparent;
  }
}

@-o-keyframes splash-12 {
  40% {
    background: #63d7e4;
    box-shadow: 0 -18px 0 -8px #63d7e4, 16px -8px 0 -8px #63d7e4, 16px 8px 0 -8px #63d7e4, 0 18px 0 -8px #63d7e4, -16px 8px 0 -8px #63d7e4, -16px -8px 0 -8px #63d7e4;
  }

  100% {
    background: #63d7e4;
    box-shadow: 0 -36px 0 -10px transparent, 32px -16px 0 -10px transparent, 32px 16px 0 -10px transparent, 0 36px 0 -10px transparent, -32px 16px 0 -10px transparent, -32px -16px 0 -10px transparent;
  }
}

@keyframes splash-12 {
  40% {
    background: #63d7e4;
    box-shadow: 0 -18px 0 -8px #63d7e4, 16px -8px 0 -8px #63d7e4, 16px 8px 0 -8px #63d7e4, 0 18px 0 -8px #63d7e4, -16px 8px 0 -8px #63d7e4, -16px -8px 0 -8px #63d7e4;
  }

  100% {
    background: #63d7e4;
    box-shadow: 0 -36px 0 -10px transparent, 32px -16px 0 -10px transparent, 32px 16px 0 -10px transparent, 0 36px 0 -10px transparent, -32px 16px 0 -10px transparent, -32px -16px 0 -10px transparent;
  }
}

.alterar {
    height: 40px;
    border-radius: 6px;
    background-color: #72dce5;
    color: white;
    border: none;
    cursor: pointer;
}


</style>

<?php
if (isset($_SESSION['error_message'])) {
  echo "<script>
      Swal.fire({
          icon: 'success',
          title: 'Adicionado com Sucesso!',
          showConfirmButton: false,
          timer: 1800 
      }).then((result) => {
          // Redireciona para a página de visualização do produto cadastrado
          window.location.href = '#';
      });
  </script>";
  unset($_SESSION['error_message']); 
}
?>

