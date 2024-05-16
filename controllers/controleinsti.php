<?php
    require_once '../views/templates/head.php';
    include_once '../views/templates/menuinterno.php';
    require_once '../models/conexao.php';
?>  

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
<br>

<div class="acoes">
    <div class="group">
        <i class="fa-solid fa-magnifying-glass" id="search"></i>
        <input placeholder="Pesquise por CNPJ" type="search" class="input" id="searchInput">
    </div>
    <!--script busca-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    $('#searchInput').keyup(function(){
        var searchTerm = $(this).val();

        $.ajax({
            url: 'buscar_insti.php', 
            type: 'POST',
            data: {termo: searchTerm}, 
            success: function(response){
                $('#alunosTable tbody').html(response); 
            }
        });
    });
});
</script>

    <div class="button">
        <div class="button-wrapper">
            <div class="text">Baixar PDF</div>
            <span class="icon">
                <a href="../views/admin/relatorios/pdfinsti.php"><i class="fa-solid fa-file-arrow-down" style="color:#fff; font-size:20px;"></i></a>
            </span>
        </div>
    </div>
</div>

<div class="container" id="i-container">

    <br><br><br>
    <?php
    try {

        $buscainstituicao = "SELECT id_instituicao, nome, telefone, cep, complemento, numero_insti, email, cnpj FROM instituicao";
        $resultadoinstituicao = $conn->query($buscainstituicao);
    } catch(PDOException $e) {
        echo "Erro de conexão: " . $e->getMessage();
    } catch(Exception $e) {
        echo "Erro: " . $e->getMessage();
    }
    ?>

    <table class="table" id="alunosTable">
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
            <?php while ($linha = $resultadoinstituicao->fetch(PDO::FETCH_ASSOC)) {
                extract($linha);
            ?>
                <tr>
                    <td><?php echo $id_instituicao ?></td>
                    <td><?php echo $nome ?></td>
                    <td><?php echo $telefone ?></td>
                    <td><?php echo $cep ?></td>
                    <td><?php echo $complemento ?></td>
                    <td><?php echo $numero_insti ?></td>
                    <td><?php echo $email ?></td>
                    <td><?php echo $cnpj ?></td>
                    <td>
                        <button id="actionseditar" title="Editar">
                            <a href="editar.php?id=<?php echo $id_instituicao ?>"><i class="fa-solid fa-pen-to-square" style="font-size: 18px; color:#fff;"></i></a>
                        </button>
                        <button id="actionsdelete" title="Excluir">
                            <a href="excluir.php?action=excluir&id=<?php echo $id_instituicao ?>"><i class="fa-solid fa-trash" style="font-size: 17px; color:#fff;"></i></a>
                        </button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<br><br>

<style>
    .acoes {
        padding-left: 5%;
        padding-right: 5%;
        padding-top: 0.5%;
        display: flex;
        flex-wrap: wrap; 
        margin-right: 5px;
        justify-content: space-between;
    }
    .button {
        --width: 100px;
        --height: 35px;
        --button-color:  #63D7E4;
        --tooltip-color: #fff;
        width: var(--width);
        height: var(--height);
        background: var(--button-color);
        position: relative;
        text-align: center;
        border-radius: 0.45em;
        transition: background 0.3s;
    }

    .button::after {
        position: absolute;
        width: 0;
        height: 0;
        border: 10px solid transparent;
        left: calc(50% - 10px);
    }

    .text {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .button-wrapper,.text,.icon {
        overflow: hidden;
        position: absolute;
        width: 100%;
        height: 100%;
        left: 0;
        color: #fff;
    }

    .text {
        top: 0
    }

    .text,.icon {
        transition: top 0.5s;
    }

    .icon {
        color: #fff;
        top: 100%;
        font-size: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .button:hover {
        background: #1163ff;
    }

    .button:hover .text {
        top: -100%;
    }

    .button:hover .icon {
        top: 0;
    }

    .group {
        display: flex;
        line-height: 28px;
        align-items: center;
        position: relative;
        max-width: 190px;
    }

    .input {
        width: 100%;
        height: 40px;
        line-height: 28px;
        padding: 0 0.5rem;
        padding-left: 2.5rem;
        border: 2px solid transparent;
        border-radius: 8px;
        outline: none;
        background-color: #f3f3f4;
        color: #0d0c22;
        transition: .3s ease;
    }

    .input::placeholder {
        color: #9e9ea7;
    }

    .input:focus, input:hover {
        outline: none;
        border-color: #63D7E4;
        background-color: #fff;

    }

    #search {
        position: absolute;
        left: 1rem;
        width: 1rem;
        height: 1rem;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
        border-right: 1px solid #ddd; 
    }

    th {
        background-color: #f2f2f2;
    }

    .actions {
        text-align: center;
    }

    .actions button {
        margin-right: 6px;
    }

    #actionsdelete {
        align-items: center;
        padding: 12px 10px;
        height: 40px;
        width: 40px;
        border: none;
        background: #FF342B;
        border-radius: 10px;
        cursor: pointer;
    }

    #actionseditar {
        align-items: center;
        padding: 12px 10px;
        height: 40px;
        width: 40px;
        border: none;
        background: #63D7E4;
        border-radius: 10px;
        cursor: pointer;
    }

    td:last-child {
        border-right: none; 
    }

   
    @media screen and (max-width: 1080px) {
        table, thead, tbody, th, td, tr {
            display: block;
        }

        thead tr {
            position: absolute;
            top: -9999px;
            left: -9999px;
        }

        tr {
            border: 1px solid #ccc;
            margin-bottom: 10px; 
        }

        td {
            border: none;
            border-bottom: 1px solid #eee;
            position: relative;
            padding-left: 50%;
        }

        td:before {
            position: absolute;
            font-weight: 600;
            top: 6px;
            left: 6px;
            width: 45%;
            padding-right: 10px;
            white-space: nowrap;
        }
        .actions a {
            display: block;
            margin-bottom: 5px; 
        }


        td:nth-of-type(1):before { content: "ID"; }
        td:nth-of-type(2):before { content: "Nome"; }
        td:nth-of-type(3):before { content: "Telefone"; }
        td:nth-of-type(4):before { content: "CEP"; }
        td:nth-of-type(5):before { content: "Complemento"; }
        td:nth-of-type(6):before { content: "Número"; }
        td:nth-of-type(7):before { content: "Email"; }
        td:nth-of-type(8):before { content: "CNPJ"; }
        td:nth-of-type(13):before { content: "Ações"; }
    }

    .meu_perfil {
        overflow: hidden;
        padding-left: 12%;
        padding-top: 0.5%;
        background-color: #63D7E4;
    }

    .meu_perfil ul {
        list-style: none;
        display: flex;

    }

    .meu_perfil li {
        margin-right: 100px; 
    }

    .meu_perfil li:meu_perfil {
        margin-right: 0; 
    }

    .meu_perfil li a {
        text-decoration: none;
        color: #333;
        display: block;

    }

    .meu_perfil li a:hover {
        text-decoration: underline;
    }

    .voltar {
        justify-content: center; 
        margin-top: 115px;

    }

    .container {
        display: flex;
        flex-wrap: wrap; 
        justify-content: center; 
        margin-top: 1px;
        border-radius: 20px;
        background: #FFFFFF;
        box-shadow:  25px 25px 50px #d0d0d0,
                     -25px -25px 50px #ffffff;
    }

    #i-container {
        padding-left: 5%;
        padding-right: 5%;
        padding-top: 0.5%;
    }
</style>
