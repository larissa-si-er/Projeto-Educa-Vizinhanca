<?php
include_once '../models/conexao.php';

// Verifica se o termo de pesquisa foi enviado
if(isset($_POST['termo'])) {
    $termo = $_POST['termo'];

    $query = "SELECT id_aluno, nome, data_nasc, sexo, nome_materno, cpf, email, telefone_celular, telefone_fixo, cep, complemento, numero_casa FROM aluno WHERE cpf LIKE '%$termo%'";
    $resultado = $conn->query($query);

    // Monta a tabela com os resultados da pesquisa
    if($resultado->rowCount() > 0) {
        while($linha = $resultado->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>{$linha['id_aluno']}</td>";
            echo "<td>{$linha['nome']}</td>";
            echo "<td>{$linha['data_nasc']}</td>";
            echo "<td>{$linha['sexo']}</td>";
            echo "<td>{$linha['nome_materno']}</td>";
            echo "<td>{$linha['cpf']}</td>";
            echo "<td>{$linha['email']}</td>";
            echo "<td>{$linha['telefone_celular']}</td>";
            echo "<td>{$linha['telefone_fixo']}</td>";
            echo "<td>{$linha['cep']}</td>";
            echo "<td>{$linha['complemento']}</td>";
            echo "<td>{$linha['numero_casa']}</td>";
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
}
?>
