<?php
// require '../controllers/userController.php'; 
include '../controllers/curso_control.php'; 
// include '../controllers/feedController.php';
?>

<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../views/auth/login.php');
    exit();
}

if ($_SESSION['user_type'] === 'administracao') {
    $_SESSION['first_name'] = 'Adm';
} 

$primeiroNome = $_SESSION['first_name'] ?? '';

function getSettingsLink($userType) {
    switch ($userType) {
        case 'administracao':
            return './admin/areaadm.php';
        case 'aluno':
            return './aluno/areaaluno.php';
        case 'instituicao':
            return './instituicao/areainsti.php';
        default:
            return '#'; 
    }
}

// Recuperar todos os cursos do banco de dados
$sql = "SELECT id_curso, nome_curso, fotocurso, areacurso, localidade, linksite, formato FROM curso";
$stmt = $conn->query($sql);
$cursos = $stmt->fetchAll(PDO::FETCH_ASSOC);



// var_dump($_SESSION);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="./img/home-ic.png">
    <title>Feed de Cursos</title>
    <script src="./js/menu.js"></script>
    <link rel="stylesheet" href="./css/testando.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- icones -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<body>
    <main>

        <header>
            <nav>
                <div class="nav-bar">
                    <i class="bi bi-list sidebarOpen"></i>
                    
                    <span class="logo"><a href=""><img src="./img/Home-removebg-preview.png" alt=""></a></span>

                    <div class="group">
                        <i class="fa-solid fa-magnifying-glass" id="search"></i>
                        <input placeholder="Busque aqui seus cursos no site." type="search" class="input">
                    </div>

                    <div class="block-user">
                        <i class="bi bi-x sidebarClose"></i>
                            <ul class="user-ul" onclick="openModal()">
                                <li class="user-li">
                                    <p id="user">
                                        <i class="fas fa-user-circle"></i>
                                        <!-- Usuário -->
                                        <?php echo htmlspecialchars($primeiroNome) ?? 'adm'; ?> 
                                        <i class="bi bi-chevron-down" style="cursor:pointer;"></i>
                                    </p>
                                </li>
                            </ul>
                    </div>
                    <!-- Modal -->
                    <div id="myModal" class="modal-user">
                        <span class="close closePerfil" onclick="closeModal()">&times;</span>
                        <div class="modal-content-user">
                            <?php

                            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && isset($_SESSION['user_data'])) {
                                $user = $_SESSION['user_data'];
                                echo '<p><strong>Tipo de usuário:</strong> ' . htmlspecialchars($_SESSION['user_type']) . '</p>';
                                echo '<p><strong>User:</strong> ' . htmlspecialchars($user['usuario']) . '</p>';
                                echo '<p><strong>Email:</strong> ' . htmlspecialchars($user['email']) . '</p>';
                                echo '<p><strong>Senha:</strong> *********</p>';
                            } else {
                                echo '<p><strong>User:</strong> Não logado</p>';
                                echo '<p><strong>Email:</strong> Não logado</p>';
                            }
                            ?>
                            <p>
                                <!-- Botão para acessar o perfil -->
                                <button id="bnt-user">
                                <?php
                                // Defina o link com base no tipo de usuário
                                switch ($_SESSION['user_type']) {
                                   case 'administracao':
                                      echo '<a href="./admin/areaadm.php">Meu perfil</a>';
                                      break;
                                   case 'aluno':
                                      echo '<a href="./aluno/areaaluno.php">Meu perfil</a>';
                                      break;
                                   case 'instituicao':
                                      echo '<a href="./instituicao/areainsti.php">Meu perfil</a>';
                                      break;
                                   default:
                                      echo '<a href="#">Meu perfil</a>'; // Pode adicionar um link padrão ou tratar outro caso
                                      break;
                                }
                                ?>
                                </button>
                                <!-- Formulário para realizar o logout -->
                                <form action="../controllers/userController.php" method="post">
                                    <input type="hidden" name="logout">
                                    <button type="submit" id="bnt-sair">Sair</button>
                                </form>
                            </p>
                        </div>
                    </div>



                    <div class="user-mobile">
                       <i class="bi bi-person-square"></i>
                    </div>
                </div>
               
               <div class="menu-geral">

                    <div class="menu">
                            <i class="bi bi-x sidebarClose"></i>

                            <ul class="nav-links">
                                        <li>
                                            <a>
                                            <i class="bi bi-sliders2" id="filter-icon" style="cursor: pointer;"></i><span>Filtro</span>
                                           </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo getSettingsLink($_SESSION['user_type']); ?>" title="Controle">
                                                <i class="bi bi-bar-chart-line-fill"></i><span>Configurações</span>
                                            </a>
                                        </li>
                                        <li>
                                            <!-- <a href="./produtos-interno.php">  -->
                                            <a href="./produtos.php"> 
                                               <i class="bi bi-handbag-fill"></i>
                                               Produtos
                                            </a>
                                        </li>
                            </ul>
                    </div>
                </div>
                      
            </nav>

      

            <div id="filter-modal" class="modal-filter">
                <div class="modal-content">
                    <span class="close closeFilter">&times;</span>
                    <h3><i class="bi bi-sliders2"></i> Filtro</h3>
                    <label for="area-select">Selecione a área:</label>
                    <select id="area-select">
                        <option value="todos">Todos</option>
                        <option value="desenvolvimento-web">Desenvolvimento Web</option>
                        <option value="desenvolvimento-ti">Desenvolvimento T.I</option>
                        <option value="marketing">Marketing</option>
                        <option value="direito">Direito</option>
                        <option value="empreendedorismo">Empreendedorismo</option>
                        <option value="pedagogia">Pedagogia</option>
                    </select>

                    <label for="modalidade-select">Selecione a modalidade:</label>
                    <select id="modalidade-select">
                        <option value="todos">Todos</option>
                        <option value="online">Online</option>
                        <option value="presencial">Presencial</option>
                    </select>

                    <label for="regiao-select">Selecione a região:</label>
                    <select id="regiao-select">
                        <option value="todos">Todos</option>
                        <option value="rj">RJ</option>
                        <option value="sp">SP</option>
                        <option value="mg">MG</option>
                        <!-- Adicione mais opções conforme necessário -->
                    </select>
                    <button id="filter-button">Filtrar</button>
                    <div class="no-results">Nenhum curso encontrado.</div>
                </div>
            </div>
       </header>
