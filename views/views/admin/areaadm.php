<?php
    require_once '../../head.php';
    include_once '../menuinterno.php';
    require_once '../../models/conexao.php';

?>  
<!-- Script [inicio] -->
<script src="../js/modal.js"></script>
<!-- Script [fim] -->


<div class="voltar">
  <div class="meu_perfil">
  <ul>
    <li>
    <i class="fa-solid fa-arrow-left" style="margin-top: 0px; display: inline-block;"></i>
    <a href="../../index.php" style="display: inline-block; vertical-align: top;">Voltar</a>
  </ul>
  </div>
  </div>
  <div class="bem_vindo">
    <h1>Bem Vindo!</h1>
    <P>Área Administrador</P>
  </div>
<div class="container" id="i-container" >
  <div class="div1">
    <h1>Seus dados abaixo</h1>
    <br>
    <h3>User:</h3>
    <h3>Email:</h3>
    <h3>Senha:</h3>
    <br><br>
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

    <div class="acoes">
  <ul>
    <li>
    <button id="abrirModalAdicionar" title="Adicionar Curso"><i class="fa-regular fa-square-plus" style="cursor: pointer;"></i></button>
    <div id="modalAdicionar" class="modal">
        <div class="modal-content">
            <span class="fechar">&times;</span>
            <h2>Adicionar Curso</h2>
    <form action="#" id="formCurso" action="formulario_add_curso.php" method="post">
        <label for="titulo">Título do Curso:</label>
        <input type="text" id="nome_curso" name="titulo" required>
        
        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao" rows="4" required></textarea>
        
        <label for="area">Área do Curso:</label>
        <input type="text" id="areacurso" name="area" required>
       
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
        <input type="number" id="quantidadevagas" name="vagas" min="0" required>
        
        <label for="duracao">Duração:</label>
        <input type="text" id="duracao" name="duracao" required>
        
        <label for="turno">Turno:</label>
        <select id="turno" name="turno" required>
            <option value="Manhã">Manhã</option>
            <option value="Tarde">Tarde</option>
            <option value="Noite">Noite</option>
        </select>
        
        <label for="local">Local:</label>
        <input type="text" id="localidade" name="local" required>
        
        <label for="link">Link do Site:</label>
        <input type="url" id="linksite" name="link" placeholder="https://example.com" required>
        
        <label for="inicio">Início das Inscrições:</label>
        <input type="date" id="inicioinscricoes" name="inicio" required>
        
        <label for="termino">Término das Inscrições:</label>
        <input type="date" id="terminoinscricoes" name="termino" required>
         
         <label for="foto">Foto do Curso:</label>
         <input type="file" id="fotocurso" name="foto" accept="image/*">
         
        <button type="submit" class="adicionar">Adicionar</button>
    </form>
  </div>
</div>
</li>
<li>
<button id="abrirModalEditar" title="Editar Curso"><i class="fa-solid fa-user-pen" style="cursor: pointer;" title="Editar Perfil"></i></button>
    <div id="modalEditar" class="modal">
        <div class="modal-content">
            <span class="fechar">&times;</span>
            <h2>Editar Perfil</h2>
            <form id="formCurso" action="formulario_editar_adm.php" method="post">
                <label for="nome_adm">User:</label>
                <input type="text" id="nome_adm" name="user" required>
                
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" rows="4" required></input>
                
                <label for="senha">Senha:</label>
                <input type="text" id="senha" name="senha" required>

                <button type="submit" class="adicionar">Adicionar</button>
            </form>
        </div>
    </div>
</li>
    <li><a href=""><i class="fa-solid fa-arrow-right-from-bracket" title="Sair"></i></a></li>
  </ul>
</div>
    <br>
  </div>
  <div class="div2">
    <h1>Controle</h1>
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
<br>
<h1>Cursos Adicionados</h1><br>
    <div class="card">
      <h3 class="card__title"><i class="fa-solid fa-graduation-cap"></i></h3>
      <p class="card__content"><a href="cursosaddadm.php" >Veja seus cursos adicionados na plataforma aqui.</a></p>
      <div class="card__date"></div>
      <div class="card__arrow">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" height="15" width="15">
          <path fill="#fff" d="M13.4697 17.9697C13.1768 18.2626 13.1768 18.7374 13.4697 19.0303C13.7626 19.3232 14.2374 19.3232 14.5303 19.0303L20.3232 13.2374C21.0066 12.554 21.0066 11.446 20.3232 10.7626L14.5303 4.96967C14.2374 4.67678 13.7626 4.67678 13.4697 4.96967C13.1768 5.26256 13.1768 5.73744 13.4697 6.03033L18.6893 11.25H4C3.58579 11.25 3.25 11.5858 3.25 12C3.25 12.4142 3.58579 12.75 4 12.75H18.6893L13.4697 17.9697Z"></path>
        </svg>
      </div>
    </div> <!--fim card_plano-->
</div>
</div>

<br>
<br>
<?php
require_once '../../footer.php';
?>


<style>
  /*modal*/
  #abrirModalEditar,#abrirModalAdicionar {
    border: none; 
    background-color: transparent; 
    padding: 0; 
}

#abrirModalEditar,#abrirModalAdicionar i {
    padding: 8px;
    font-size: 24px; 
    color: #111; 
}
#abrirModalEditarr i:hover{
  color: #63D7E4;
}
#abrirModalAdicionai:hover{
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

/*card tipo de plano*/
.card_plano {
  margin-top: 40px;
  width: 100%;
  max-width: 300px;
  height: 85px;
  background: #63D7E4;
  border-radius: 20px;
  display: flex;
  align-items: center;
  justify-content: left;
}

.textBox {
  width: calc(100% - 70px);
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


</style>