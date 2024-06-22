<?php
require_once '../../head.php';
include_once '../menuinterno.php';
require_once '../../models/conexao.php';

// Verifica se o usuário não está logado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redireciona para a página de login
    header('Location: ../views/auth/login.php');
    exit();
}

$idAlunoLogado = $_SESSION['user_data']['id_aluno'] ?? null;

// Verifica se $idAlunoLogado está definido antes de continuar
if (!$idAlunoLogado) {
    $_SESSION['error_message'] = 'ID do aluno não encontrado.';
    header('Location: arealuno.php'); // Redirecione para onde for apropriado
    exit();
}

// Consultar dados do aluno associado ao usuário logado
$sql = "SELECT a.id_aluno, a.nome, a.data_nasc, a.sexo, a.nome_materno, a.cpf, a.email, 
               a.telefone_celular, a.telefone_fixo, a.usuario, a.cep, 
               e.logradouro, e.bairro, e.cidade, e.estado, e.num
        FROM aluno a
        LEFT JOIN endereco e ON a.cep = e.cep
        WHERE a.id_aluno = :id_aluno";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_aluno', $idAlunoLogado, PDO::PARAM_INT);
$stmt->execute();
$aluno = $stmt->fetch(PDO::FETCH_ASSOC);

// Verificar se $aluno foi encontrado antes de acessar seus dados
if (!$aluno) {
    $_SESSION['error_message'] = 'Dados do aluno não encontrados.';
    header('Location: arealuno.php'); // Redirecione para onde for apropriado
    exit();
}
// Consultar dados dos alunos associados ao usuário logado
$resultado = consultarAlunos($idAlunoLogado);
?>


<script src="../js/modal.js"></script>

<div class="voltar">
    <div class="meu_perfil">
        <ul>
            <li>
                <i class="fa-solid fa-arrow-left" style="margin-top: 0px; display: inline-block;"></i>
                <a href="../feed.php" style="display: inline-block; vertical-align: top;">Voltar</a>
            </li>
        </ul>
    </div>
</div>

<div class="bem_vindo">
    <h1>Bem Vindo!</h1>
    <p>Área do Aluno - Painel de Controle</p>
</div>

