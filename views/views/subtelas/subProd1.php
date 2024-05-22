<?php
require_once '../menuproduto.php';
?>


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

<?php
require_once '../../footer.php';
?>
