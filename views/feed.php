<?php
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

//  var_dump($_SESSION);

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
                                            <a href="../index.php">
                                            <i class="fa-solid fa-house" id="filter-icon" style="cursor: pointer;"></i><span>Início</span>
                                           </a>
                                        </li>
                                        <li>
                                            <a>
                                            <i class="bi bi-sliders2" id="filter-icon" style="cursor: pointer;"></i><span>Filtro</span>
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




<script>
    function toggleComentarios(icon) {
        // Encontra o contêiner de comentários relacionado ao ícone clicado
        var comentariosContainer = icon.parentElement.querySelector('.comentarios');

        // Verifica se o contêiner existe e alterna sua visibilidade
        if (comentariosContainer) {
            if (comentariosContainer.style.display === 'none') {
                comentariosContainer.style.display = 'block';
            } else {
                comentariosContainer.style.display = 'none';
            }
        }
    }
</script>
        <style>
            .comentarios-area {
            margin-top: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
            }
        </style>









<div class="container">

        <?php if (empty($cursos)): ?>
            <p>Nenhum curso disponível no momento.</p>
        <?php else: ?>
            <?php foreach ($cursos as $curso):
                    // echo "<pre>";
                    // var_dump($curso);
                    // echo "</pre>";
            ?>

                <div class="curso" id="curso-list" data-area="<?php echo htmlspecialchars($curso['areacurso']); ?>" data-regiao="<?php echo htmlspecialchars($curso['localidade']); ?>" title="<?php echo htmlspecialchars(date('d/m/Y H:i', strtotime($curso['data_time']))); ?>">
               
                <?php if ($_SESSION['user_type'] === 'administracao' || ($_SESSION['user_type'] === 'instituicao' && $curso['id_instituicao'] === $_SESSION['user_data']['id_instituicao'])): ?>                    
                    <!-- BOTAO DE CONTROLE DO CURSO PARA ADMIN -->
                    <div class="control-config" onclick="toggleMenu(this)">
                            <i class="bi bi-three-dots"></i>
                            <div class="dropdown-menu" id="dropdownMenu<?php echo $curso['id_curso']; ?>">
                                <!-- Formulário para editar curso -->
                                <button class="editar" onclick="openEditModal(<?php echo htmlspecialchars(json_encode($curso)); ?>)">Editar <i class="bi bi-pencil-square"></i></button>
                                <button class="delet" onclick="confirmDeletion(<?php echo htmlspecialchars($curso['id_curso']); ?>)">Deletar <i class="bi bi-trash3-fill"></i></button>

                                <!-- Link outra ação -->
                                <?php
                                    switch ($_SESSION['user_type']) {
                                        case 'administracao':
                                            echo '<a href="./admin/areaadm.php" class="outro">Outra ação</a>';
                                            break;
                                        case 'instituicao':
                                            echo '<a href="./instituicao/areainsti.php" class="outro">Outra ação</a>';
                                            break;
                                        default:
                                            echo '<a href="#" class="outro">Outra ação</a>'; 
                                            break;
                                    }
                                ?>                                
                            </div>
                        </div>

                <?php endif; ?>
                <!-- FIM BOTAO DE CONTROLE DO CURSO PARA ADMIN -->

                    <!-- IMAGEM -->
                   <?php
                        $caminhoImagem = '/../views/fotos-banco/' . htmlspecialchars($curso['fotocurso']);
                    ?>
                    <img src="<?php echo $caminhoImagem; ?>" alt="<?php echo htmlspecialchars($curso['nome_curso']); ?>" class="curso-img">
                    <!-- FIM IMAGEM -->


                    <h2><?php echo htmlspecialchars($curso['nome_curso']); ?></h2>
                    <p>Área: <?php echo htmlspecialchars($curso['areacurso']); ?></p>
                    <div class="curso-content">
                    <?php if (isset($curso['instituicao'])): ?>
                        <p class="instituicao"><i class="bi bi-building"></i>Instituição: <?php echo htmlspecialchars($curso['instituicao']); ?></p>
                    <?php endif; ?>
                        <p class="localizacao"><i class="bi bi-laptop"></i>Modalidade: <?php echo htmlspecialchars($curso['formato']); ?></p>
                        <button class="mais-info" onclick="openDetalhesModal(<?php echo htmlspecialchars(json_encode($curso)); ?>)"><i class="bi bi-info-circle"></i>Mais Info.</button>
                        


                        <!-- <p class="tipocurso"><i class="bi bi-tag"></i>Tipo: <?php echo htmlspecialchars($curso['tipocurso']); ?></p>
                        <p class="vagas"><i class="bi bi-person"></i>Vagas: <?php echo htmlspecialchars($curso['quantidadevagas']); ?></p>
                        <p class="duracao"><i class="bi bi-clock"></i>Duração: <?php echo htmlspecialchars($curso['duracao']); ?></p>
                        <p class="turno"><i class="bi bi-sun"></i>Turno: <?php echo htmlspecialchars($curso['turno']); ?></p> -->

                        <!-- <p class="inicioinscricoes"><i class="bi bi-calendar"></i><?php echo htmlspecialchars(date('d/m/Y', strtotime($curso['inicioinscricoes']))); ?></p>
                        <p class="terminoinscricoes"><i class="bi bi-calendar"></i><?php echo htmlspecialchars(date('d/m/Y', strtotime($curso['terminoinscricoes']))); ?></p> -->

                        <!-- DESCRIÇAO -->
                    <!-- Descrição com "Ver mais" -->
                    <?php
                    $descricao = htmlspecialchars($curso['descricao']);
                    ?>
                    <p class="descricao"><?php echo substr($descricao, 0, 75); ?></p>
                    <?php if (strlen($descricao) > 75): ?>
                        <p class="descricao-completa" style="display: none;"><?php echo $descricao; ?></p>
                        <a href="#" class="ver-mais" onclick="toggleDescription(this); return false;">Ver mais</a>
                    <?php endif; ?>

                        <div class="curso-buttons">
                            <a href="<?php echo htmlspecialchars($curso['linksite']); ?>" target="_blank" class="botao-acessar">Acessar</a>

                            <i class="fa-regular fa-thumbs-up botao-curtir" title="curtir"></i>
                            <i class="fa-regular fa-comment-dots botao-comentar" title="comentar" onclick="toggleComments(<?php echo $curso['id_curso']; ?>)"></i>
                            <i class="fa-regular fa-bookmark botao-salvar" title="salvar"></i>
                            <i class="fa-solid fa-share botao-compartilhar" title="compartilhar"></i>
                        </div>
                    </div>           

                    <!-- COMENTARIOS -->
                    <div class="comentarios" id="comentarios-curso-<?php echo $curso['id_curso']; ?>" style="display: none;">
                        <!-- Formulário de comentário -->
                        <?php if ($_SESSION['user_type'] !== 'administracao' && $_SESSION['user_type'] !== 'instituicao'): ?>
                            <form id="form-comentario-<?php echo $curso['id_curso']; ?>" onsubmit="event.preventDefault(); enviarComentario(<?php echo $curso['id_curso']; ?>);">
                                <div class="comentario-input-container">
                                    <div class="comentario-input" contenteditable="true" placeholder="Adicione um comentário..."></div>
                                    <button type="submit" class="comentario-botao"><i class="bi bi-cursor"></i></button>
                                </div>
                            </form>
                        <?php endif; ?>

                        <!-- Lista de comentários -->
                        <div id="lista-comentarios-<?php echo $curso['id_curso']; ?>"> </div>

                        <!-- Botão para carregar mais comentários -->
                        <div id="load-more-<?php echo $curso['id_curso']; ?>" style="display: none;">
                            <button class="maisComent" onclick="loadMoreComentarios(<?php echo $curso['id_curso']; ?>);">Carregar mais comentários</button>
                        </div>
                    </div>
                    <!-- FIM COMENTARIOS -->

               </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <!-- truncar a descrição -->
        <?php
        function truncate($text, $length) {
            if (strlen($text) > $length) {
                $text = substr($text, 0, $length);
                $text = substr($text, 0, strrpos($text, ' '));
                $text .= '...';
            }
            return $text;
        }
        ?>
        <!-- truncar a descrição -->
