// NAV 
document.addEventListener("DOMContentLoaded", function() {
    const body = document.querySelector("body"),
        nav = document.querySelector("nav"),
        menu = document.querySelector(".menu"),
        sidebarClose = document.querySelector(".sidebarClose"),
        sidebarOpen = document.querySelector(".sidebarOpen");

    sidebarOpen.onclick = () => {
        nav.classList.add("ativo");
        console.log('online nav');
    };

    body.onclick = e => {
        let clickedElm = e.target;

        if (!clickedElm.classList.contains("sidebarOpen") && !clickedElm.classList.contains("menu")) {
            nav.classList.remove("ativo");
        }
    };
});

// MODAL ABRIR CARRINHO
function abrirCarrinho(){
    const modal = document.getElementById('janela-modal1')
    modal.classList.add('abrir') 

    modal.addEventListener('click', (e) => {
        if (e.target.id == 'fechar1' || e.target.id == 'janela-modal1'){
            modal.classList.remove('abrir')
        }
    })
}

// Abrir o modal de AdicionarP perfil

    // Selecionar o botão de abrir modal e o modal em si
    var abrirModalProduto = document.getElementById('#abrirModalProduto');
    var modalAdicionarP = document.getElementById('#modalAdicionarP');

    // Verificar se ambos os elementos existem
    if (abrirModalProduto && modalAdicionarP) {
        // Adicionar evento de clique ao botão de abrir modal
        abrirModalProduto.addEventListener('click', function() {
            modalAdicionarP.style.display = 'block'; // Exibir o modal ao clicar no botão
        });

        // Selecionar o botão de fechar modal
        var fecharModalProduto = modalAdicionarP.getElementsByClassName('fechar')[0];

        // Verificar se o botão de fechar modal existe
        if (fecharModalProduto) {
            // Adicionar evento de clique ao botão de fechar modal
            fecharModalProduto.addEventListener('click', function() {
                modalAdicionarP.style.display = 'none'; // Ocultar o modal ao clicar no botão de fechar
            });
        }

        // Fechar o modal se o usuário clicar fora dele
        window.addEventListener('click', function(event) {
            if (event.target == modalAdicionarP) {
                modalAdicionarP.style.display = 'none';
            }
        });
    }

// CARINHO
document.addEventListener("DOMContentLoaded", () => {
    // Elementos do DOM
    const modal = document.getElementById("janela-modal1");
    const fecharBtn = document.getElementById("fechar1");
    const itensCarrinhoContainer = document.getElementById("itens-carrinho");
    const totalElement = document.getElementById("preco-total");
    const qtdeItensElement = document.querySelector(".qtde-itens");

    // Array para armazenar itens do carrinho
    let carrinho = [];

    // Event listeners para cada botão "Adicionar ao Carrinho"
    document.querySelectorAll(".add-carrinho").forEach(button => {
        button.addEventListener("click", (event) => {
            // Encontrar o card do produto pai
            const produtoCard = event.target.closest(".card-GG");
            const nomeProduto = produtoCard.querySelector(".title-card-GG").innerText;
            const precoProduto = parseFloat(produtoCard.querySelector(".preco-card-GG").innerText.replace("R$", "").replace(",", "."));
            
            // Verificar se o produto já está no carrinho
            const produtoNoCarrinho = carrinho.find(item => item.nome === nomeProduto);
            
            // Se já estiver no carrinho, aumentar a quantidade; senão, adicioná-lo
            if (produtoNoCarrinho) {
                produtoNoCarrinho.quantidade += 1;
            } else {
                carrinho.push({ nome: nomeProduto, preco: precoProduto, quantidade: 1 });
            }

            // Atualizar o carrinho e abrir o modal
            atualizarCarrinho();
            abrirModal();
        });
    });

    // Event listener para fechar o modal
    fecharBtn.addEventListener("click", () => {
        fecharModal();
    });

    // Função para atualizar o conteúdo do carrinho no modal
    function atualizarCarrinho() {
        itensCarrinhoContainer.innerHTML = "";
        let total = 0;

        // Percorrer todos os itens no carrinho
        carrinho.forEach(item => {
            const itemElement = document.createElement("div");
            itemElement.classList.add("item-carrinho");
            itemElement.innerHTML = `
                <span class="nome-produto">${item.nome}</span>
                <div class="controle-quantidade">
                    <button class="diminuir-quantidade">-</button>
                    <span class="quantidade">${item.quantidade}</span>
                    <button class="aumentar-quantidade">+</button>
                </div>
                <span class="preco-produto">R$${(item.preco * item.quantidade).toFixed(2).replace(".", ",")}</span>
            `;

            // Event listener para diminuir a quantidade do item
            itemElement.querySelector(".diminuir-quantidade").addEventListener("click", () => {
                item.quantidade -= 1;
                if (item.quantidade === 0) {
                    carrinho = carrinho.filter(carrinhoItem => carrinhoItem !== item);
                }
                atualizarCarrinho();
            });

            // Event listener para aumentar a quantidade do item
            itemElement.querySelector(".aumentar-quantidade").addEventListener("click", () => {
                item.quantidade += 1;
                atualizarCarrinho();
            });

            // Adicionar o elemento do item ao container de itens do carrinho
            itensCarrinhoContainer.appendChild(itemElement);
            total += item.preco * item.quantidade;
        });

        // Atualizar o total e a quantidade de itens no modal
        totalElement.innerText = `R$${total.toFixed(2).replace(".", ",")}`;
        qtdeItensElement.innerText = `Seu carrinho tem ${carrinho.length} itens`;
    }

    // Função para abrir o modal
    function abrirModal() {
        modal.style.display = "block";
    }

    // Função para fechar o modal
    function fecharModal() {
        modal.style.display = "none";
    }
});

// MODAL FEED (CONFIGURAÇOES) [inicio]
function toggleMenu(element) {
    var dropdownMenu = element.querySelector('.dropdown-menu');
    dropdownMenu.classList.toggle('show');
}
// MODAL FEED (CONFIGURAÇOES) [fim]


