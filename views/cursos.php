<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="./img/home-ic.png">
    <title>Cursos - EV</title>
    <link rel="stylesheet" href="./css/cursos.css">
    <link rel="stylesheet" href="./css/footer.css">
    <!-- icones -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="./js/menu.js"></script>

</head>
<body>
    <header>
        <nav>
                <div class="nav-bar">
                    <i class="bi bi-list sidebarOpen"></i>
                    <span class="logo"><a href="#"><img src="./img/home-ic.png" alt=""></a></span>
                    <div class="menu">
                        <i class="bi bi-x sidebarClose"></i>

                        <ul class="nav-links">
                            <li><a href="../index.php" class="pag-atual"> Início </a></li>
                            <li><a href="#">Cursos <span class="active"></span></a></li>
                            <li><a href="./produtos.php">Produtos </a></li>
                            <li><a href="#footer">Contato</a></li>
                            <li class="user"><a href="./auth/login.php"><i class="bi bi-person-circle"></i></a></li>
                        </ul>
                    </div>
                </div>
        </nav>
    </header>

    <main>
        <section class="content">
            <div class="content-courses">
                <div class="cards">
                    <div class="card card1">
                        <img src="./img/edFisica-cursos.png" alt="" class="cursos1">
                        <h3 class="txt-cursos">Bradesco</h3>
                        <P class="p-cursos">Turno: Tarde</P>
                        <p class="local">RJ</p>

                        <button class="bt-info" title="Ver Cursos" onclick="window.location.href ='./feed.php'"><i class="bi bi-info-circle-fill"></i></button>
                    </div>

                    <div class="card card2">
                        <img src="./img/tecno-cursos.png" alt="" class="cursos1">
                        <h3 class="txt-cursos">Senac</h3>
                        <P class="p-cursos">Turno: Manhã</P>
                        <p class="local">RJ</p>

                        <button class="bt-info" title="Ver Cursos" onclick="window.location.href ='./feed.php'"><i class="bi bi-info-circle-fill"></i></button>
                    </div>

                    <div class="card card3">
                        <img src="./img/saude-cursos.png" alt="" class="cursos1">
                        <h3 class="txt-cursos">UFRJ</h3>
                        <P class="p-cursos">Turno: noite</P>
                        <p class="local">RJ</p>

                        <button class="bt-info" title="Ver Cursos" onclick="window.location.href ='./feed.php'"><i class="bi bi-info-circle-fill"></i></button>
                    </div>
                </div>
            </div>
            <div class="content-goals">
                <div class="goals">
                    <div class="goal-1">
                        <h3 class="title-goals">Cursos de várias Áreas</h3>
                        <div class="icons-g1">
                            <img src="./img/tec-ic.png"  class="tec" alt="">
                            <img src="./img/saude-ic.png" class="saude" alt="">
                            <img src="./img/direito-ic.png" class="direito" alt="">
                            <img src="./img/mat-ic.png" class="mat" alt="">
                        </div>
                    </div>
                    <div class="goal-2">
                        <h3 class="title-goals">Plataforma exclusiva para divulgação de cursos</h3>
                        <img src="./img/grat.png" class="peoples" alt="">
                        <p class="p-g2">chega de passar horas procurando os cursos</p>
                    </div>
                    <div class="goal-3">
                        <h3 class="title-goals">Você empresa, não perca a chance de divulgar seu curso aqui e ter ainda mais visibilidade, entre em contato!</h3>
                        <img src="./img/busc.png" class="busca" alt="">
                    </div>
                </div>
            </div>
        </section>
    </main>    

    <?php
    require_once '../footer.php';
    ?>

</body>
</html>