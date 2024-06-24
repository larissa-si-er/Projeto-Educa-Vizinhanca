<?php
require_once '../../head.php';
include_once '../menuinterno.php';
require_once '../../models/conexao.php'; 
include '../render/renderModal.php'; 

// Verifica se o usuário não está logado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../views/auth/login.php');
    exit();
}

$tipoUsuario = $_SESSION['user_type'];  // Tipo de usuário logado
$nomeInstituicao = $_SESSION['user_data']['nome_insti'];  // Nome da instituição logada
$idInstituicaoLogado = $_SESSION['user_data']['id_instituicao'] ?? null;  // ID da instituição logada

// Verifica se $idInstituicaoLogado está definido antes de continuar
if (!$idInstituicaoLogado) {
    $_SESSION['error_message'] = 'ID da instituição não encontrado.';
    header('Location: areainstituicao.php');  // Redireciona para a área apropriada
    exit();
}

// Consulta dados da instituição associada ao usuário logado
$sql = "SELECT id_instituicao, nome_insti, email, data_fundacao, cnpj, telefone_celular, telefone_fixo, cep, usuario, senha
        FROM instituicao
        WHERE id_instituicao = :id_instituicao";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_instituicao', $idInstituicaoLogado, PDO::PARAM_INT);
$stmt->execute();
$instituicao = $stmt->fetch(PDO::FETCH_ASSOC);

// Verificar se $instituicao foi encontrado antes de acessar seus dados
if (!$instituicao) {
    $_SESSION['error_message'] = 'Dados da instituição não encontrados.';
    header('Location: areainstituicao.php');  // Redireciona para a área apropriada
    exit();
}


// Consultar dados da instituição associada ao usuário logado
$resultado = consultarInsti($idInstituicaoLogado);

?>

<script src="../js/modal.js"></script>
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
    <P>Área Instituição - Painel de controle</P>
  </div>
<div class="container" id="i-container" >
<div class="div1">
        <?php
        if ($resultado !== false && $resultado->rowCount() > 0) {
            // Loop para exibir cada linha de resultado
            while ($linha = $resultado->fetch(PDO::FETCH_ASSOC)) {
                echo '<h1>Seus dados abaixo</h1>';
                echo '<br>';
                echo '<p><strong>User:</strong> ' . htmlspecialchars($linha['usuario']) . '</p>';
                echo '<p><strong>Email:</strong> ' . htmlspecialchars($linha['email']) . '</p>';
                echo '<p><strong>Senha:</strong> *********</p>';
                echo '<button class="view-details" id="vermais" data-id="' . $linha['id_instituicao'] . '">Ver mais';
                echo '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="4">';
                echo '<path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>';
                echo '</svg></button>';

                // Detalhes a serem exibidos ao clicar em Ver mais
                echo '<br>';
                echo '<div id="details-' . $linha['id_instituicao'] . '" style="display: none;">';
                echo '<div class="sub-title-form"> <p>Informações Pessoais</p></div>';
                echo '<p><strong>Instituição:</strong> ' . htmlspecialchars($linha['nome_insti']) . '</p>';
                echo '<p><strong>Fundada:</strong> ' . htmlspecialchars($linha['data_fundacao']) . '</p>';
                echo '<p><strong>CNPJ:</strong> ' . htmlspecialchars($linha['cnpj']) . '</p>';
                echo '<p><strong>Telefone Celular:</strong> ' . htmlspecialchars($linha['telefone_celular']) . '</p>';
                echo '<p><strong>Telefone Fixo:</strong> ' . htmlspecialchars($linha['telefone_fixo']) . '</p>';
                echo '<div class="sub-title-form"> <p>Informações de endereço</p></div>';
                echo '<p><strong>CEP:</strong> ' . htmlspecialchars($linha['cep']) . '</p>';
                echo '<p><strong>Logradouro:</strong> ' . htmlspecialchars($linha['logradouro']) . '</p>';
                echo '<p><strong>Bairro:</strong> ' . htmlspecialchars($linha['bairro']) . '</p>';
                echo '<p><strong>Estado:</strong> ' . htmlspecialchars($linha['estado']) . '</p>';
                echo '<p><strong>Número:</strong> ' . htmlspecialchars($linha['num']) . '</p>';
                echo '<br>';
                echo '</div>';
            }
        } else {
            echo '<p>Não há dados de Instituições para exibir.</p>';
        }
        ?>



