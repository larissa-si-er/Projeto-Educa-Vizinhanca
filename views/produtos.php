<?php 
session_start();
?>
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
                    <a class="a-bloco filtro-cadernos" href="?categoria=cadernos#produtos">
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
                    <a class="a-bloco filtro-garrafas" href="?categoria=garrafas#produtos">
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
                    <a class="a-bloco filtro-planners" href="?categoria=planners#produtos">
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

            <!-- Verifica se um filtro está aplicado e exibe o link "Mostrar Todos" -->
            <?php if (isset($_GET['categoria'])): ?>
                <div class="show-all">
                    <a href="produtos.php#produtos" class="btn btn-secondary">Mostrar Todos os Produtos</a>
                </div>
            <?php endif; ?>

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
        <!-- <section class="third">
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
        </section> -->

<div id="produtos">
    <?php
    // Incluir arquivo com a lógica para buscar produtos
    include '../controllers/produtos_control.php';

    // Verifica se há produtos para exibir
    if (empty($produtos)): ?>
        <p>Nenhum produto disponível no momento.</p>
    <?php else: ?>
        <section class="third">
            <h3 class="title title-produtos" id="news">PRODUTOS DISPONÍVEIS</h3>
            <div class="row">
                <div class="cards-GG">
                    <?php foreach ($produtos as $produto): ?>
                        <div class="card-GG img-prod-teste">
  <!-- Verificar permissões para exibir botões de controle -->
<?php if ($_SESSION['user_type'] === 'administracao'): ?>                    
    <!-- Botões de controle para administradores -->
    <div class="control-config" onclick="toggleMenu(this)">
        <i class="bi bi-three-dots"></i>
        <div class="dropdown-menu" id="dropdownMenu<?php echo $produto['id_produto']; ?>">
            <button class="editar btn btn-secondary" onclick="openEditModalProduto(<?php echo htmlspecialchars(json_encode($produto)); ?>)">Editar <i class="bi bi-pencil-square"></i></button>
            <form action="../controllers/excluir_produto.php" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este produto?');">
                <input type="hidden" name="id_produto" value="<?php echo $produto['id_produto']; ?>">
                <button type="submit" class="delet btn btn-danger">Deletar <i class="bi bi-trash3-fill"></i></button>
            </form>
        </div>
    </div>
<?php endif; ?>

                            <!-- Link para página do produto específico -->
                            <a class="link-prod" href="./subtelas/subProdBC.php?id_produto=<?php echo $produto['id_produto']; ?>">
                                <?php
                                $imagemPath = '/../views/fotos-banco/' . $produto['imagem'];
                                if (file_exists(__DIR__ . $imagemPath)): ?>
                                    <img class="card-GG-img" src="<?php echo htmlspecialchars($imagemPath); ?>" alt="<?php echo htmlspecialchars($produto['nome_produto']); ?>" onerror="this.src='./fotos-banco/sem_foto.png'">
                                <?php else: ?>
                                    <img class="card-GG-img" src="/views/fotos-banco/sem_foto.png" alt="Imagem não disponível">
                                <?php endif; ?>
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

        <?php if (isset($_GET['categoria'])): ?>
                <div class="show-all">
                    <a href="produtos.php#produtos" class="btn btn-secondary">Mostrar Todos os Produtos</a>
                </div>
        <?php endif; ?>
    </section>

        </div>

        
    </section>

