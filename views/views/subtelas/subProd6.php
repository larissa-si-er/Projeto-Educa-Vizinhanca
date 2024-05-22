<?php
require_once '../menuproduto.php';
?>
    <div class="product">
        <div class="product-details">
            <h2>Garrafa Térmica White Star 600ml</h2>
            <h1 class="Dica">Inox<br>Suporta 600ml
            </h1>
            <h1> <class="price">R$89,99 </h1>
            <h1 class="Parcela">Ou em 4x R$22,50</h1>
            <div class="quantity">
                <label for="quantity">Quantidade:</label>
                <div class="quantity-input">
                    <button id="decrement">-</button>
                    <input type="number" id="quantity" value="0" min="0">
                    <button id="increment">+</button>
                </div>
            </div> <br>
            <button id="add-to-cart">Adicionar ao Carrinho</button>
        </div>
        <div class="product-images">
            <div class="main-image">
                <img id="main-image" src="../img/Garrafa White Star.png" alt="Product Image">
             </div>
        </div>
    </div>
<?php
require_once '../../footer.php';
?>
