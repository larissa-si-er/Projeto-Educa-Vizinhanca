<?php
require_once '../menuproduto.php'; // Incluir o arquivo que contém a conexão com o banco de dados
include '../../models/conexao.php';

// Verifica se foi enviado um ID de produto via GET
if (isset($_GET['id_produto'])) {
    $id_produto = $_GET['id_produto'];

    // Prepare a consulta para buscar o produto pelo ID especificado
    $sql = "SELECT nome_produto, descricao, preco, imagem FROM produto WHERE id_produto = ?";
    $stmt = $conn->prepare($sql); // Assumindo que $conn está definido no arquivo de conexão
    $stmt->bindParam(1, $id_produto);
    $stmt->execute();
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se o produto foi encontrado
    if (!$produto) {
        echo '<p>Produto não encontrado.</p>';
    } else {
        // Exibir os detalhes do produto encontrado
        $imagemPath = '/../views/fotos-banco/' . $produto['imagem'];
        ?>

        <div class="product">
            <div class="product-details">
                <h2><?php echo htmlspecialchars($produto['nome_produto']); ?></h2>
                <h1 class="Dica"><?php echo htmlspecialchars($produto['descricao']); ?></h1>
                <h1 class="price">R$<?php echo number_format($produto['preco'], 2, ',', '.'); ?></h1>
                <!-- Exemplo para parcelamento -->
                <h1 class="Parcela">Ou em 4x R$<?php echo number_format($produto['preco'] / 4, 2, ',', '.'); ?></h1>
                <br>
                <a href="../../views/produtos.php"><button id="add-to-cart">Volte a tela de produtos</button></a>
            </div>
            <div class="product-images">
                <div class="main-image">
                    <img id="main-image" src="<?php echo htmlspecialchars($imagemPath); ?>" alt="Product Image">
                </div>
            </div>
        </div>

    <?php
    }
} else {
    // Se não foi enviado um ID de produto via GET, mostra uma mensagem para selecionar um produto
    echo '<p>Por favor, selecione um produto.</p>';
}

require_once '../../footer.php'; // Inclui o rodapé da página
?>
  <script src="../js/subtelas_produtos.js"></script>