<br>


<!-- BODY [INICIO] -->
<div class="fundo_tela-interna">
    <div class="title-main">
        <img src="./img/gif-main.gif" alt="" srcset="">
    </div>
</div>

<!-- BOTOES ACESSIBILIDADE E SETA [inicio]-->
       <div class="div-acess-bt"><button class="acess-bt"><i class="fa-solid fa-universal-access"></i></button></div>

        <!-- conteudo acessibilidade -->
        <div class="acess-window"><div class="window-point"></div><small>Janela de acessibilidade.</small>
            <div class="moreorless">
                <button class="more" onclick="aumentarTexto()"><span class="material-symbols-outlined">
                    text_increase
                    </span>
                </button>
                <button class="less" onclick="diminuirTexto()">
                    <span class="material-symbols-outlined">
                        text_decrease
                        </span>
                </button>
            </div>
            <div class="dk_mode">
                <label class="tema-check" for="checkbox" id="themeswitch">
                    <input type="checkbox" class="input-dark-mode" id="checkbox">
                    <div class="slider round"></div>
                    <span class="name"></span>
                    <div class="back"></div>
                </label>
            </div>
        </div>
        <script src="../views/js/script.js"></script>

        <a href="#" class="seta" ><i class="bi bi-arrow-up-circle-fill"></i></a>
        <script src="../views/js/seta.js"></script>
<!-- BOTOES ACESSIBILIDADE E SETA [fim]-->


<div class="container-top">
        <div class="card-top">
            <div class="card-top1 star1">
                <img src="./img/1.png" alt="" srcset="" class="img-top1">
                <img class="pic-card-tops" src="./img/img curso 1.png" alt="Curso HTML e CSS">
                <div class="curso-content content-cardTop">
                    <h2>Curso de HTML e CSS</h2>
                    <p>Instituição: Curso em vídeo
                    Aprenda HTML e CSS do básico ao avançado.</p>
                </div>
            </div>
        </div>
        <div class="card-top2">
            <img src="./img/2.png" alt="" srcset="" class="img-top2">
            <img class="pic-card-tops" src="./img/imagem curso 2.png" alt="Curso JavaScript">
            <div class="curso-content content-cardTop">
                <h2>Curso de JavaScript</h2>
                <p>Instituição: Alura
                Domine JavaScript e crie aplicações web interativas.</p>
            </div>
        </div>
        <div class="card-top3">
            <img src="./img/3.png" alt="" srcset="" class="img-top3">
            <img class="pic-card-tops" src="./img/imagem curso 3.png" alt="Curso Python">
            <div class="curso-content content-cardTop">
                <h2>Curso de Python</h2>
                <p>Instituição: XPE <br>                                   
                 Aprenda Python para análise de dados e desenvolvimento web.</p>
            </div>
        </div>
