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

