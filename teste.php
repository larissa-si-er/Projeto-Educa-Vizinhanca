<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="./img/home-ic.png">
    <title>Feed de Cursos</title>
    <script src="./js/menu.js"></script>
    <link rel="stylesheet" href="./css/testando.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- icones -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
    <style>
        .curso {
            display: none;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div>
    <i class="bi bi-sliders2" id="filter-icon" style="cursor: pointer;"></i><span>Filtro</span>
</div>

<div id="filter-modal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <label for="area-select">Selecione a área:</label>
        <select id="area-select">
            <option value="todos">Todos</option>
            <option value="desenvolvimento-web">Desenvolvimento Web</option>
            <option value="desenvolvimento-ti">Desenvolvimento T.I</option>
            <option value="marketing">Marketing</option>
            <option value="direito">Direito</option>
            <option value="empreendedorismo">Empreendedorismo</option>
            <option value="pedagogia">Pedagogia</option>
        </select>
    </div>
</div>

<div class="container">
    <!-- Seus cards de curso aqui -->
    <div class="curso" id="curso-list" data-area="desenvolvimento-web">
        <img src="./img/img curso 1.png" alt="Curso HTML e CSS" class="curso-img">
        <h2>Aprenda HTML e CSS!</h2>
        <p>Área: Desenvolvimento Web</p>
        <div class="curso-content">
            <p class="instituicao"><i class="bi bi-building"></i>Instituição: Curso em Vídeo</p>
            <p class="localizacao"><i class="bi bi-laptop"></i>Modalidade: Online</p>
            <div class="curso-buttons">
                <a href="https://www.cursoemvideo.com/matricula-gratis" target="_blank" class="botao-acessar">Acessar</a>
                <i class="fa-regular fa-thumbs-up botao-curtir" title="curtir"></i>
                <i class="fa-regular fa-comment-dots botao-comentar" title="comentar"></i>
                <i class="fa-regular fa-bookmark botao-salvar" title="salvar"></i>
                <i class="fa-solid fa-share botao-compartilhar" title="compartilhar"></i>
            </div>
        </div>
    </div>

    <!-- Outros cards aqui -->

    <div class="curso" id="curso-list" data-area="pedagogia">
        <img src="./img/imagem curso 9.png" alt="Curso HTML e CSS" class="curso-img">
        <h2>Formação pedagógica </h2>
        <p>Área: curso pedagógico</p>
        <div class="curso-content">
            <p class="instituicao"><i class="bi bi-building"></i>Instituição: SEBRAE</p>
            <p class="localizacao"><i class="bi bi-laptop"></i>Modalidade: Online</p>
            <div class="curso-buttons">
                <a href="https://sebrae.com.br/sites/PortalSebrae/cursosonline/formacao-pedagogica,55ee16d291e4d710VgnVCM100000d701210aRCRD" target="_blank" class="botao-acessar">Acessar</a>
                <i class="fa-regular fa-thumbs-up botao-curtir" title="curtir"></i>
                <i class="fa-regular fa-comment-dots botao-comentar" title="comentar"></i>
                <i class="fa-regular fa-bookmark botao-salvar" title="salvar"></i>
                <i class="fa-solid fa-share botao-compartilhar" title="compartilhar"></i>
            </div>
        </div>  
    </div> 
</div>

<script>
    function filtrarCursos(area) {
        var cursos = document.querySelectorAll('.curso');
        cursos.forEach(function(curso) {
            if (area === 'todos') {
                curso.style.display = 'block';
            } else if (curso.getAttribute('data-area') === area) {
                curso.style.display = 'block';
            } else {
                curso.style.display = 'none';
            }
        });
    }

    document.getElementById('filter-icon').addEventListener('click', function() {
        var modal = document.getElementById('filter-modal');
        modal.style.display = 'block';
    });

    document.querySelector('.close').addEventListener('click', function() {
        var modal = document.getElementById('filter-modal');
        modal.style.display = 'none';
    });

    document.getElementById('area-select').addEventListener('change', function() {
        var area = this.value;
        filtrarCursos(area);
        var modal = document.getElementById('filter-modal');
        modal.style.display = 'none';
    });

    // Exibir todos os cursos ao carregar a página
    filtrarCursos('todos');

    // Fechar o modal se clicar fora dele
    window.onclick = function(event) {
        var modal = document.getElementById('filter-modal');
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }
</script>

</body>
</html>
