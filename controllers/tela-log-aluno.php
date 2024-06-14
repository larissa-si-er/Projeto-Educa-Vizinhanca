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

                        <!-- REVERRRRRR <ul class="user-ul">
                            <li class="user-li">
                                <a href="./admin/areaadm.php">
                                    <h4 class="user-log">
                                        <i class="bi bi-chevron-down"></i> Usuário 
                                    </h4> 
                                    <i class="bi bi-person-circle"></i>
                                </a>
                            </li>
                        </ul> -->
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
    <i class="fa-solid fa-user-shield"></i>
        <h2>Registros de Login</h2>
        
        <div class="search-bar">
            <input type="text" id="search-input" placeholder="Buscar por CPF ou nome ">
            <button id="search-button">Buscar</button>
            <button id="show-all-button">Mostrar Todos</button>
        </div>
        <table id="log-table">
            <thead>
                <tr>
                    <th>Data e Hora</th>
                    <th>Nome</th>
                    <th>CPF</th>
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
        document.addEventListener("DOMContentLoaded", function() {
            const searchButton = document.getElementById("search-button");
            const showAllButton = document.getElementById("show-all-button");
            const searchInput = document.getElementById("search-input");
            const logEntries = document.getElementById("log-entries");

            const logs = [
                { date: "2024-06-01 12:30", name: "João Silva", cpf: "123.456.789-00", authFactor: "CEP" },
                { date: "2024-06-02 08:45", name: "Maria Oliveira", cpf: "987.654.321-00", authFactor: "Nome materno" },
                // Adicione mais registros conforme necessário
            ];

            function formatDateTime(dateTimeStr) {
                const [datePart, timePart] = dateTimeStr.split(' ');
                const [year, month, day] = datePart.split('-');
                const [hour, minute] = timePart.split(':');
                return `${day}/${month}/${year} ${hour}:${minute}`;
            }

            function renderLogs(filteredLogs) {
                logEntries.innerHTML = "";
                filteredLogs.forEach(log => {
                    const row = document.createElement("tr");
                    row.innerHTML = `
                        <td data-label="Data e Hora">${formatDateTime(log.date)}</td>
                        <td data-label="Nome">${log.name}</td>
                        <td data-label="CPF">${log.cpf}</td>
                        <td data-label="Fator de Autenticação">${log.authFactor}</td>
                    `;
                    logEntries.appendChild(row);
                });
            }

            function searchLogs(query) {
                const filteredLogs = logs.filter(log => 
                    log.name.toLowerCase().includes(query.toLowerCase()) || 
                    log.cpf.includes(query)
                );
                renderLogs(filteredLogs);
            }

            searchButton.addEventListener("click", function() {
                const query = searchInput.value;
                searchLogs(query);
            });

            showAllButton.addEventListener("click", function() {
                renderLogs(logs);
            });

            // Render all logs initially
            renderLogs(logs);
        });
    </script>
</body>
</html>
