<?php
require_once '../menuproduto.php';

// Verifique se o parâmetro id_produto está presente na URL
if (isset($_GET['id_produto'])) {
    // Prepare a consulta para buscar o produto pelo ID especificado
    $sql = "SELECT nome_produto, descricao, preco, imagem FROM produto WHERE id_produto = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $_GET['id_produto']);
    $stmt->execute();
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$produto) {
        // Caso o produto não seja encontrado pelo ID especificado
        echo '<p>Produto não encontrado.</p>';
    }
} else {
    // Caso o parâmetro id_produto não seja passado na URL, busque e exiba o primeiro produto encontrado no banco de dados
    $sql = "SELECT nome_produto, descricao, preco, imagem FROM produto LIMIT 1"; // Ajuste conforme a sua lógica de ordenação

    if (!$produto) {
        // Caso não haja nenhum produto no banco de dados
        echo '<p>Nenhum produto encontrado.</p>';
    }
}

// Verificar se $produto está definido antes de exibi-lo
if (isset($produto) && $produto) {
    $imagemPath = '/../views/fotos-banco/' . $produto['imagem'];
?>
    <div class="product">
        <div class="product-details">
            <h2><?php echo htmlspecialchars($produto['nome_produto']); ?></h2>
            <h1 class="Dica"><?php echo htmlspecialchars($produto['descricao']); ?></h1>
            <h1 class="price">R$<?php echo number_format($produto['preco'], 2, ',', '.'); ?></h1>
            <!-- Exemplo para parcelamento -->
            <h1 class="Parcela">Ou em 4x R$<?php echo number_format($produto['preco'] / 4, 2, ',', '.'); ?></h1>
            <div class="quantity">
                <label for="quantity">Quantidade:</label>
                <div class="quantity-input">
                    <button id="decrement">-</button>
                    <input type="number" id="quantity" value="0" min="0">
                    <button id="increment">+</button>
                </div>
            </div>
            <br>
            <button id="add-to-cart">Adicionar ao Carrinho</button>
        </div>
        <div class="product-images">
            <div class="main-image">
                <img id="main-image" src="<?php echo htmlspecialchars($imagemPath); ?>" alt="Product Image">
            </div>
        </div>
    </div>
<?php
}

require_once '../../footer.php';
?>
