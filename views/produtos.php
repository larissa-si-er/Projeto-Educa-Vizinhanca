<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="./img/home-ic.png">
    <title>Produtos - EV</title>
    <link rel="stylesheet" href="./css/menu-index.css">
    <link rel="stylesheet" href="./css/produtos.css">
    <link rel="stylesheet" href="./css/footer.css">
    <!-- <link rel="stylesheet" href="./css/style.css"> -->
    <script src="./js/produtos.js"></script>
    <!-- icones -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- icones -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!-- <script src="../js/script.js"></script> -->
    <!--fontawesome-->
    <script src="https://kit.fontawesome.com/6c3bbfdabc.js" crossorigin="anonymous"> </script>
</head>
<body>
    <header>
        <nav>
            <div class="nav-bar">
                <i class="bi bi-list sidebarOpen"></i>
                <span class="logo"><a href="#"><img src="./img/home-ic.png" alt=""></a></span>
                <!-- mobile carrinho -->
                <button onclick="abrirCarrinho()" class="cart-mobile">
                  <i class="bi bi-cart3"></i>
                </button>
                <div class="menu">
                    <i class="bi bi-x sidebarClose"></i>

                    <ul class="nav-links">
                        <li><a href="../index.php" class="pag-atual"> Início </a></li>
                        <li><a href="./cursos.php">Cursos</a></li>
                        <li><a href="#">Produtos <span class="active"></span></a></li>
                        <li><a href="#footer">Contato</a></li>
                        <li class="user"><a href="./auth/login.php"><i class="bi bi-person-circle"></i></a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="sub-menu">
            <i class="bi bi-house-door-fill"></i>
            <i class="bi bi-caret-right-fill"></i>
            <small class="p-sub-menu p-prod">Produtos</small>
            <button onclick="abrirCarrinho()">
                <i class="bi bi-cart3"></i>
                <small class="p-sub-menu">Carrinho</small>
            </button>

        </div>
        <div class="fundo-principal">
            <div class="titulos">
                <p class="frase1">Produtos exclusivos da</p>
                <h1 class="titulo1 title-anim">EDUCA</h1>
                <h1 class="titulo2">VIZINHANÇA</h1>
                <img class="img-inicio" src="./img/mulher-de-negocios.png" alt="" srcset="">
            </div>
        </div>

        <section class="first">
            <div class="bloco1">
                <i class="ic-a bi bi-cash-coin"></i>
        
                <div class="content-1-a">
                    <!-- <i class="ic-a bi bi-cash-coin"></i> -->
            
                   <span class="h-content-1">Compre com recorrência</span>
                   <p>e ganhe 15% off na 
                    primeira compra + frete
                    grátis.
                   </p>
                </div>
            </div>

            <div class="bloco2">
                <i class="ic-b bi bi-bag-heart-fill"></i>
                <div class="content-1-b">
                    <p>Transforme sua jornada educacional com produtos que <span class="h-content-1">valorizam a elegância e a qualidade.</span></p>
                </div>
            </div>
            <div class="bloco3">
                <i class="ic-b bi bi-cart-check"></i>
                <div class="content-1-c">
                    <p> Equipe-se para o sucesso!
                        Descubra o paraíso por meio
                     de<span class="h-content-1"> nossos produtos. </span> 
                    </p>
                </div>
            </div>
            <div class="bloco4">
                <i class="ic-b bi bi-credit-card"></i>
                <div class="content-1-d">
                    <p>Parcele suas compras em 
                        <span class="h-content-1">até 3x sem juros.</span>
                    </p>
                </div>
            </div>
            <div class="bloco5">
                <i class="ic-b bi bi-box-seam-fill"></i>
                <div class="content-1-e">
                    <p>Política de <span class="h-content-1">frete grátis</span>
                       confira as regras.</p>
                </div>
            </div>

    
        </section>



        <section class="second-1">        
            <div class="cards-s1">
                <div class="card-s1 bloco-a">
                    <a class="a-bloco" href="#">
                        <div class="side1-bloco">
                            <h5 class="title-bloco">Cadernos</h5>
                            <span class="p-bloco1 p-a">Personalizados</span>
                        </div>
                        <div class="side2-bloco">
                            <img class="bloco-img img-a" src="./img/caderno.png" alt="#">
                        </div>
                    </a>
                </div>
        
                <div class="card-s1 bloco-b">
                    <a class="a-bloco" href="#">
                        <div class="side1-bloco">
                            <h5 class="title-bloco">Garrafas</h5>
                            <span class="p-bloco1 p-b">Térmicas</span>
                        </div>
                        <div class="side2-bloco">
                            <img class="bloco-img img-b" src="./img/garrafa.png" alt="#">
                        </div>
                    </a>
                </div>
        
                <div class="card-s1 bloco-c">
                    <a class="a-bloco" href="#">
                        <div class="side1-bloco">
                            <h5 class="title-bloco">Planner</h5>
                            <span class="p-bloco1 p-c">Completo</span>
                        </div>
                        <div class="side2-bloco">
                            <img class="bloco-img img-c" src="./img/plannerr.png" alt="#">
                        </div>
                    </a>
                </div>
            </div>
        </section>

          
        <!-- MINI CARDS - SECOND SECTION -->
        <section class="second">
            <h3 class="title">CONFIRA NOSSOS LANÇAMENTOS</h3>
        
            <div class="linha1"></div>
            <div class="linha2"></div>


            <div class="cards">
        
                <div class="card card1-destaque">
                    <img class="card-img" src="./img/prod1-destaque.png" alt="#">
                    <h5 class="title-card-a">Garrafa flowers</h5>
                    <a class="a-card" href="#news">Veja aqui</a>
                </div>
        
                <div class="card card2-destaque">
                    <img class="card-img img2" src="./img/prod4-destaque.png" alt="#">
                    <h5 class="title-card-a">Caderno Básico</h5>
                    <a class="a-card" href="#news">Veja aqui</a>
                </div>
        
                <div class="card card3-destaque">
                    <img class="card-img img3" src="./img/prod3-destaque.png" alt="#">
                    <h5 class="title-card-a">Caderno Agronomia</h5>
                    <a class="a-card" href="#news">Veja aqui</a>
                </div>
        
                <div class="card card4-destaque">
                    <img class="card-img img4" src="./img/prod2-destaque.png" alt="#">
                    <h5 class="title-card-a">Garrafas EV</h5>
                    <a class="a-card" href="#news">Veja aqui</a>
                </div>
        
            </div>
        </section>

        <!-- CARDS - GRANDE - PRODUTOS -->
        <section class="third">
            <h3 class="title title-produtos">PRODUTOS DISPONÍVEIS</h3>

            <div class="row">
                
                <div class="cards-GG">
            
                    <div class="card-GG img-prod-teste">
                        <a class="link-prod" href="./subtelas/subProd1.php">
                            <img class="card-GG-img " src="./img/Educa World Capa.png" alt="#">
                        </a>
                        <h5 class="title-card-GG">Caderno EducaWorld</h5>
                        <div class="footer-card-GG">
                            <P class="preco-card-GG">R$34,99</P>
                            <button class="add-carrinho"><i class="bi bi-cart-plus-fill"></i></button>
                        </div>
                    </div>

                    <div class="card-GG img-prod-teste">
                        <a class="link-prod" href="./subtelas/subProd5.php">
                            <img class="card-GG-img" src="./img/Capa Cool Heart.png" alt="#">
                        </a>
                        <h5 class="title-card-GG">Caderno Cool Heart</h5>
                        <div class="footer-card-GG">
                            <P class="preco-card-GG">R$34,99</P>
                            <button class="add-carrinho"><i class="bi bi-cart-plus-fill"></i></button>
                        </div>
                    </div>

                    <div class="card-GG img-prod-teste">
                        <a class="link-prod" href="./subtelas/subProd4.php">
                            <img class="card-GG-img" src="./img/Vibes Capa.png" alt="#">
                        </a>
                        <h5 class="title-card-GG">Caderno Vibes</h5>
                        <div class="footer-card-GG">
                            <P class="preco-card-GG">R$34,99</P>
                            <button class="add-carrinho"><i class="bi bi-cart-plus-fill"></i></button>
                        </div>
                    </div>
            
                        
                </div>
            </div>

            <div class="row">
                
                <div class="cards-GG">
            
                    <div class="card-GG img-prod-teste">
                        <a class="link-prod" href="./subtelas/subProd3.php">
                            <img class="card-GG-img" src="./img/Garrafa LoveYourself.png" alt="#">
                        </a>
                        <h5 class="title-card-GG img-prod-teste">Garrafa Love Yourself</h5>
                        <div class="footer-card-GG">
                            <P class="preco-card-GG">R$ 89,99</P>
                            <button class="add-carrinho"><i class="bi bi-cart-plus-fill"></i></button>
                        </div>
                    </div>

                    <div class="card-GG img-prod-teste">
                        <a class="link-prod" href="./subtelas/subProd2.php">
                            <img class="card-GG-img" src="./img/images.jpg" alt="#">
                        </a>
                        <h5 class="title-card-GG">Garrafa Hydro Flask </h5>
                        <div class="footer-card-GG">
                            <P class="preco-card-GG">R$ 89,99</P>
                            <button class="add-carrinho"><i class="bi bi-cart-plus-fill"></i></button>
                        </div>
                    </div>

                    <div class="card-GG img-prod-teste">
                        <a class="link-prod" href="./subtelas/subProd6.php">
                            <img class="card-GG-img" src="./img/Garrafa White Star.png" alt="#">
                        </a>
                        <h5 class="title-card-GG">Garrafa White Star</h5>
                        <div class="footer-card-GG">
                            <P class="preco-card-GG">R$ 89,99</P>
                            <button class="add-carrinho"><i class="bi bi-cart-plus-fill"></i></button>
                        </div>
                    </div>
            
                        
                </div>
            </div>
        </section>

    <!-- PRODUTOS AUTOMATIZADO -->
    <div id="produtos">
        <!-- Os produtos serão exibidos aqui dinamicamente -->
        <?php include '../controllers/produtos_control.php'; ?>
        
    <!-- Seção "CONFIRA NOSSOS LANÇAMENTOS" -->
