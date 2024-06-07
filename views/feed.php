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
                    
                    <span class="logo"><a href="#"><img src="./img/Home-removebg-preview.png" alt=""></a></span>

                    <div class="group">
                        <i class="fa-solid fa-magnifying-glass" id="search"></i>
                        <input placeholder="Busque aqui seus cursos no site." type="search" class="input">
                    </div>

                    <div class="block-user">
                        <ul class="user-ul">
                            <li class="user-li">
                                <a href="./admin/areaadm.php">
                                    <h4 class="user-log">
                                       <i class="bi bi-person-circle"></i>
                                       Usuário 
                                       <i class="bi bi-chevron-down"></i>
                                    </h4> 
                                </a>
                            </li>
                        </ul>
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
                                            <a href="./admin/areaadm.php" title="Filtro">
                                                <i class="bi bi-sliders2"></i><span>Filtro</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="./admin/areaadm.php" title="Tipo">
                                                <i class="bi bi-caret-down"></i><span>Tipo</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="./admin/areaadm.php" title="Controle">
                                                <i class="bi bi-bar-chart-line-fill"></i><span>Controle</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="./produtos.php"> 
                                               <i class="bi bi-handbag-fill"></i>
                                               Produtos
                                            </a>
                                        </li>
                            </ul>
                </div>
                      
            </nav>
        </header>
    