</div>

<br>
<br>
<br>

<div class="container">
             
        <div class="curso" id="curso-list"  data-curso-id="1" data-area="desenvolvimento-web" data-regiao="sp">
             <?php if ($_SESSION['user_type'] === 'administracao' || $_SESSION['user_type'] === 'instituicao'): ?>
             <!-- BOTAO DE CONTROLE DO CURSO PARA ADMIN -->
                   <div class="control-config" onclick="toggleMenu(this)">
                      <i class="bi bi-three-dots"></i>
                      <div class="dropdown-menu" id="dropdownMenu">
                            <a href="#editar" class="editar">Editar <i class="bi bi-pencil-square"></i></a>
                            <a href=""  onclick="confirmDelete(<?php echo $curso['id_curso']; ?>)"class="delet">Deletar <i class="bi bi-trash3-fill"></i></a>
                            <a href="#outra-acao" class="outro">Outra ação</a>
                      </div>
                   </div>
             <!-- FIM BOTAO DE CONTROLE DO CURSO PARA ADMIN -->
             <?php endif; ?>

                <img src="./img/imagem curso 4.png" alt="Curso HTML e CSS" class="curso-img">
                    <h2>Desenvolvimentode Jogos</h2>
                  <p>Área: Desenvolvimento T.I</P>
                  <div class="curso-content">
            <p class="instituicao"><i class="bi bi-building"></i>Instituição: CDPI</p>
            <p class="localizacao"><i class="bi bi-laptop"></i>Modalidade: Online</p>
            <div class="curso-buttons">
                <a href="https://cpdi.org.br/projeto/alem-de-jogar-eu-faco-jogos/"target="_blank" class="botao-acessar">Acessar</a>
                <i class="fa-regular fa-thumbs-up botao-curtir" title="curtir"></i>
                <i class="fa-regular fa-comment-dots botao-comentar" title="comentar"></i>
                <i class="fa-regular fa-bookmark botao-salvar" title="salvar"></i>
                <i class="fa-solid fa-share botao-compartilhar" title="compartilhar"></i>
            </div>
        </div>
        </div>

       <div class="curso" id="curso-list" data-area="marketing" data-regiao="rj">
          <?php if ($_SESSION['user_type'] === 'administracao' || $_SESSION['user_type'] === 'instituicao'): ?>
          <!-- BOTAO DE CONTROLE DO CURSO PARA ADMIN -->
                   <div class="control-config" onclick="toggleMenu(this)">
                      <i class="bi bi-three-dots"></i>
                      <div class="dropdown-menu" id="dropdownMenu">
                            <a href="#editar" class="editar">Editar <i class="bi bi-pencil-square"></i></a>
                            <a href="#deletar" class="delet">Deletar <i class="bi bi-trash3-fill"></i></a>
                            <a href="#outra-acao" class="outro">Outra ação</a>
                      </div>
                   </div>
             <!-- FIM BOTAO DE CONTROLE DO CURSO PARA ADMIN -->
             <?php endif; ?>
            <img src="./img/imagem curso 5.png" alt="Curso HTML e CSS" class="curso-img">
            <h2>Marketing Digital</h2>
            <p>Área: Marketing</p>
            <div class="curso-content">
            <p class="instituicao"><i class="bi bi-building"></i>Instituição: SEBRAE</p>
            <p class="localizacao"><i class="bi bi-laptop"></i>Modalidade: Online</p>
            <div class="curso-buttons">
                <a href="https://sebrae.com.br/sites/PortalSebrae/cursosonline/marketing-digital-para-sua-empresa-equipe-comercial,12e7125576a4e710VgnVCM100000d701210aRCRD"target="_blank" class="botao-acessar">Acessar</a>
                <i class="fa-regular fa-thumbs-up botao-curtir" title="curtir" data-id-aluno="1" data-id-curso="1"></i>
                <i class="fa-regular fa-comment-dots botao-comentar" title="comentar"></i>
                <i class="fa-regular fa-bookmark botao-salvar" title="salvar"></i>
                <i class="fa-solid fa-share botao-compartilhar" title="compartilhar"></i>
            </div>
        </div>
        </div>
        

        <div class="curso" id="curso-list" data-area="direito" data-regiao="mg">
            <?php if ($_SESSION['user_type'] === 'administracao' || $_SESSION['user_type'] === 'instituicao'): ?>
             <!-- BOTAO DE CONTROLE DO CURSO PARA ADMIN -->
                   <div class="control-config" onclick="toggleMenu(this)">
                      <i class="bi bi-three-dots"></i>
                      <div class="dropdown-menu" id="dropdownMenu">
                            <a href="#editar" class="editar">Editar <i class="bi bi-pencil-square"></i></a>
                            <a href="#deletar" class="delet">Deletar <i class="bi bi-trash3-fill"></i></a>
                            <a href="#outra-acao" class="outro">Outra ação</a>
                      </div>
                   </div>
             <!-- FIM BOTAO DE CONTROLE DO CURSO PARA ADMIN -->
             <?php endif; ?>
                    <img src="./img/imagem curso 6.png" alt="Curso HTML e CSS" class="curso-img">
                    <h2>Legislação e Negócios no Audiovisual</h2>
            <p>Área: Direito</p>
            <div class="curso-content">
            <p class="instituicao"><i class="bi bi-building"></i>Instituição: SEBRAE</p>
            <p class="localizacao"><i class="bi bi-laptop"></i>Modalidade: Online</p>
            <div class="curso-buttons">
                <a href="https://sebrae.com.br/sites/PortalSebrae/cursosonline/legislacao-e-negocios,20d5baa60fd5d710VgnVCM100000d701210aRCRD"target="_blank" class="botao-acessar">Acessar</a>
                <i class="fa-regular fa-thumbs-up botao-curtir" title="curtir"></i>
                <i class="fa-regular fa-comment-dots botao-comentar" title="comentar"></i>
                <i class="fa-regular fa-bookmark botao-salvar" title="salvar"></i>
                <i class="fa-solid fa-share botao-compartilhar" title="compartilhar"></i>
            </div>
        </div>
        </div>
                

        <div class="curso" id="curso-list" data-area="marketing" data-regiao="sp">
            <?php if ($_SESSION['user_type'] === 'administracao' || $_SESSION['user_type'] === 'instituicao'): ?>
             <!-- BOTAO DE CONTROLE DO CURSO PARA ADMIN -->
                   <div class="control-config" onclick="toggleMenu(this)">
                      <i class="bi bi-three-dots"></i>
                      <div class="dropdown-menu" id="dropdownMenu">
                            <a href="#editar" class="editar">Editar <i class="bi bi-pencil-square"></i></a>
                            <a href="#deletar" class="delet">Deletar <i class="bi bi-trash3-fill"></i></a>
                            <a href="#outra-acao" class="outro">Outra ação</a>
                      </div>
                   </div>
             <!-- FIM BOTAO DE CONTROLE DO CURSO PARA ADMIN -->
             <?php endif; ?>
                <img src="./img/imagem 7.png" alt="Curso HTML e CSS" class="curso-img">
                    <h2>Preço de Vendas para Beleza</h2>
            <p>Área: Empreendedorismo e  Estética</p>
            <div class="curso-content">
            <p class="instituicao"><i class="bi bi-building"></i>Instituição: SEBRAE</p>
            <p class="localizacao"><i class="bi bi-laptop"></i>Modalidade: Online</p>
            <div class="curso-buttons">
                <a href="https://sebrae.com.br/sites/PortalSebrae/cursosonline/preco-de-vendas-para-beleza,85bb36435d608810VgnVCM1000001b00320aRCRD"target="_blank" class="botao-acessar">Acessar</a>
                <i class="fa-regular fa-thumbs-up botao-curtir" title="curtir"></i>
                <i class="fa-regular fa-comment-dots botao-comentar" title="comentar"></i>
                <i class="fa-regular fa-bookmark botao-salvar" title="salvar"></i>
                <i class="fa-solid fa-share botao-compartilhar" title="compartilhar"></i>
            </div>
        </div>
        </div>
        
        <div class="curso" id="curso-list" data-area="marketing" data-regiao="rj">
            <?php if ($_SESSION['user_type'] === 'administracao' || $_SESSION['user_type'] === 'instituicao'): ?>
             <!-- BOTAO DE CONTROLE DO CURSO PARA ADMIN -->
                   <div class="control-config" onclick="toggleMenu(this)">
                      <i class="bi bi-three-dots"></i>
                      <div class="dropdown-menu" id="dropdownMenu">
                            <a href="#editar" class="editar">Editar <i class="bi bi-pencil-square"></i></a>
                            <a href="#deletar" class="delet">Deletar <i class="bi bi-trash3-fill"></i></a>
                            <a href="#outra-acao" class="outro">Outra ação</a>
                      </div>
                   </div>
             <!-- FIM BOTAO DE CONTROLE DO CURSO PARA ADMIN -->
             <?php endif; ?>
                <img src="./img/imagem curso 8.png" alt="Curso HTML e CSS" class="curso-img">
                    <h2>Volte a Empreender!</h2>
            <p>Área: Empreendedorismo</p>
            <div class="curso-content">
            <p class="instituicao"><i class="bi bi-building"></i>Instituição: SEBRAE</p>
            <p class="localizacao"><i class="bi bi-laptop"></i>Modalidade: Online</p>
            <div class="curso-buttons">
                <a href="https://sebrae.com.br/sites/PortalSebrae/cursosonline/volte-a-empreender,67b2adea33c4c710VgnVCM100000d701210aRCRD"target="_blank" class="botao-acessar">Acessar</a>
                <i class="fa-regular fa-thumbs-up botao-curtir" title="curtir"></i>
                <i class="fa-regular fa-comment-dots botao-comentar" title="comentar"></i>
                <i class="fa-regular fa-bookmark botao-salvar" title="salvar"></i>
                <i class="fa-solid fa-share botao-compartilhar" title="compartilhar"></i>
            </div>
        </div>
        </div>
            
        <div class="curso" id="curso-list" data-area="pedagogia" data-regiao="sp">
            <?php if ($_SESSION['user_type'] === 'administracao' || $_SESSION['user_type'] === 'instituicao'): ?>
             <!-- BOTAO DE CONTROLE DO CURSO PARA ADMIN -->
                   <div class="control-config" onclick="toggleMenu(this)">
                      <i class="bi bi-three-dots"></i>
                      <div class="dropdown-menu" id="dropdownMenu">
                            <a href="#editar" class="editar">Editar <i class="bi bi-pencil-square"></i></a>
                            <a href="#deletar" class="delet">Deletar <i class="bi bi-trash3-fill"></i></a>
                            <a href="#outra-acao" class="outro">Outra ação</a>
                      </div>
                   </div>
             <!-- FIM BOTAO DE CONTROLE DO CURSO PARA ADMIN -->
             <?php endif; ?>
                <img src="./img/imagem curso 9.png" alt="Curso HTML e CSS" class="curso-img">
                <h2>Formação pedagógica </h2>
                <p>Área: curso pedagógico</p>
                <div class="curso-content">
            <p class="instituicao"><i class="bi bi-building"></i>Instituição: SEBRAE</p>
            <p class="localizacao"><i class="bi bi-laptop"></i>Modalidade: Online</p>
            <div class="curso-buttons">
                <a href="https://sebrae.com.br/sites/PortalSebrae/cursosonline/formacao-pedagogica,55ee16d291e4d710VgnVCM100000d701210aRCRD"target="_blank" class="botao-acessar">Acessar</a>
                <i class="fa-regular fa-thumbs-up botao-curtir" title="curtir"></i>
                <i class="fa-regular fa-comment-dots botao-comentar" title="comentar"></i>
                <i class="fa-regular fa-bookmark botao-salvar" title="salvar"></i>
                <i class="fa-solid fa-share botao-compartilhar" title="compartilhar"></i>
            </div>
        </div>  
        </div> 
    
                <?php if (empty($cursos)): ?>
            <p>Nenhum curso disponível no momento.</p>
        <?php else: ?>
            <?php foreach ($cursos as $curso): 
                    // echo "<pre>";
                    // var_dump($curso);
                    // echo "</pre>";    
            ?>
                
                <div class="curso" id="curso-list" data-area="<?php echo htmlspecialchars($curso['areacurso']); ?>" data-regiao="<?php echo htmlspecialchars($curso['localidade']); ?>">
                    <?php
                    // Constrói o caminho completo para a imagem
                    $caminhoImagem = '/../views/fotos-banco/' . htmlspecialchars($curso['fotocurso']);
                    ?>
                    <img src="<?php echo $caminhoImagem; ?>" alt="<?php echo htmlspecialchars($curso['nome_curso']); ?>" class="curso-img">
                <?php if ($_SESSION['user_type'] === 'administracao' || $_SESSION['user_type'] === 'instituicao'): ?>

                <!-- BOTAO DE CONTROLE DO CURSO PARA ADMIN -->
                    <!-- <div class="control-config" onclick="toggleMenu(this)">
                       <i class="bi bi-three-dots"></i>
                       <div class="dropdown-menu" id="dropdownMenu">
                            <a href="#editar" class="editar">Editar <i class="bi bi-pencil-square"></i></a>
                            <a href="#deletar" class="delet" data-id="<?php echo $curso['id_curso']; ?>">Deletar <i class="bi bi-trash3-fill"></i></a>
                            <a href="#outra-acao" class="outro">Outra ação</a>
                       </div>
                    </div> -->
               <!-- FIM BOTAO DE CONTROLE DO CURSO PARA ADMIN -->

               
            <!-- BOTAO DE CONTROLE DO CURSO PARA ADMIN -->
            <div class="control-config" onclick="toggleMenu(this)">
                    <i class="bi bi-three-dots"></i>
                    <div class="dropdown-menu" id="dropdownMenu">
                        <!-- Formulário para editar curso -->
                        <form action="../controllers/editar_curso.php" method="post" class="editar">
                            <input type="hidden" name="id_curso" value="<?php echo $curso['id_curso']; ?>">
                            <button type="submit">Editar <i class="bi bi-pencil-square"></i></button>
                        </form>

                        <!-- Formulário para deletar curso -->
                        <form action="../controllers/deletar_curso.php" method="post" class="delet">
                        <input type="hidden" name="id_curso" value="<?php echo htmlspecialchars($curso['id_curso']); ?>">
                        <button type="submit" onclick="confirmDeletion(<?php echo htmlspecialchars($curso['id_curso']); ?>)">Deletar <i class="bi bi-trash3-fill"></i></button>
                        </form>
                        
                        <a href="#outra-acao" class="outro">Outra ação</a>
                    </div>
                </div>
            <!-- FIM BOTAO DE CONTROLE DO CURSO PARA ADMIN -->

               <?php endif; ?>
                    <img src="<?php echo htmlspecialchars($curso['fotocurso']); ?>" alt="<?php echo htmlspecialchars($curso['nome_curso']); ?>" class="curso-img">
                    <h2><?php echo htmlspecialchars($curso['nome_curso']); ?></h2>
                    <p>Área: <?php echo htmlspecialchars($curso['areacurso']); ?></p>
                    <div class="curso-content">
                    <?php if (isset($curso['instituicao'])): ?>
                     <p class="instituicao"><i class="bi bi-building"></i>Instituição: <?php echo htmlspecialchars($curso['instituicao']); ?></p>
                        <?php endif; ?>
                        <p class="localizacao"><i class="bi bi-laptop"></i>Modalidade: <?php echo htmlspecialchars($curso['formato']); ?></p>
                        <div class="curso-buttons">
                            <a href="<?php echo htmlspecialchars($curso['linksite']); ?>" target="_blank" class="botao-acessar">Acessar</a>
                            <i class="fa-regular fa-thumbs-up botao-curtir" title="curtir"></i>
                            <i class="fa-regular fa-comment-dots botao-comentar" title="comentar"></i>
                            <i class="fa-regular fa-bookmark botao-salvar" title="salvar"></i>
                            <i class="fa-solid fa-share botao-compartilhar" title="compartilhar"></i>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

</div> 

<!-- FEEDBACKS -->
<?php
    if (isset($_SESSION['success_message'])) {
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso',
                    text: '" . $_SESSION['success_message'] . "',
                });
              </script>";
        unset($_SESSION['success_message']);
    }

    if (isset($_SESSION['error_message'])) {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Erro',
                    text: '" . $_SESSION['error_message'] . "',
                });
              </script>";
        unset($_SESSION['error_message']);
    }
    ?>
            
    <script src="./js/script.js"></script>
    <script src="./js/modal.js"></script>
    </main>
</body>
    
</html>
