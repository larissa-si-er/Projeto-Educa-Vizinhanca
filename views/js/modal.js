// Função para abrir o modal de adicionar curso
document.getElementById('abrirModalAdicionar').addEventListener('click', function() {
    document.getElementById('modalAdicionar').style.display = 'block';
});

// Função para fechar o modal de adicionar curso
document.getElementById('modalAdicionar').getElementsByClassName('fechar')[0].addEventListener('click', function() {
    document.getElementById('modalAdicionar').style.display = 'none';
});

// Função para fechar o modal de adicionar curso se o usuário clicar fora dele
window.addEventListener('click', function(event) {
    var modalAdicionar = document.getElementById('modalAdicionar');
    if (event.target == modalAdicionar) {
        modalAdicionar.style.display = 'none';
    }
});

// Função para abrir o modal de editar perfil
document.getElementById('abrirModalEditar').addEventListener('click', function() {
    document.getElementById('modalEditar').style.display = 'block';
});

// Função para fechar o modal de editar perfil
document.getElementById('modalEditar').getElementsByClassName('fechar')[0].addEventListener('click', function() {
    document.getElementById('modalEditar').style.display = 'none';
});

// Função para fechar o modal de editar perfil se o usuário clicar fora dele
window.addEventListener('click', function(event) {
    var modalEditar = document.getElementById('modalEditar');
    if (event.target == modalEditar) {
        modalEditar.style.display = 'none';
    }
});