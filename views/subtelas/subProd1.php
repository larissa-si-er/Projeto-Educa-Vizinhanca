<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../img/home-ic.png">
    <title>Detalhes do Produto</title>
    <link rel="stylesheet" href="../css/subProdutos.css">
    <script src="../js/subProdutos.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <header>
        <nav>
            <div class="nav-bar">
                <i class="bi bi-list sidebarOpen"></i>
                
                <span class="logo"><a href="#"><img src="../img/Home-removebg-preview.png" alt=""></a></span>
                <div class="group>
                    <i class="fa-solid fa-magnifying-glass id="search"></i>

                    <input placeholder="Busque aqui os produtos do site." type="search" class="input">
                </div>
                  
                <div class="menu">
                    <i class="bi bi-x sidebarClose"></i>

                    <ul class="nav-links">
                        <li><a href="../auth/login.php">
                            <p class="user-log"><i class="bi bi-chevron-down"></i> Usuário 
                              <i class="bi bi-person-circle"></i>
                            </p> 
                            </a>
                        </li>
                        <li><a href="../produtos.php">Produtos</a></li>
                        <li><a href="../../index.php">Sair</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="product">
        <div class="product-details">
            <h2>Caderno EducaWorld</h2>
            <h1 class="Dica">100 folhas<br>
            </h1>
            <h1> <class="price">R$34,99 </h1>
            <h1 class="Parcela">Ou em 2x R$17,50</h1>
            <div class="quantity-selection">
                <label for="quantity">Quantidade:</label>
                <div class="quantity-input">
                    <button id="decrement">-</button>
                    <input type="number" id="quantity" value="0" min="0">
                    <button id="increment">+</button>
                </div>
            </div>
            <button id="add-to-cart">Adicionar ao Carrinho</button>
        </div>
        <div class="product-images">
            <div class="main-image">
                <img id="main-image" src="../img/Educa World Capa.png" alt="Product Image">
            </div>
            <div class="thumbnail-images">
                <img class="thumbnail" src="../img/Caderno EducaWorld.png" alt="Purple Product">
                <img class="thumbnail" src="../img/Caderno Educa World Back.png" alt="Rose Product">
                              
            </div>
        </div>
    </div>
</body>
</html>

