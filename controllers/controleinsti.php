<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../views/img/home-ic.png">
    <title>Controle de Instituições</title>
    <link rel="stylesheet" href="../views/css/control.css">
    <script src="../views/js/menu.js"></script>
    <script src="../views/js/script.js"></script>
    <script src="../views/js/modal.js"></script>
        <!--fontawesome-->
        <script src="https://kit.fontawesome.com/6c3bbfdabc.js" crossorigin="anonymous"> </script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>

<header>
            <nav>
                <div class="nav-bar">
                    <i class="bi bi-list sidebarOpen"></i>
                    <span class="logo"><a href="#"><img src="../views/img/Home-removebg-preview.png" alt=""></a></span> 

<div class="block-user">
<i class="bi bi-x sidebarClose"></i>
    <ul class="user-ul" onclick="openModal()">
        <li class="user-li">
            <p id="user">
                <i class="fas fa-user-circle"></i>
                Usuário
                <i class="bi bi-chevron-down" style="cursor:pointer;"></i>
            </p>
            <!-- modal user -->
            <div id="myModal" class="modal-user">
                <span class="close" onclick="closeModal()">&times;</span>
                <div class="modal-content-user">
                    <p><strong>User:</strong> Admin</p>
                    <p><strong>Email:</strong> Admin@example.com</p>
                    <p><strong>Senha:</strong> *********</p>
                    <p>
                        <button id="bnt-user">
                            <!--erro-->
                            <a href="../views/admin/areaadm.php">Meu perfil</a>
                        </button>
                        <button id="bnt-sair"><a href="">sair</a></button>
                    </p>
                </div>
            </div>
        </li>
    </ul>
</div>
                    <div class="user-mobile">
                       <i class="bi bi-person-square"></i>
                    </div>
                </div>               
            </nav>
</header>
<div class="voltar">
  <div class="meu_perfil">
  <ul>
    <li>
    <i class="fa-solid fa-arrow-left" style="margin-top: 0px; display: inline-block;"></i>
    <a href="../views/admin/areaadm.php" style="display: inline-block; vertical-align: top;">Voltar</a>
  </ul>
  </div>
  </div>
  
  <div class="main-container">
    <div class="log-container">
 
        <h2>Controle de instituições</h2>
        
        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Pesquise aqui.">
            <div class="button-pdf" data-tooltip="Baixar">
            <div class="button-wrapper">
               <div class="text">Download</div>
                <span class="icon">
                <a href="../views/admin/relatorios/pdfinsti.php"><i class="fa-solid fa-file-arrow-down" style="color:#fff; font-size:20px;"></i></a>
                </span>
                </div>
            </div>
        </div>
        
        <table class="log-container" id="instiTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Cep</th>
                <th>Complemento</th>
                <th>Número</th>
                <th>Email</th>
                <th>CNPJ</th>
                <th class="actions">Ações</th>
            </tr>
        </thead>
            <tbody>
                <!-- Conteúdo da tabela será preenchido dinamicamente com PHP -->
            </tbody>
        </table>
    </div>
</div>

 <!--script busca-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    function formatDateTime(dateTimeStr) {
        const [datePart, timePart] = dateTimeStr.split(' ');
        const [year, month, day] = datePart.split('-');
        const [hour, minute] = timePart.split(':');
        return `${day}/${month}/${year} ${hour}:${minute}`;
    }

    $('#searchInput').keyup(function(){
        var searchTerm = $(this).val();

        $.ajax({
            url: 'buscar_insti.php', 
            type: 'POST',
            data: {termo: searchTerm}, 
            success: function(response){
                const jsonData = JSON.parse(response);
                $('#instiTable tbody').html("");
                jsonData.forEach(log => {
                    const formattedDate = formatDateTime(log.date);
                    const row = `
                        <tr>
                            <td>${log.id}</td>
                            <td>${log.name}</td>
                            <td>${log.phone}</td>
                            <td>${log.cep}</td>
                            <td>${log.complement}</td>
                            <td>${log.number}</td>
                            <td>${log.email}</td>
                            <td>${log.cnpj}</td>
                            <td class="actions">Ações</td>
                        </tr>
                    `;
                    $('#instiTable tbody').append(row);
                });
            }
        });
    });
});
</script>



</body>
</html>
