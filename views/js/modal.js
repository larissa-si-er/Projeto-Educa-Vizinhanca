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

// MODAL ADD PRODUTO [INICIO]

        // Abrir o modal de adicionar curso
        var abrirModalAdicionar = document.getElementById('abrirModalProduto');
        if (abrirModalAdicionar) {
            abrirModalAdicionar.addEventListener('click', function() {
                var modalAdicionar = document.getElementById('modalAdicionarP');
                if (modalAdicionar) {
                    modalAdicionar.style.display = 'block';
                    console.log('ativo');
                }
            });
        }

        // Fechar o modal de adicionar curso
        var modalAdicionar = document.getElementById('modalAdicionarP');
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
// MODAL ADD PRODUTO [FIM]
    

 
});




// modal user
function openModal() {
    document.getElementById('myModal').style.display = 'block';
}

function closeModal() {
    document.getElementById('myModal').style.display = 'none';
}

window.onclick = function(event) {
    if (event.target == document.getElementById('myModal')) {
        document.getElementById('myModal').style.display = 'none';
    }
}

// Adiciona um evento de clique para o ícone de fechar
document.querySelector('.sidebarClose').addEventListener('click', closeModal);

    

/*filtro feed*/
function filtrarCursos() {
    var area = document.getElementById('area-select').value;
    var modalidade = document.getElementById('modalidade-select').value;
    var regiao = document.getElementById('regiao-select').value;
    
    var cursos = document.querySelectorAll('.curso');
    var count = 0;
    
    cursos.forEach(function(curso) {
        var cursoArea = curso.getAttribute('data-area');
        var cursoModalidade = curso.getAttribute('data-modalidade');
        var cursoRegiao = curso.getAttribute('data-regiao');

        if ((area === 'todos' || cursoArea === area) &&
            (modalidade === 'todos' || cursoModalidade === modalidade) &&
            (regiao === 'todos' || cursoRegiao === regiao)) {
            curso.style.display = 'block';
            count++;
        } else {
            curso.style.display = 'none';
        }
    });
    
    var noResults = document.querySelector('.no-results');
    if (count === 0) {
        noResults.style.display = 'block';
    } else {
        noResults.style.display = 'none';
    }
}

document.getElementById('filter-icon').addEventListener('click', function() {
    var modal = document.getElementById('filter-modal');
    modal.style.display = 'block';
});

document.querySelector('.closeFilter').addEventListener('click', function() {
    var modal = document.getElementById('filter-modal');
    console.log('Botão fechar clicado');
    modal.style.display = 'none';
    console.log('Modal fechado');
});





document.getElementById('area-select').addEventListener('change', function() {
    filtrarCursos();
});

document.getElementById('modalidade-select').addEventListener('change', function() {
    filtrarCursos();
});

document.getElementById('regiao-select').addEventListener('change', function() {
    filtrarCursos();
});

// Exibir todos os cursos ao carregar a página
filtrarCursos();

// Fechar o modal se clicar fora dele
window.onclick = function(event) {
    var modal = document.getElementById('filter-modal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}


// MODAL FEED (CONFIGURAÇOES) [inicio]
function toggleMenu(icon) {
    var controlConfig = icon.parentElement;
    
    var dropdownMenu = controlConfig.querySelector('.dropdown-menu');

    dropdownMenu.classList.toggle('show-menu');
}
// MODAL FEED (CONFIGURAÇOES) [fim]