</div>

        <!-- O Modal de detalhes do Curso -->
        <div id="detalhesModal" class="modal-detalhes">
            <div class="modal-content-detalhes">
                <span class="close-detalhes" onclick="closeDetalhesModal()">&times;</span>
                <div class="curso-detalhes">
                    <h1 id="title"><i class="bi bi-mortarboard-fill"></i>EDUCA <span class="title-details"> VIZINHANÇA</span></h1> <p>CURSOS</p>
                    <h2 id="detalhesNomeCurso"></h2>

                    <div class="row">
                        <p class="instituicao-detalhes"><i class="bi bi-building"></i>Instituição: <span id="detalhesInstituicao"></span></p>
                        <p class="vagas"><i class="bi bi-person"></i>Vagas: <span id="detalhesVagas"></span></p>

                    </div>

                    <div class="row">
                        <p class="localizacao-detalhes"><i class="bi bi-geo-alt"></i>Localização: <span id="detalhesLocalizacao"></span></p>
                    </div>

                    <div class="row">
                        <p class="modalidade"><i class="bi bi-card-list"></i>Modalidade: <span id="detalhesModalidade"></span></p>
                        <p class="turno"><i class="bi bi-sun"></i>Turno: <span id="detalhesTurno"></span></p>
                        <p class="tipocurso"><i class="bi bi-tag"></i>Tipo: <span id="detalhesTipoCurso"></span></p>
                        <p class="duracao"><i class="bi bi-clock"></i>Duração: <span id="detalhesDuracao"></span></p>
                    </div>

                    <div class="row">
                        <p class="inicioinscricoes"><i class="bi bi-calendar"></i>Datas: <span id="detalhesInicioInscricoes"></span>  até   <span id="detalhesTerminoInscricoes"></span></p>
                    </div>

                    <p class="descricao"><i class="bi bi-file-earmark-text"></i>Descrição: <span id="detalhesDescricao"></span></p>

                </div>
            </div>
        </div>


    <!-- O Modal editar [INICIO]-->
    <div id="editModal" class="modal-edit">
        <div class="modal-content-edit curso">
            <span class="close-edit">&times;</span>
            <form action="../controllers/editar_curso.php" method="post" id="editForm" enctype="multipart/form-data">
                <input type="hidden" name="id_curso" id="id_curso_edit">

                <!-- imagem atual -->
                <div class="imagem-atual">
                    <label>Imagem Atual:</label><br>
                    <img id="imagem_atual_edit" src="" alt="Imagem Atual">
                </div>

                
                <label for="nome_curso_edit">Nome do Curso:</label>
                <input type="text" name="nome_curso" id="nome_curso_edit" required>

                <label for="descricao_edit">Descrição:</label>
                <textarea name="descricao" id="descricao_edit" rows="4" required></textarea>
                
                <label for="areacurso_edit">Área do Curso:</label>
                <select name="areacurso" id="areacurso_edit" required>
                    <option value="tecnologia">Tecnologia</option>
                    <option value="Saúde e Bem-Estar">Saúde e Bem-Estar</option>
                    <option value="Educação">Educação</option>
                    <option value="Engenharia">Engenharia</option>
                    <option value="Ciências Exatas e Naturais">Ciências Exatas e Naturais</option>
                    <option value="Ciências sociais, negócios e direito">Ciências sociais, negócios e direito</option>
                    <option value="Ciências Agrárias">Ciências Agrárias</option>
                    <option value="Meio Ambiente">Meio Ambiente</option>
                    <option value="Artes e Design">Artes e Design</option>
                    <option value="Comunicação">Comunicação</option>
                    <option value="Outros">Outros</option>
                </select>
                
                <label for="instituicao_edit">Instituição:</label>
                <input type="text" name="instituicao" id="instituicao_edit" required>

                <div class="row_edit">
                    <label for="formato_edit">Modalidade:</label>
                    <select name="formato" id="formato_edit" required>
                        <option value="Presencial">Presencial</option>
                        <option value="EAD">EAD</option>
                        <option value="Híbrido">Híbrido</option>
                    </select>

                    <label for="tipocurso_edit">Tipo do curso:</label>
                    <select name="tipocurso" id="tipocurso_edit" required>
                        <option value="Extenção">Extenção</option>
                        <option value="Livre">Livre</option>
                    </select>
                </div>
                
                <div class="row_edit">
                    <label for="quantidadevagas_edit">Quantidade de Vagas:</label>
                    <input type="number" name="quantidadevagas" id="quantidadevagas_edit" min="0" required>

                    <label for="duracao_edit">Duração:</label>
                    <input type="text" name="duracao" id="duracao_edit" required>
                </div>
                
                <label for="linksite_edit">Link do Site:</label>
                <input type="url" name="linksite" id="linksite_edit" required>
                
                <label for="turno_edit">Turno:</label>
                <select name="turno" id="turno_edit" required>
                    <option value="Manhã">Manhã</option>
                    <option value="Tarde">Tarde</option>
                    <option value="Noite">Noite</option>
                    <option value="Indefinido">Indefinido</option>
                </select>
                
                <label for="localidade_edit">Local:</label>
                <input type="text" name="localidade" id="localidade_edit" required>

                <div class="row_edit row_dates">
                    <label for="inicioinscricoes_edit">Início das Inscrições:</label>
                    <input type="date" name="inicioinscricoes" id="inicioinscricoes_edit" required>

                    <label for="terminoinscricoes_edit">Término das Inscrições:</label>
                    <input type="date" name="terminoinscricoes" id="terminoinscricoes_edit" required>
                </div>
                
                <label for="foto_edit">Editar Foto:</label>
                <input type="file" name="foto_curso" id="foto_edit">
                
                <button type="submit">Salvar Alterações</button>
            </form>
        </div>
    </div>
    <!-- O Modal edita [FIM] -->











    <!-- FEEDBACKS -->
    <?php
        if (isset($_GET['deletion']) && $_GET['deletion'] == 'success') {
            echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        title: "Deletado!",
                        text: "O curso foi deletado com sucesso.",
                        icon: "success",
                        timer: 2000, // Tempo em milissegundos (3 segundos)
                        timerProgressBar: true,
                        showConfirmButton: false // Remove o botão OK
                    }).then((result) => {
                        window.location.href = "#curso-list"; // Redireciona para o container de cursos
                    });
                });
            </script>';
        }
    ?>
    <!-- FEEDBACKS -->


    <script src="./js/script.js"></script>
    <script src="./js/modal.js"></script>
    <script src="./js/feedCursos.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    </main>
</body>

</html>