<section class="second">
    <h3 class="title" id="news">CONFIRA NOSSOS LANÇAMENTOS RECENTES</h3>
    <div class="linha1"></div>
    <div class="linha2"></div>
    <div class="cards">
        <?php if (empty($lancamentos)): ?>
            <p>Nenhum lançamento <b>recente</b> disponível no momento.</p>
        <?php else: ?>
            <?php 
            $classes = ['card1-destaque', 'card2-destaque', 'card3-destaque', 'card4-destaque'];
            foreach ($lancamentos as $index => $lancamento): 
                $class = $classes[$index % count($classes)];
            ?>
                <div class="card <?php echo $class; ?>">
                    <img class="card-img" src="<?php echo htmlspecialchars($lancamento['imagem_url']); ?>" alt="<?php echo htmlspecialchars($lancamento['nome_produto']); ?>">
                    <h5 class="title-card-a"><?php echo htmlspecialchars($lancamento['nome_produto']); ?></h5>
                    <a class="a-card" href="#">Veja aqui</a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>

    <section class="third">
        <h3 class="title title-produtos">PRODUTOS RECENTEMENTE DISPONÍVEIS</h3>
    
        <div class="row">
            <!-- <div class="cards-GG">
                <?php if (empty($produtos)): ?>
                    <p>Nenhum produto <b>recente</b> disponível no momento.</p>
                <?php else: ?>
                    <?php foreach ($produtos as $produto): ?>
                        <div class="card-GG img-prod-teste">
                            <a class="link-prod" href="./subtelas/subProd1.php">
                                <img class="card-GG-img" src="<?php echo htmlspecialchars($produto['imagem']); ?>" alt="<?php echo htmlspecialchars($produto['nome_produto']); ?>">
                            </a>
                            <h5 class="title-card-GG"><?php echo htmlspecialchars($produto['nome_produto']); ?></h5>
                            <div class="footer-card-GG">
                                <p class="preco-card-GG">R$<?php echo number_format($produto['preco'], 2, ',', '.'); ?></p>
                                <button class="add-carrinho"><i class="bi bi-cart-plus-fill"></i></button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div> -->

            <div class="row">
                    <div class="cards-GG">
                    <?php if (empty($produtos)): ?>
                        <p>Nenhum produto <b>recente</b> disponível no momento.</p>
                    <?php else: ?>
                        <?php foreach ($produtos as $produto): ?>
                            <div class="card-GG img-prod-teste">
                                <a class="link-prod" href="./subtelas/subProd1.php">
                                    
                                    <?php var_dump($produto['imagem']);
 ?>
                                    <img class="card-GG-img" src="<?php echo htmlspecialchars('/fotos-banco/' . $produto['imagem']); ?>" alt="<?php echo htmlspecialchars($produto['nome_produto']); ?>">
                                </a>
                                <h5 class="title-card-GG"><?php echo htmlspecialchars($produto['nome_produto']); ?></h5>
                                <div class="footer-card-GG">
                                    <p class="preco-card-GG">R$<?php echo number_format($produto['preco'], 2, ',', '.'); ?></p>
                                    <button class="add-carrinho"><i class="bi bi-cart-plus-fill"></i></button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        </div>
    </section>

    
        <!-- SLIDER -->
        <div class="logos">
            <div class="logos-slide">
              <img src="./img/slide-img1.png" /> 
              <!-- <p>Layout moderno</p> -->
              <img src="./img/slide-img2.png" /> 
              <!-- <p>Layout para todos os cursos</p> -->
              <img src="./img/slide-img3.png" /> 
              <!-- <p>Coleções</p> -->
              <img src="./img/slide-img4.png" /> 
              <!-- <p>Material resistente</p> -->
              <img src="./img/slide-img5.png" /> <!-- <p>Facilidade e utilidade</p>  -->
            </div>
      
            <div class="logos-slide">
                <img src="./img/slide-img1.png" />
                <img src="./img/slide-img2.png" />
                <img src="./img/slide-img3.png" />
                <img src="./img/slide-img4.png" />
                <img src="./img/slide-img5.png" />

            </div>
        </div>

        <!-- BOTOES ACESSIBILIDADE E SETA [inicio]-->
        <div class="div-acess-bt"><button class="acess-bt"><i class="fa-solid fa-universal-access"></i></button></div>

         <!-- conteudo acessibilidade -->
         <div class="acess-window"><div class="window-point"></div><small>Janela de acessibilidade.</small>
                <!-- <div class="moreorless">
                    <button class="more" onclick="aumentarTexto()"><span class="material-symbols-outlined">
                    </span>
                    </button>
                    <button class="less" onclick="diminuirTexto()">
                        <span class="material-symbols-outlined">  
                        </span>
                    </button>
                </div> -->
                <div class="moreorless">
                    <button class="more button" onclick="aumentarTexto()">
                        A+
                    </svg>
                    </button>
                    <button class="less button" onclick="diminuirTexto()">
                        A-
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


          
        <!-- //////////////////////// MODAL //////////////////////// -->

            <DIV class="janela-modal1" id="janela-modal1">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-1">
                            <button class="fechar" id="fechar1"><i id="fechar1" class="bi bi-x-lg"></i></button>
                            <h2>Meu carrinho</h2>  
                            <p class="qtde-itens">Seu carrinho tem 0 itens</p>
                            <div class="linha-modal1"></div>

                            <div class="footer-carrinho">
                                <div class="linha-modal2"></div>
                                <div class="content-carrinho">
                                    <p class="total">Total:</p>
                                    <p class="preco">R$00,00</p>
                                </div>

                                <div class="div-finalizar"> 
                                    <button class="finalizar" onclick="window.location.href ='./pagamento-1.php'">Finalizar compra</button>
                                </div>
                            </div>

                        </div>
                    </div>
            </DIV>
    </main>    

    <?php
    require_once '../footer.php';
    ?>
</body>
</html>