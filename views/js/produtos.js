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