<!-- Script JavaScript -->
<script>
function addViewDetailsEvent() {
    document.querySelectorAll('.view-details').forEach(function(button) {
        button.addEventListener('click', function() {
            var id = this.getAttribute('data-id');
            var details = document.getElementById('details-' + id);
            if (details.style.display === 'none' || details.style.display === '') {
                details.style.display = 'block'; // Alterado para 'block' para exibir corretamente
            } else {
                details.style.display = 'none';
            }
        });
    });
}

// Chame a função para adicionar o evento ao carregar a página
document.addEventListener('DOMContentLoaded', addViewDetailsEvent);
</script>
    <div class="acoes">
  <ul>
    <li> 
      <button id="abrirModalAdicionar" title="Adicionar Curso"><i class="fa-regular fa-square-plus" style="cursor: pointer;"></i></button>
    <?php renderizarModalAdicionarCurso($tipoUsuario, $nomeInstituicao); ?>


</li>

    <li>
    <button id="abrirModalEditar" title="Editar Curso"><i class="fa-solid fa-user-pen" style="cursor: pointer;" title="Editar Perfil"></i></button>
    <div id="modalEditar" class="modal">
        <div class="modal-content">
            <span class="fechar">&times;</span>
            <h2>Editar Perfil</h2>
            <form id="formInstituicao" action="form_editar_insti.php" method="post">
    <input type="hidden" id="id_instituicao" name="id_instituicao" value="<?php echo htmlspecialchars($instituicao['id_instituicao']); ?>">

    <label for="nome_insti">Nome Instituição:</label>
    <input type="text" id="nome_insti" name="nome_insti" value="<?php echo htmlspecialchars($instituicao['nome_insti']); ?>">

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($instituicao['email']); ?>">

    <label for="data_fundacao">Data de Fundação:</label>
    <input type="date" id="data_fundacao" name="data_fundacao" value="<?php echo htmlspecialchars($instituicao['data_fundacao']); ?>">

    <label for="cnpj">CNPJ:</label>
    <input type="text" id="cnpj" name="cnpj" maxlength="18" value="<?php echo htmlspecialchars($instituicao['cnpj']); ?>">

    <label for="telefone_celular">Telefone Celular:</label>
    <input type="text" id="telefone_celular" name="telefone_celular" value="<?php echo htmlspecialchars($instituicao['telefone_celular']); ?>">

    <label for="telefone_fixo">Telefone Fixo:</label>
    <input type="text" id="telefone_fixo" name="telefone_fixo" value="<?php echo htmlspecialchars($instituicao['telefone_fixo']); ?>">

    <label for="cep">CEP:</label>
    <input type="text" id="cep" name="cep" maxlength="9" value="<?php echo htmlspecialchars($instituicao['cep']); ?>">

    <label for="usuario">Usuário:</label>
    <input type="text" id="usuario" name="usuario" value="<?php echo htmlspecialchars($instituicao['usuario']); ?>">

    <label for="senha">Nova senha:</label>
    <input type="password" id="senha" name="senha">

    <button type="submit" class="alterar">Salvar</button>
            </form>

        </div>
        <script>//modal editar perfil
