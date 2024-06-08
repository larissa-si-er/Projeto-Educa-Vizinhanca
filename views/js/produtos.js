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