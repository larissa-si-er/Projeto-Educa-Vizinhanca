<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../views/img/home-ic.png">
    <title>Controle de Instituições</title>
    <link rel="stylesheet" href="../views/css/control-I.css">
    <script src="../views/js/menu.js"></script>
    <script src="../views/js/script.js"></script>
    <script src="../views/js/modal.js"></script>
    <!-- Fontawesome -->
    <script src="https://kit.fontawesome.com/6c3bbfdabc.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
<?php
session_start();

// Verifica se o usuário não está logado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redireciona para a página de login
    header('Location: ../views/auth/login.php');
    exit();
}

$primeiroNome = $_SESSION['first_name'] ?? '';

// var_dump($_SESSION);

?>
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
                            <?php echo htmlspecialchars($primeiroNome); ?>
                            <i class="bi bi-chevron-down" style="cursor:pointer;"></i>
                        </p>
                    </li>
                </ul>
            </div>
                        <!-- modal user -->
                        <div id="myModal" class="modal-user">
                            <span class="close" onclick="closeModal()">&times;</span>
                            <div class="modal-content-user">
                                <?php
                                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && isset($_SESSION['user_data'])) {
                                    $user = $_SESSION['user_data'];
                                    echo '<p id="modal"><strong>User:</strong> ' . htmlspecialchars($user['usuario']) . '</p>';
                                    echo '<p id="modal"><strong>Email:</strong> ' . htmlspecialchars($user['email']) . '</p>';
                                    echo '<p id="modal"><strong>Senha:</strong> *********</p>';
                                } else {
                                    echo '<p><strong>User:</strong> Não logado</p>';
                                    echo '<p><strong>Email:</strong> Não logado</p>';
                                }
                                ?>
                                <button id="bnt-user">
                                    <a href="../views/admin/areaadm.php">Meu perfil</a>
                                </button>
                                <form action="./userController.php" method="post">
                                    <input type="hidden" name="logout">
                                    <button type="submit" id="bnt-sair">Sair</button>
                                </form>
                            </div>
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
            </li>
        </ul>
    </div>
</div>
<div class="main-container">
    <div class="log-container">
        <h2>Controle de Instituições</h2>
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
                    <th>Instituição</th>
                    <th>Telefone</th>
                    <th>Celular</th>
                    <th>Email</th>
                    <th>CNPJ</th>
                    <th>CEP</th>
                    <th class="actions">Ações</th>
                </tr>
            </thead>
            <tbody>
                <!-- Conteúdo da tabela será preenchido dinamicamente com PHP -->
            </tbody>
        </table>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#searchInput').keyup(function() {
        var searchTerm = $(this).val();
        console.log("Search term: ", searchTerm);  // Debug: log the search term
        $.ajax({
            url: 'buscar_insti.php',
            type: 'POST',
            data: { termo: searchTerm },
            success: function(response) {
                console.log("Response: ", response);  // Debug: log the response
                $('#instiTable tbody').html(response);
                addViewDetailsEvent();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("AJAX Error: ", textStatus, errorThrown);  // Debug: log any errors
            }
        });
    });

    function addViewDetailsEvent() {
        document.querySelectorAll('.view-details').forEach(function(button) {
            button.addEventListener('click', function() {
                var id = this.getAttribute('data-id');
                var details = document.getElementById('details-' + id);
                if (details.style.display === 'none' || details.style.display === '') {
                    details.style.display = 'table-row';
                } else {
                    details.style.display = 'none';
                }
            });
        });
    }
});
</script>
</body>
</html>
