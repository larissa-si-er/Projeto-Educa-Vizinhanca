<?php
require_once '../menuproduto.php';
?>


    <div class="product">
        <div class="product-details">
            <h2>Garrafa Térmica Hydro Flask 500ml</h2>
            <h1 class="Dica">Inox<br>Suporta 500ml
            </h1>
            <h1> <class="price">R$79,99 </h1>
            <h1 class="Parcela">Ou em 4x R$19,99</h1>
            <div class="color-selection">
                <label for="color">Selecione a cor:</label>
                <select id="color">
                    <option value="1">Roxo</option>
                    <option value="3">Verde</option>
                    <option value="4">Violeta</option>
                    <option value="5">Chocolate</option>
                    <option value="6">Cinza</option>
        
                </select>
            </div>
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
                <img id="main-image" src="../img/images.jpg" alt="Product Image">
            </div>
            <div class="thumbnail-images">
                <img class="thumbnail" src="../img/1-garrafa.png" alt="Purple Product">
                <img class="thumbnail" src="../img/2-garrafa.png" alt="Rose Product">
                <img class="thumbnail" src="../img/3-garrafa.png" alt="Green Product">
                <img class="thumbnail" src="../img/4.png" alt="Violet Product">
                <img class="thumbnail" src="../img/5.png" alt="Brown Product">
                <img class="thumbnail" src="../img/6.png" alt="Blue Product">                
            </div>
        </div>
    </div>
    <script src="../js/subtelas_produtos.js"></script>
</body>
</html>
<?php
require_once '../../footer.php';
?>