<!-- Modal de Edição de Produto -->
<div id="editProductModal" class="edit-product-modal">
    <div class="edit-product-modal-content">
        <span class="close-edit" onclick="closeEditModal()">&times;</span>
        <h2>Editar Produto</h2>
        <form id="editProductForm" method="POST" action="../controllers/editar_produto.php" enctype="multipart/form-data">
            <input type="hidden" id="id_produto_edit" name="id_produto">

            <label for="nome_produto_edit">Nome do Produto:</label>
            <input type="text" id="nome_produto_edit" name="nome_produto" required>

            <label for="descricao_edit">Descrição:</label>
            <textarea id="descricao_edit" name="descricao" required></textarea>

            <label for="preco_edit">Preço:</label>
            <input type="text" id="preco_edit" name="preco" required>

            <label for="quantidade_estoque_edit">Quantidade em Estoque:</label>
            <input type="number" id="quantidade_estoque_edit" name="quantidade_estoque" required>

            <label for="imagem">Imagem:</label>
            <input type="file" id="imagem_edit" name="imagem" accept="image/*">
            <img id="imagem_atual_edit" src="" alt="Imagem Atual" style="width: 100px; height: auto; margin-top: 10px;">

            <label for="categoria_edit">Categoria:</label>
            <input type="text" id="categoria_edit" name="categoria" required>

            <label for="cor_edit">Cor:</label>
            <input type="text" id="cor_edit" name="cor" required>

            <button type="submit">Salvar Alterações</button>
        </form>
    </div>
</div>



<script>
// ----------------MODAL EDITAR E DELETAR [INICIO]-------------------

function openEditModalProduto(produto) {
    document.getElementById('id_produto_edit').value = produto.id_produto;
    document.getElementById('nome_produto_edit').value = produto.nome_produto;
    document.getElementById('descricao_edit').value = produto.descricao;
    document.getElementById('preco_edit').value = produto.preco;
    document.getElementById('quantidade_estoque_edit').value = produto.quantidade_estoque;
    document.getElementById('categoria_edit').value = produto.categoria;
    document.getElementById('cor_edit').value = produto.cor;

    // Imagem atual
    var imagemAtual = document.getElementById('imagem_atual_edit');
    var caminhoImagem = '../views/fotos-banco/' + produto.imagem;
    imagemAtual.src = caminhoImagem;

    var modal = document.getElementById("editProductModal");
    modal.style.display = "block";
}


// Exclusão de produto
function confirmDeletion(idProduto) {
    Swal.fire({
        title: 'Excluir permanentemente?',
        text: "Você não poderá reverter isso!",
        icon: 'warning',
        iconHtml: '<i class="bi bi-exclamation-triangle-fill custom-swal-icon"></i>',
        showCancelButton: true,
        confirmButtonColor: '#E1241D',
        cancelButtonColor: '#CCCCCC',
        confirmButtonText: 'Sim, deletar!',
        cancelButtonText: 'Cancelar',
        customClass: {
            confirmButton: 'botao-confirmar-swal', 
            cancelButton: 'botao-cancelar-swal',
            icon: 'custom-swal-icon'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            // Requisição POST para deletar o produto
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = '../controllers/deletar_produto.php';

            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'id_produto';
            input.value = idProduto;

            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();
        }
    });
}
// ----------------MODAL EDITAR E DELETAR [FIM]-------------------

</script>


    
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
            <!-- Modal do Carrinho -->
            <div class="janela-modal1" id="janela-modal1">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-1">
                        <button class="fechar" id="fechar1"><i id="fechar1" class="bi bi-x-lg"></i></button>
                        <h2>Meu carrinho</h2>  
                        <p class="qtde-itens">Seu carrinho tem 0 itens</p>
                        <div class="linha-modal1"></div>
                        <div class="itens-carrinho" id="itens-carrinho">
                            <!-- Itens do carrinho serão adicionados aqui via JavaScript -->
                        </div>
                        <div class="footer-carrinho">
                            <div class="linha-modal2"></div>
                            <div class="content-carrinho">
                                <p class="total">Total:</p>
                                <p class="preco" id="preco-total">R$00,00</p>
                            </div>
                            <div class="div-finalizar"> 
                                <button class="finalizar" onclick="window.location.href ='./pagamento-1.php'">Finalizar compra</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </main>    

    <?php
    require_once '../footer.php';
    ?>
</body>
</html>