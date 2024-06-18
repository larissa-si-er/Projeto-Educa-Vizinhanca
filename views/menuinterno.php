<?php
// Verifica se a sessão não está ativa antes de iniciar
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica se o usuário não está logado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redireciona para a página de login
    header('Location: ../views/auth/login.php');
    exit();
}

$primeiroNome = $_SESSION['first_name'] ?? '';

?>

<header>
    <link rel="stylesheet" href="../css/control.css">
    <link rel="stylesheet" href="../views/css/control.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="../js/menu.js"></script>

    <nav>
        <div class="nav-bar">
            <i class="bi bi-list sidebarOpen"></i>
            <span class="logo"><a href="#"><img src="../../views/img/Home-removebg-preview.png" alt=""></a></span>

            <div class="block-user">
                <i class="bi bi-x sidebarClose"></i>
                <ul class="user-ul user-ul-block" onclick="openModal()">
                    <li class="user-li user-li-block">
                        <p id="user">
                            <i class="fas fa-user-circle"></i>
                            <?php echo htmlspecialchars($primeiroNome); ?>
                            <i class="bi bi-chevron-down" style="cursor:pointer;"></i>
                        </p>

                    </li>
                </ul>
            </div>
                        <!-- modal user -->
                        <div id="myModal" class="modal-user" style="margin-top: 26%;">
                            <span class="close" onclick="closeModal()">&times;</span>
                            <div class="modal-content-user">
                                <?php
                                // Verifica se o usuário está logado
                                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && isset($_SESSION['user_data'])) {
                                    $user = $_SESSION['user_data'];
                                    echo '<p id="modal"><strong>User:</strong> ' . htmlspecialchars($user['usuario']) . '</p>';
                                    echo '<p id="modal"><strong>Email:</strong> ' . htmlspecialchars($user['email']) . '</p>';
                                    echo '<p id="modal"><strong>Senha:</strong> *********</p>';
                                } else {
                                    // Usuário não está logado
                                    echo '<p><strong>User:</strong> Não logado</p>';
                                    echo '<p><strong>Email:</strong> Não logado</p>';
                                }
                                ?>
                                <button id="bnt-user">
                                    <!--erro-->
                                    <a href="../views/admin/areaadm.php">Meu perfil</a>
                                </button>
                                <form action="../controllers/userController.php" method="post">
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