document.addEventListener('DOMContentLoaded', function() {
    var abrirModalEditar = document.getElementById('abrirModalEditar');
    console.log('abrirModalEditar:', abrirModalEditar);
    if (abrirModalEditar) {
        abrirModalEditar.addEventListener('click', function() {
            var modalEditar = document.getElementById('modalEditar');
            console.log('modalEditar:', modalEditar);
            if (modalEditar) {
                modalEditar.style.display = 'block';
            }
        });
    }

    var modalEditar = document.getElementById('modalEditar');
    console.log('modalEditar:', modalEditar);
    if (modalEditar) {
        var fecharEditar = modalEditar.getElementsByClassName('fechar')[0];
        console.log('fecharEditar:', fecharEditar);
        if (fecharEditar) {
            fecharEditar.addEventListener('click', function() {
                modalEditar.style.display = 'none';
            });
        }

        window.addEventListener('click', function(event) {
            if (event.target == modalEditar) {
                modalEditar.style.display = 'none';
            }
        });
    }

    var phoneInput = document.getElementById('phone');
    console.log('phoneInput:', phoneInput);
    if (phoneInput) {
        phoneInput.addEventListener('input', function (e) {
            var x = e.target.value.replace(/\D/g, '').match(/(\d{2})(\d{5})(\d{4})/);
            if (x) {
                e.target.value = '+55(' + x[1] + ')' + x[2] + '-' + x[3];
            }
        });
    }

    var phoneFixedInput = document.getElementById('phone_fixed');
    console.log('phoneFixedInput:', phoneFixedInput);
    if (phoneFixedInput) {
        phoneFixedInput.addEventListener('input', function (e) {
            var x = e.target.value.replace(/\D/g, '').match(/(\d{2})(\d{4})(\d{4})/);
            if (x) {
                e.target.value = '+55(' + x[1] + ')' + x[2] + '-' + x[3];
            }
        });
    }

    var cpfInput = document.getElementById('cpf');
    console.log('cpfInput:', cpfInput);
    if (cpfInput) {
        cpfInput.addEventListener('input', function (e) {
            var x = e.target.value.replace(/\D/g, '').match(/(\d{3})(\d{3})(\d{3})(\d{2})/);
            if (x) {
                e.target.value = x[1] + '.' + x[2] + '.' + x[3] + '-' + x[4];
            }
        });
    }

    var cepInput = document.getElementById('cep');
    console.log('cepInput:', cepInput);
    if (cepInput) {
        cepInput.addEventListener('blur', function (e) {
            var cep = e.target.value.replace(/\D/g, '');
            if (cep.length === 8) {
                fetch(`https://viacep.com.br/ws/${cep}/json/`)
                    .then(response => response.json())
                    .then(data => {
                        if (!data.erro) {
                            document.getElementById('logradouro').value = data.logradouro;
                            document.getElementById('bairro').value = data.bairro;
                            document.getElementById('cidade').value = data.localidade;
                            document.getElementById('estado').value = data.uf;
                        } else {
                            alert('CEP não encontrado!');
                        }
                    })
                    .catch(error => {
                        console.error('Erro ao buscar o CEP:', error);
                        alert('Erro ao buscar o CEP!');
                    });
            } else {
                alert('CEP inválido!');
            }
        });
    }
});</script>
    </div>
    <li><form action="../../controllers/userController.php" method="post">
          <input type="hidden" name="logout">
          <button type="submit" style="background-color: transparent; border:none;"><i class="fa-solid fa-arrow-right-from-bracket"></i></button>
        </form>
    </li>
  </ul>
</div>
    <br>
  </div>
  <div class="div2">
    <h1>Cursos Adicionados</h1><br>
    <div class="card">
      <h3 class="card__title"><i class="fa-solid fa-graduation-cap"></i></h3>
      <p class="card__content"><a href="cursosaddinsti.php" >Veja seus cursos adicionados na plataforma aqui.</a></p>
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
  .sub-title-form{
    font-weight: bold;
    color: #007f9c;
    margin-top: 3%;
    margin-bottom: 1%;
}
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
  input[type="email"],
  input[type="password"],
  select,
  textarea {
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
  }
  
  input[type="url"] {
      width: calc(100% - 24px); 
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
.alterar {
    height: 40px;
    border-radius: 6px;
    background-color: #72dce5;
    color: white;
    border: none;
    cursor: pointer;
}
.adicionar:hover, .add-img-curso:hover{
    -webkit-box-shadow: 0px 0px 2px 3px rgba(0, 45, 246, 0.1); 
    box-shadow: 0px 0px 2px 3px rgba(0, 68, 151, 0.146);
}
/*fim modal*/ 
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
  width: calc(100% - 90px);
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