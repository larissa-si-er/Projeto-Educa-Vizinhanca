<?php
    require_once '../../head.php';
    include_once '../menuinterno.php';
    require_once '../../models/conexao.php';
?>  
<script src="../js/modal.js"></script>


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
    <P>Área do Aluno</P>
  </div>
<div class="container" id="i-container" >
  <div class="div1">
    <h1>Seus dados abaixo</h1>
    <br>
    <h3>Nome:</h3>
    <h3>Data de nascimento:</h3>
    <h3>Telefone Celular:</h3>
    <h3>Telefone Fixo:</h3>
    <h3>Endereço:</h3>
    <h3>CEP:</h3>
    <h3>Email:</h3>
    <h3>Senha:</h3>
    <br><br>
    <div class="acoes">
    <ul>
    <li>
    <button id="abrirModalEditar" title="Editar Curso"><i class="fa-solid fa-user-pen" style="cursor: pointer;" title="Editar Perfil"></i></button>
    <div id="modalEditar" class="modal">
        <div class="modal-content">
            <span class="fechar">&times;</span>
            <h2>Editar Perfil</h2>
            <form id="formCurso" action="formulario_editar_adm.php" method="post">
                <label for="nome_aluno">Nome:</label>
                <input type="text" id="nome_adm" name="user" required>
                
                <label for="nome_aluno">Login:</label>
                <input type="text" id="nome_adm" name="user" required>

                <label for="nome_aluno">Data de nascimento:</label>
                <input type="text" id="nome_adm" name="user" required>

                <label for="sexo">Sexo:</label>
                  <select id="sexo" name="sexo" required>
                    <option value="Feminino">Feminino</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Outro">Outro</option>
                   </select>
                
                <label for="nome_aluno">Nome Materno:</label>
                <input type="text" id="nome_adm" name="user" required>

                <label for="telefone_fixo">Telefone Fixo:</label>
                <input type="text" id="telefone_fixo" name="telefone" required>

                <label for="telefone_fixo">Telefone Celular:</label>
                <input type="text" id="telefone_fixo" name="telefone" required>
                
                <label for="endereco">Endereço:</label>
                <input type="text" id="endereco" name="endereco" required>

                <label for="cnpj">CNPJ:</label>
                <input type="text" id="cnpj" name="cnpj" required>

                <label for="cnpj">CEP:</label>
                <input type="text" id="cep" name="cep" required>

                <label for="nome_aluno">Complemento:</label>
                <input type="text" id="nome_adm" name="user" required>

                <label for="nome_aluno">Número Casa:</label>
                <input type="text" id="nome_adm" name="user" required>

                <label for="email">Email:</label>
                <input type="text" id="email" name="email"  required></input>
                
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
    <h1>Favoritos</h1><br>
    <div class="card">
      <h3 class="card__title"><i class="fa-solid fa-graduation-cap"></i></h3>
      <p class="card__content"><a href="favoritosaluno.php">Veja seus cursos de interesse na plataforma aqui.</a></p>
      <div class="card__date"></div>
      <div class="card__arrow">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" height="15" width="15">
          <path fill="#fff" d="M13.4697 17.9697C13.1768 18.2626 13.1768 18.7374 13.4697 19.0303C13.7626 19.3232 14.2374 19.3232 14.5303 19.0303L20.3232 13.2374C21.0066 12.554 21.0066 11.446 20.3232 10.7626L14.5303 4.96967C14.2374 4.67678 13.7626 4.67678 13.4697 4.96967C13.1768 5.26256 13.1768 5.73744 13.4697 6.03033L18.6893 11.25H4C3.58579 11.25 3.25 11.5858 3.25 12C3.25 12.4142 3.58579 12.75 4 12.75H18.6893L13.4697 17.9697Z"></path>
        </svg>
      </div>
    </div>
</div>
</div>
<br>
<br>
<?php
require_once '../../footer.php';
?>



<style>
/*modal*/
  #abrirModalEditar {
    border: none; 
    background-color: transparent; 
    padding: 0; 
}

#abrirModalEditar i {
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
  margin-right: 100px; 
  
}

.meu_perfil li:meu_perfil {
  margin-right: 0; 
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

.card .card__content {
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


</style>