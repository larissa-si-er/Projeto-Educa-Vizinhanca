<?php
include '../models/conexao.php';

if(isset($_POST['termo'])) {
    $termo = $_POST['termo'];

    // Consulta SQL ajustada para incluir o INNER JOIN com a tabela endereco
    $query = "SELECT i.id_instituicao, i.nome, i.telefone, i.cep, i.email, i.senha, i.status, i.cnpj, e.estado, e.logradouro, e.bairro, e.numero
              FROM instituicao i
              INNER JOIN endereco e ON i.cep = e.cep
              WHERE i.nome LIKE '%$termo%' 
                 OR i.telefone LIKE '%$termo%' 
                 OR i.cep LIKE '%$termo%' 
                 OR i.email LIKE '%$termo%' 
                 OR i.cnpj LIKE '%$termo%' 
                 OR i.id_instituicao LIKE '%$termo%'";

    $resultado = $conn->query($query);

    // Verifica se a consulta SQL foi executada corretamente
    if($resultado) {
        // Monta a tabela com os resultados da pesquisa
        if($resultado->rowCount() > 0) {
            while($linha = $resultado->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>{$linha['id_instituicao']}</td>";
                echo "<td>{$linha['nome']}</td>";
                echo "<td>{$linha['telefone']}</td>";
                echo "<td>{$linha['cep']}</td>";
                echo "<td>{$linha['logradouro']}; {$linha['bairro']}; {$linha['estado']} </td>";
                echo "<td>{$linha['numero']}</td>";
                echo "<td>{$linha['email']}</td>";
                echo "<td>{$linha['cnpj']}</td>";
                echo "<td>
                        <button id='actionseditar' title='Editar'>
                            <a href='editar.php?id={$linha['id_instituicao']}'><i class='fa-solid fa-pen-to-square' style='font-size: 18px; color:#fff;'></i></a>
                        </button>
                        <button id='actionsdelete' title='Excluir'>
                            <a href='excluir.php?action=excluir&id={$linha['id_instituicao']}'><i class='fa-solid fa-trash' style='font-size: 17px; color:#fff;'></i></a>
                        </button>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>Nenhum resultado encontrado.</td></tr>";
        }
    } else {
        // Em caso de erro na execução da consulta SQL
        echo "<tr><td colspan='8'>Erro ao executar a consulta SQL.</td></tr>";
    }
}
?>