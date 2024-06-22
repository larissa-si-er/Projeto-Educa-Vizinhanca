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

//modal editar perfil
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

    // Função para formatar telefone celular
    document.getElementById('phone').addEventListener('input', function (e) {
        var x = e.target.value.replace(/\D/g, '').match(/(\d{2})(\d{5})(\d{4})/);
        if (x) {
            e.target.value = '+55(' + x[1] + ')' + x[2] + '-' + x[3];
        }
    });

    // Função para formatar telefone fixo
    document.getElementById('phone_fixed').addEventListener('input', function (e) {
        var x = e.target.value.replace(/\D/g, '').match(/(\d{2})(\d{4})(\d{4})/);
        if (x) {
            e.target.value = '+55(' + x[1] + ')' + x[2] + '-' + x[3];
        }
    });

    // Função para formatar CPF
    document.getElementById('cpf').addEventListener('input', function (e) {
        var x = e.target.value.replace(/\D/g, '').match(/(\d{3})(\d{3})(\d{3})(\d{2})/);
        if (x) {
            e.target.value = x[1] + '.' + x[2] + '.' + x[3] + '-' + x[4];
        }
    });

    // Função para buscar informações do CEP
    document.getElementById('cep').addEventListener('blur', function (e) {
        var cep = e.target.value.replace(/\D/g, '');
        if (cep.length === 8) {
            fetch(`https://viacep.com.br/ws/${cep}/json/`)
                .then(response => response.json())
                .then(data => {
                    if (!data.erro) {
                        document.getElementById('address').value = `${data.logradouro}, ${data.bairro}, ${data.localidade} - ${data.uf}`;
                    } else {
                        alert('CEP não encontrado!');
                    }
                })
                .catch(error => {
                    console.error('Erro ao buscar o CEP:', error);
                    alert('Erro ao buscar o CEP!');
                });
        } else {
            alert('CEP inválido!');
        }
    });

    // Função para atualizar dados
    function updateData() {
        var formData = new FormData(document.getElementById('editForm'));
        fetch('update_student.php', {
            method: 'POST',
            body: formData
        }).then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Dados atualizados com sucesso!');
                modalEditar.style.display = "none";
            } else {
                alert('Erro ao atualizar dados!');
            }
        })
        .catch(error => {
            console.error('Erro ao atualizar dados:', error);
            alert('Erro ao atualizar dados!');
        });
    }

//modal editar perfil [FIM]


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