<div class="container" id="i-container">
    <div class="div1">
        <?php
        if ($resultado !== false && $resultado->rowCount() > 0) {
            // Loop para exibir cada linha de resultado
            while ($linha = $resultado->fetch(PDO::FETCH_ASSOC)) {
                echo '<h1>Seus dados abaixo</h1>';
                echo '<br>';
                echo '<p><strong>User:</strong> ' . htmlspecialchars($_SESSION['user_data']['usuario']) . '</p>';
                echo '<p><strong>Email:</strong> ' . htmlspecialchars($_SESSION['user_data']['email']) . '</p>';
                echo '<p><strong>Senha:</strong> *********</p>';
                echo '<button class="view-details" id="vermais" data-id="' . $linha['id_aluno'] . '">Ver mais';
                echo '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="4">';
                echo '<path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>';
                echo '</svg></button>';

                // Detalhes a serem exibidos ao clicar em Ver mais
                echo '<div id="details-' . $linha['id_aluno'] . '" style="display: none;">';
                echo '<div class="sub-title-form"> <p>Informações Pessoais</p></div>';
                echo '<p><strong>Nome:</strong> ' . htmlspecialchars($linha['nome']) . '</p>';
                echo '<p><strong>Data de Nascimento:</strong> ' . htmlspecialchars($linha['data_nasc']) . '</p>';
                echo '<p><strong>Sexo:</strong> ' . htmlspecialchars($linha['sexo']) . '</p>';
                echo '<p><strong>Nome da mãe:</strong> ' . htmlspecialchars($linha['nome_materno']) . '</p>';
                echo '<p><strong>CPF:</strong> ' . htmlspecialchars($linha['cpf']) . '</p>';
                echo '<p><strong>Telefone Celular:</strong> ' . htmlspecialchars($linha['telefone_celular']) . '</p>';
                echo '<p><strong>Telefone Fixo:</strong> ' . htmlspecialchars($linha['telefone_fixo']) . '</p>';
                echo '<div class="sub-title-form"> <p>Informações de endereço</p></div>';
                echo '<p><strong>CEP:</strong> ' . htmlspecialchars($linha['cep']) . '</p>';
                echo '<p><strong>Logradouro:</strong> ' . htmlspecialchars($linha['logradouro']) . '</p>';
                echo '<p><strong>Bairro:</strong> ' . htmlspecialchars($linha['bairro']) . '</p>';
                echo '<p><strong>Estado:</strong> ' . htmlspecialchars($linha['estado']) . '</p>';
                echo '<p><strong>Número:</strong> ' . htmlspecialchars($linha['num']) . '</p>';
                echo '</div>';
            }
        } else {
            echo '<p>Não há dados de alunos para exibir.</p>';
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

    <br><br>
    <div class="acoes">
    <ul>
    <li>
    <button id="abrirModalEditar" title="Editar Curso"><i class="fa-solid fa-user-pen" style="cursor: pointer;" title="Editar Perfil"></i></button>
    <div id="modalEditar" class="modal">
    <div class="modal-content">
        <span class="fechar">&times;</span>
        <h2>Editar Dados</h2>
        <form id="formCurso" action="form_editar_aluno.php" method="post">
            <input type="hidden" id="id_aluno" name="id_aluno" value="<?php echo $aluno['id_aluno']; ?>">
            
            <label for="name">Nome:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($aluno['nome']); ?>">
            
            <label for="data_nasc">Data de Nascimento:</label>
            <input type="date" id="data_nasc" name="data_nasc" value="<?php echo $aluno['data_nasc']; ?>">
            
            <label for="sexo">Sexo:</label>
            <select id="sexo" name="sexo">
                <option value="feminino" <?php echo ($aluno['sexo'] == 'feminino') ? 'selected' : ''; ?>>Feminino</option>
                <option value="masculino" <?php echo ($aluno['sexo'] == 'masculino') ? 'selected' : ''; ?>>Masculino</option>
                <option value="outro" <?php echo ($aluno['sexo'] == 'outro') ? 'selected' : ''; ?>>Outro</option>
            </select>
            
            <label for="nome_materno">Nome Materno:</label>
            <input type="text" id="nome_materno" name="nome_materno" value="<?php echo htmlspecialchars($aluno['nome_materno']); ?>">
            
            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" name="cpf" maxlength="14" value="<?php echo $aluno['cpf']; ?>">
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $aluno['email']; ?>">
            
            <label for="phone">Telefone Celular:</label>
            <input type="text" id="phone" name="phone" value="<?php echo $aluno['telefone_celular']; ?>">
            
            <label for="phone_fixed">Telefone Fixo:</label>
            <input type="text" id="phone_fixed" name="phone_fixed" value="<?php echo $aluno['telefone_fixo']; ?>">
            
            <label for="usuario">Usuário:</label>
            <input type="text" id="usuario" name="usuario" value="<?php echo $aluno['usuario']; ?>">
            
            <label for="senha">Nova senha:</label>
            <input type="password" id="senha" name="senha">
            
            <label for="cep">CEP:</label>
            <input type="text" id="cep" name="cep" maxlength="9" value="<?php echo $aluno['cep']; ?>">
             <!-- Novos campos de endereço -->
    <label for="cidade">Cidade:</label>
    <input type="text" id="cidade" name="cidade" value="<?php echo htmlspecialchars($aluno['cidade']); ?>">
    
    <label for="estado">Estado:</label>
    <input type="text" id="estado" name="estado" value="<?php echo htmlspecialchars($aluno['estado']); ?>">
    
    <label for="logradouro">Logradouro:</label>
    <input type="text" id="logradouro" name="logradouro" value="<?php echo htmlspecialchars($aluno['logradouro']); ?>">
    
    <label for="bairro">Bairro:</label>
    <input type="text" id="bairro" name="bairro" value="<?php echo htmlspecialchars($aluno['bairro']); ?>">
    <label for="num">Número:</label>
    <input type="text" id="num" name="num" value="<?php echo htmlspecialchars($aluno['num']); ?>">
            
            <button type="submit" class="alterar">Salvar</button>
        </form>
    </div>
</div>
<script>    // Abrir o modal de editar perfil
    var abrirModalEditar = document.getElementById('abrirModalEditar');
    if (abrirModalEditar) {
        abrirModalEditar.addEventListener('click', function() {
            var modalEditar = document.getElementById('modalEditar');
            if (modalEditar) {
                modalEditar.style.display = 'block';
            }
        });
    }

    // Fechar o modal de editar perfil
    var modalEditar = document.getElementById('modalEditar');
    if (modalEditar) {
        var fecharEditar = modalEditar.getElementsByClassName('fechar')[0];
        if (fecharEditar) {
            fecharEditar.addEventListener('click', function() {
                modalEditar.style.display = 'none';
            });
        }

        // Fechar o modal de editar perfil se o usuário clicar fora dele
        window.addEventListener('click', function(event) {
            if (event.target == modalEditar) {
                modalEditar.style.display = 'none';
            }
        });
    }

    // Função para formatar telefone celular
    document.getElementById('phone').addEventListener('input', function (e) {
        var x = e.target.value.replace(/\D/g, '').match(/(\d{2})(\d{5})(\d{4})/);
        if (x) {
            e.target.value = '+55(' + x[1] + ')' + x[2] + '-' + x[3];
        }
    });

    // Função para formatar telefone fixo
    document.getElementById('phone_fixed').addEventListener('input', function (e) {
        var x = e.target.value.replace(/\D/g, '').match(/(\d{2})(\d{4})(\d{4})/);
        if (x) {
            e.target.value = '+55(' + x[1] + ')' + x[2] + '-' + x[3];
        }
    });

    // Função para formatar CPF
    document.getElementById('cpf').addEventListener('input', function (e) {
        var x = e.target.value.replace(/\D/g, '').match(/(\d{3})(\d{3})(\d{3})(\d{2})/);
        if (x) {
            e.target.value = x[1] + '.' + x[2] + '.' + x[3] + '-' + x[4];
        }
    });

    document.getElementById('cep').addEventListener('blur', function (e) {
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

    // Função para atualizar dados
    function updateData() {
        var formData = new FormData(document.getElementById('editForm'));
        fetch('update_student.php', {
            method: 'POST',
            body: formData
        }).then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Dados atualizados com sucesso!');
                modalEditar.style.display = "none";
            } else {
                alert('Erro ao atualizar dados!');
            }
        })
        .catch(error => {
            console.error('Erro ao atualizar dados:', error);
            alert('Erro ao atualizar dados!');
        });
    }</script>
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
.sub-title-form{
    font-weight: bold;
    color: #007f9c;
    margin-top: 3%;
    margin-bottom: 1%;
}
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
.alterar {
    height: 40px;
    border-radius: 6px;
    background-color: #72dce5;
    color: white;
    border: none;
    cursor: pointer;
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
#vermais {
  padding: 0;
  margin: 0;
  border: none;
  background: none;
  cursor: pointer;
  margin-top: 6%;
  margin-bottom: 7%;
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

#bnt-sair{
  width: 19%;
}

</style>