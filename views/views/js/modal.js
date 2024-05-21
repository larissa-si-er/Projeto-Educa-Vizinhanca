document.addEventListener('DOMContentLoaded', function() {
    console.log('ativo');

    // Abrir o modal de adicionar curso
    var abrirModalAdicionar = document.getElementById('abrirModalAdicionar');
    if (abrirModalAdicionar) {
        abrirModalAdicionar.addEventListener('click', function() {
            var modalAdicionar = document.getElementById('modalAdicionar');
            if (modalAdicionar) {
                modalAdicionar.style.display = 'block';
                console.log('ativo');
            }
        });
    }

    // Fechar o modal de adicionar curso
    var modalAdicionar = document.getElementById('modalAdicionar');
    if (modalAdicionar) {
        var fecharAdicionar = modalAdicionar.getElementsByClassName('fechar')[0];
        if (fecharAdicionar) {
            fecharAdicionar.addEventListener('click', function() {
                modalAdicionar.style.display = 'none';
            });
        }

        // Fechar o modal de adicionar curso se o usuário clicar fora dele
        window.addEventListener('click', function(event) {
            if (event.target == modalAdicionar) {
                modalAdicionar.style.display = 'none';
            }
        });
    }

    // Abrir o modal de editar perfil
    var abrirModalEditar = document.getElementById('abrirModalEditar');
    if (abrirModalEditar) {
        abrirModalEditar.addEventListener('click', function() {
            var modalEditar = document.getElementById('modalEditar');
            if (modalEditar) {
                modalEditar.style.display = 'block';
            }
        });
    }

    // Fechar o modal de editar perfil
    var modalEditar = document.getElementById('modalEditar');
    if (modalEditar) {
        var fecharEditar = modalEditar.getElementsByClassName('fechar')[0];
        if (fecharEditar) {
            fecharEditar.addEventListener('click', function() {
                modalEditar.style.display = 'none';
            });
        }

        // Fechar o modal de editar perfil se o usuário clicar fora dele
        window.addEventListener('click', function(event) {
            if (event.target == modalEditar) {
                modalEditar.style.display = 'none';
            }
        });
    }
});