<br>

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
       <div class="curso">
            <img src="./img/img curso 1.png" alt="Curso HTML e CSS" class="curso-img">
            <h2>Aprenda HTML e CSS!</h2>
            <p>Área: Desenvolvimento Web</p>
            <div class="curso-content">
            <p class="instituicao"><i class="bi bi-building"></i>Curso em vídeo</p>
            <p class="localizacao"><i class="bi bi-laptop"></i>Online</p>
            </div>
            <div class="curso-buttons">
                <a href= "https://www.cursoemvideo.com/matricula-gratis" target="_blank" class="botao-acessar">Acessar</a>
                <i class="bi bi-heart-fill botao-curtir"></i>
                <i class="bi bi-chat-dots botao-comentar"></i>
                <i class="bi bi-share-fill botao-compartilhar"></i>
            </div>
        </div>
    

    
        <div class="curso">
                <img src="./img/imagem curso 2.png" alt="Curso HTML e CSS" class="curso-img">
                <h2>JavaScript para Iniciantes</h2>
               <p>Área: Desenvolvimento Web</p>
            <div class="curso-content">
           <p class="instituicao"><i class="bi bi-building"></i>Alura</p>
            <p class="localizacao"><i class="bi bi-laptop"></i>Online</p>
            </div> 
            <div class="curso-buttons">
                <a href="https://www.alura.com.br/curso-online-javascritpt-orientacao-objetos" class="botao-acessar" target="_blank">Acessar</a>
                <i class="bi bi-heart-fill botao-curtir"></i>
                <i class="bi bi-chat-dots botao-comentar"></i>
                <i class="bi bi-share-fill botao-compartilhar"></i>
            </div>
    
        </div>
        
            <div class="curso">
                    <img src="./img/imagem curso 3.png" alt="Curso HTML e CSS" class="curso-img">
                    <h2>Aprenda Phyton!</h2>
                     <p>Área: Desenvolvimento Web</p>
             <div class="curso-content">
            <p class="instituicao"><i class="bi bi-building"></i>XPE</p>
            <p class="localizacao"><i class="bi bi-laptop"></i>Online</p>
            </div>
            <div class="curso-buttons">
                <a href="https://forms.xpeducacao.com.br/curso-gratuito-python-pre-inscricao/?gad_source=1&gclid=CjwKCAjwoa2xBhACEiwA1sb1BA3vTS0aKOJsC282bgj0_4gvB9YEYNl72Zeus2z3kqxQX93CmKq8kBoC1HUQAvD_BwE" class="botao-acessar">Acessar</a>
                <i class="bi bi-heart-fill botao-curtir"></i>
                <i class="bi bi-chat-dots botao-comentar"></i>
                <i class="bi bi-share-fill botao-compartilhar"></i>
            </div>
    
        </div>
        
        
        <div class="curso">
                <img src="./img/imagem curso 4.png" alt="Curso HTML e CSS" class="curso-img">
                    <h2>Desenvolvimentode Jogos</h2>
                  <p>Área: Desenvolvimento T.I</P>
                 <div class="curso-content">
            <p class="instituicao"><i class="bi bi-building"></i>CDPI</p>
            <p class="localizacao"><i class="bi bi-laptop"></i>Online</p>
                 </div>
            <div class="curso-buttons">
                <a href="https://cpdi.org.br/projeto/alem-de-jogar-eu-faco-jogos/" class="botao-acessar" target="_blank">Acessar</a>
                <i class="bi bi-heart-fill botao-curtir"></i>
                <i class="bi bi-chat-dots botao-comentar"></i>
                <i class="bi bi-share-fill botao-compartilhar"></i>
            </div>
        </div>

       <div class="curso">
                    <img src="./img/imagem curso 5.png" alt="Curso HTML e CSS" class="curso-img">
                    <h2>Marketing Digital</h2>
            <p>Área: Marketing</p>
            
            <div class="curso-content">
            
            <p class="instituicao"><i class="bi bi-building"></i> SEBRAE</p>
            <p class="localizacao"><i class="bi bi-laptop"></i>Online</p>
            <div class="curso-buttons">
                <a href="https://sebrae.com.br/sites/PortalSebrae/cursosonline/marketing-digital-para-sua-empresa-equipe-comercial,12e7125576a4e710VgnVCM100000d701210aRCRD" class="botao-acessar" target="_blank">Acessar</a>
                <i class="bi bi-heart-fill botao-curtir"></i>
                <i class="bi bi-chat-dots botao-comentar"></i>
                <i class="bi bi-share-fill botao-compartilhar"></i>
            </div>
      </div>
        </div>
        

            <div class="curso">
                    <img src="./img/imagem curso 6.png" alt="Curso HTML e CSS" class="curso-img">
                    <h2>Legislação e Negácios para Audiovisual</h2>
            <p>Área: Direito</p>
            
            <div class="curso-content">
            
            <p class="instituicao"> <i class="bi bi-building"></i>SEBRAE</p>
            <p class="localizacao"><i class="bi bi-laptop"></i>Online</p>
            <div class="curso-buttons">
                <a href="https://sebrae.com.br/sites/PortalSebrae/cursosonline/legislacao-e-negocios,20d5baa60fd5d710VgnVCM100000d701210aRCRD" class="botao-acessar" target="_blank">Acessar</a>
                <i class="bi bi-heart-fill botao-curtir"></i>
                <i class="bi bi-chat-dots botao-comentar"></i>
                <i class="bi bi-share-fill botao-compartilhar"></i>
            </div>
            </div>
        </div>
        
                    

            <div class="curso">
                <img src="./img/imagem 7.png" alt="Curso HTML e CSS" class="curso-img">
                    <h2>Preço de Vendas para Beleza</h2>
            <p>Área: Empreendedorismo e  Estética</p>
            
            <div class="curso-content">
            
            <p class="instituicao"> <i class="bi bi-building"></i>SEBRAE</p>
            <p class="localizacao"><i class="bi bi-laptop"></i>Online</p>
            <div class="curso-buttons">
                <a href="https://sebrae.com.br/sites/PortalSebrae/cursosonline/preco-de-vendas-para-beleza,85bb36435d608810VgnVCM1000001b00320aRCRD" class="botao-acessar" target="_blank">Acessar</a>
                <i class="bi bi-heart-fill botao-curtir"></i>
                <i class="bi bi-chat-dots botao-comentar"></i>
                <i class="bi bi-share-fill botao-compartilhar"></i>
            </div>
            </div>
        </div>
        

            <div class="curso">
                <img src="./img/imagem curso 8.png" alt="Curso HTML e CSS" class="curso-img">
                    <h2>Volte a Empreender!</h2>
            <p>Área: Empreendedorismo</p>
            <div class="curso-content">
                <p class="instituicao"> <i class="bi bi-building"></i>SEBRAE</p>
                <p class="localizacao"><i class="bi bi-laptop"></i>Online</p>
            
            <div class="curso-buttons">
                <a href="https://sebrae.com.br/sites/PortalSebrae/cursosonline/volte-a-empreender,67b2adea33c4c710VgnVCM100000d701210aRCRD" class="botao-acessar" target="_blank">Acessar</a>
                <i class="bi bi-heart-fill botao-curtir"></i>
                <i class="bi bi-chat-dots botao-comentar"></i>
                <i class="bi bi-share-fill botao-compartilhar"></i>
            </div>
    
        </div>
        </div>
            
            <div class="curso">
                    <img src="./img/imagem curso 9.png" alt="Curso HTML e CSS" class="curso-img">
                    <h2>Formação pedagógica </h2>
            
            <p>Área: curso pedagógico</p>
            <div class="curso-content">
            
                <p class="instituicao"> <i class="bi bi-building"></i>SEBRAE</p>
                <p class="localizacao"><i class="bi bi-laptop"></i>Online</p>
            
        <div class="curso-buttons">
                <a href="https://sebrae.com.br/sites/PortalSebrae/cursosonline/formacao-pedagogica,55ee16d291e4d710VgnVCM100000d701210aRCRD" class="botao-acessar" target="_blank">Acessar</a>
                <i class="bi bi-heart-fill botao-curtir"></i>
                <i class="bi bi-chat-dots botao-comentar"></i>
                <i class="bi bi-share-fill botao-compartilhar"></i>
            </div>
         </div>

        </div> 
</div> 

            
            

             
    <script src="./js/script.js"></script>
    </main>
</body>
    
</html>
