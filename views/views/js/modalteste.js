// Abre o modal ao clicar no botão "Adicionar Curso"
document.getElementById('abrirModal').addEventListener('click', function() {
    document.getElementById('modal').style.display = 'block';
});

// Fecha o modal ao clicar no botão de fechar (X)
document.getElementsByClassName('fechar')[0].addEventListener('click', function() {
    document.getElementById('modal').style.display = 'none';
});

// Fecha o modal se o usuário clicar fora da área do modal
window.addEventListener('click', function(event) {
    var modal = document.getElementById('modal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
});
