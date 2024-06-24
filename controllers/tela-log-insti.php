<?php

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../views/auth/login.php');
    exit();
}

$primeiroNome = $_SESSION['first_name'] ?? '';

?>  
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../views/img/home-ic.png">
    <title>Tela de Logs</title>
    <link rel="stylesheet" href="../views/css/log.css">
    <script src="../views/js/menu.js"></script>
    <script src="../views/js/script.js"></script>
    <script src="../views/js/modal.js"></script>
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
        <i class="fa-solid fa-user-shield"></i>
        <h2>Registros de Login</h2>
        <div class="search-bar">
            <input type="text" id="search-input" placeholder="Buscar por CNPJ ou nome ">
            <button id="search-button">Buscar</button>
            <button id="show-all-button">Mostrar Todos</button>
        </div>
        <table id="log-table">
            <thead>
                <tr>
                    <th>Data e Hora</th>
                    <th>Nome</th>
                    <th>CNPJ</th>
                    <th>Fator de Autenticação</th>
                </tr>
            </thead>
            <tbody id="log-entries">
                <!-- As linhas da tabela serão preenchidas aqui -->
            </tbody>
        </table>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Função para buscar os dados
    function fetchData() {
        fetch('fetch_data_insti.php')
            .then(response => response.json())
            .then(data => {
                let tableBody = document.getElementById('log-entries');
                tableBody.innerHTML = ''; // Limpar o corpo da tabela

                data.forEach(entry => {
                    let row = document.createElement('tr');

                    // Formatação da data
                    let dateCell = document.createElement('td');
                    dateCell.textContent = formatarData(entry.registro); // Chamada para a função de formatação
                    row.appendChild(dateCell);

                    let nameCell = document.createElement('td');
                    nameCell.textContent = entry.nome_insti;
                    row.appendChild(nameCell);

                    let cnpjCell = document.createElement('td');
                    cnpjCell.textContent = entry.cnpj;
                    row.appendChild(cnpjCell);

                    let authFactorCell = document.createElement('td');
                    authFactorCell.textContent = entry.auth_factor;
                    row.appendChild(authFactorCell);

                    tableBody.appendChild(row);
                });
            })
            .catch(error => console.error('Erro:', error));
    }

    // Função para formatar a data
    function formatarData(data) {
        if (!data) return 'N/A'; // Caso a data seja nula ou indefinida

        // Criando um objeto Date com a string da data
        let dataFormatada = new Date(data);

        // Formatação da data no formato desejado (dia/mês/ano)
        let dia = dataFormatada.getDate().toString().padStart(2, '0');
        let mes = (dataFormatada.getMonth() + 1).toString().padStart(2, '0'); // Mês começa do zero
        let ano = dataFormatada.getFullYear();
        let horas = dataFormatada.getHours().toString().padStart(2, '0');
        let minutos = dataFormatada.getMinutes().toString().padStart(2, '0');
        let segundos = dataFormatada.getSeconds().toString().padStart(2, '0');

        return `${dia}/${mes}/${ano} ${horas}:${minutos}:${segundos}`;
    }

    // Buscar dados ao carregar a página
    fetchData();

    // Evento de clique para o botão de busca
    document.getElementById('search-button').addEventListener('click', function() {
        let query = document.getElementById('search-input').value.toLowerCase();
        let tableBody = document.getElementById('log-entries');
        let rows = tableBody.getElementsByTagName('tr');

        Array.from(rows).forEach(row => {
            let nameCell = row.cells[1].textContent.toLowerCase();
            let cnpjCell = row.cells[2].textContent.toLowerCase();

            if (nameCell.includes(query) || cnpjCell.includes(query)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    // Evento de clique para o botão "Mostrar Todos"
    document.getElementById('show-all-button').addEventListener('click', function() {
        fetchData();
        document.getElementById('search-input').value = '';
    });
});
</script>


</body>
</body>
</html>
