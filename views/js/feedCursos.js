// ----------------MODAL EDITAR E DELETAR [INICIO]-------------------

//    function openEditModal(curso) {
//         document.getElementById('id_curso_edit').value = curso.id_curso;
//         document.getElementById('nome_curso_edit').value = curso.nome_curso;
//         document.getElementById('areacurso_edit').value = curso.areacurso;
//         document.getElementById('instituicao_edit').value = curso.instituicao;
//         document.getElementById('formato_edit').value = curso.formato;
//         document.getElementById('linksite_edit').value = curso.linksite;
       
//         // imagem atual
//         var imagemAtual = document.getElementById('imagem_atual_edit');
//         var caminhoImagem = '../views/fotos-banco/' + curso.fotocurso;
//         imagemAtual.src = caminhoImagem;
       
//         var modal = document.getElementById("editModal");
//         modal.style.display = "block";
//     }
function openEditModal(curso) {
    document.getElementById('id_curso_edit').value = curso.id_curso;
    document.getElementById('nome_curso_edit').value = curso.nome_curso;
    document.getElementById('descricao_edit').value = curso.descricao;
    document.getElementById('areacurso_edit').value = curso.areacurso;
    document.getElementById('instituicao_edit').value = curso.instituicao;
    document.getElementById('formato_edit').value = curso.formato;
    document.getElementById('linksite_edit').value = curso.linksite;
    document.getElementById('quantidadevagas_edit').value = curso.quantidadevagas;
    document.getElementById('tipocurso_edit').value = curso.tipocurso;
    document.getElementById('duracao_edit').value = curso.duracao;
    document.getElementById('turno_edit').value = curso.turno;
    document.getElementById('localidade_edit').value = curso.localidade;
    document.getElementById('inicioinscricoes_edit').value = curso.inicioinscricoes;
    document.getElementById('terminoinscricoes_edit').value = curso.terminoinscricoes;

        // imagem atual
        var imagemAtual = document.getElementById('imagem_atual_edit');
        var caminhoImagem = '../views/fotos-banco/' + curso.fotocurso;
        imagemAtual.src = caminhoImagem;
   
        var modal = document.getElementById("editModal");
        modal.style.display = "block";
}

        
    // Fechar o modal 
    document.getElementsByClassName("close-edit")[0].onclick = function() {
         document.getElementById("editModal").style.display = "none";
    }
        
    // Fechar o modal PT2
    window.onclick = function(event) {
        var modal = document.getElementById("editModal");
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
        
    // exclusão card
    function confirmDeletion(idCurso) {
        Swal.fire({
            title: 'Excluir permanentemente?',
            text: "Você não poderá reverter isso!",
            icon: 'warning',
            iconHtml: '<i class="bi bi-exclamation-triangle-fill custom-swal-icon"></i>',
            showCancelButton: true,
            confirmButtonColor: '#E1241D',
            cancelButtonColor: '#CCCCCC',
            confirmButtonText: 'Sim, deletar!',
            cancelButtonText: 'Cancelar',
            customClass: {
                confirmButton: 'botao-confirmar-swal', 
                cancelButton: 'botao-cancelar-swal',
                icon: 'custom-swal-icon' 
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // requisição POST para deletar o curso
                var form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '../controllers/deletar_curso.php';
        
                    var input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'id_curso';
                    input.value = idCurso;
        
                    form.appendChild(input);
                    document.body.appendChild(form);
                    form.submit();
            }
        });
    }
// ----------------MODAL EDITAR E DELETAR [FIM]-------------------


// ----------------MODAL DETALHES [INICIO]-------------------
function toggleDescription(link) {
    var descricaoCompleta = link.previousElementSibling; 
    var descricaoResumida = descricaoCompleta.previousElementSibling; 
    if (descricaoCompleta.style.display === 'none') {
        descricaoResumida.style.display = 'none';
        descricaoCompleta.style.display = 'block';
        link.innerText = 'Ver menos';
    } else {
        descricaoCompleta.style.display = 'none';
        descricaoResumida.style.display = 'block';
        link.innerText = 'Ver mais';
    }
}



function openDetalhesModal(curso) {
    document.getElementById('detalhesNomeCurso').textContent = curso.nome_curso;
    document.getElementById('detalhesInstituicao').textContent = curso.instituicao;
    document.getElementById('detalhesModalidade').textContent = curso.formato;
    document.getElementById('detalhesDescricao').textContent = curso.descricao;
    document.getElementById('detalhesLocalizacao').textContent = curso.localidade;
    document.getElementById('detalhesTipoCurso').textContent = curso.tipocurso;
    document.getElementById('detalhesVagas').textContent = curso.quantidadevagas;
    document.getElementById('detalhesDuracao').textContent = curso.duracao;
    document.getElementById('detalhesTurno').textContent = curso.turno;
    document.getElementById('detalhesInicioInscricoes').textContent = formatarData(curso.inicioinscricoes);
    document.getElementById('detalhesTerminoInscricoes').textContent = formatarData(curso.terminoinscricoes);            

    var modal = document.getElementById("detalhesModal");
    modal.style.display = "block";
    }

    function closeDetalhesModal() {
        var modal = document.getElementById("detalhesModal");
        modal.style.display = "none";
    }

    //  dd/mm/yyyy
    function formatarData(data) {
        const partesData = data.split('-');
        const ano = partesData[0];
        const mes = partesData[1];
        const dia = partesData[2];
        return `${dia}/${mes}/${ano}`;
    }

    window.onclick = function(event) {
        var modal = document.getElementById("detalhesModal");
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
// ----------------MODAL DETALHES [FIM]-------------------


// ----------------COMMENTS [INICIO]-------------------
let commentsPerPage = 5;

function toggleComments(id_curso) {
    var comentariosContainer = document.getElementById('comentarios-curso-' + id_curso);
    if (comentariosContainer.style.display === 'none') {
        comentariosContainer.style.display = 'block';
        fetchComentarios(id_curso, 1); // Carrega os comentários ao abrir
    } else {
        comentariosContainer.style.display = 'none';
    }
}

function fetchComentarios(id_curso, page) {
    fetch(`../controllers/feed/comentarioController.php?id_curso=${id_curso}&page=${page}&limit=${commentsPerPage}`)
        .then(response => response.json())
        .then(data => {
            var comentariosDiv = document.getElementById('lista-comentarios-' + id_curso);
            if (page === 1) {
                comentariosDiv.innerHTML = ''; 
            }

            if (data.error) {
                comentariosDiv.innerHTML = `<p>${data.error}</p>`;
                return;
            }

            if (data.comentarios.length === 0 && page === 1) {
                comentariosDiv.innerHTML = `<p>Sem comentários para este curso.</p>`;
            } else {
                data.comentarios.forEach(comentario => {
                    var comentarioHtml = `
                        <div class="comentario">
                            <p>${comentario.texto}</p>
                            <small>Postado por ${comentario.usuario} em ${comentario.data_time}</small>
                        </div>
                    `;
                    comentariosDiv.innerHTML += comentarioHtml;
                });
            }

            var loadMoreDiv = document.getElementById('load-more-' + id_curso);
            if (data.hasMore) {
                loadMoreDiv.style.display = 'block';
                loadMoreDiv.dataset.page = page + 1;
            } else {
                loadMoreDiv.style.display = 'none';
            }
        })
        .catch(error => {
            console.error('Erro ao carregar comentários:', error);
        });
}

function loadMoreComentarios(id_curso) {
    var loadMoreDiv = document.getElementById('load-more-' + id_curso);
    var nextPage = loadMoreDiv.dataset.page || 2;
    fetchComentarios(id_curso, parseInt(nextPage));
}

function enviarComentario(id_curso) {
    var form = document.getElementById('form-comentario-' + id_curso);
    var comentarioInput = form.querySelector('.comentario-input');

    var formData = new FormData();
    formData.append('id_curso', id_curso);
    formData.append('comentario', comentarioInput.textContent);

    fetch('../controllers/feed/comentarioController.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        fetchComentarios(id_curso, 1); // Recarrega os comentários
        comentarioInput.textContent = ''; // Limpa o campo de comentário
    })
    .catch(error => {
        console.error('Erro ao enviar comentário:', error);
    });
}
// ---------------- COMMENTS [FIM]-------------------


// ---------------- PESQUISA [INICIO]-------------------
document.querySelector('.input').addEventListener('input', function() {
    if (this.value === '') {
        document.getElementById('searchForm').submit();
    }
});
// ---------------- PESQUISA [FIM]-------------------


// ---------------- CURTIDA [INICIO]-------------------
function curtirCurso(id_curso) {
    // Realiza uma requisição AJAX para enviar a curtida para o servidor
    fetch('../controllers/curtidaController.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            id_curso: id_curso
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Atualiza a interface para refletir a curtida
            const botaoCurtir = document.querySelector(`.botao-curtir[title="Curtir"][onclick="curtirCurso(${id_curso})"]`);
            botaoCurtir.classList.add('curtido');
            // Exemplo: adicionar feedback visual
            // alert('Curso curtido com sucesso!');
        } else {
            alert('Erro ao curtir o curso. Tente novamente.');
        }
    })
    .catch(error => {
        console.error('Erro na requisição:', error);
        alert('Erro ao curtir o curso. Tente novamente.');
    });
}
