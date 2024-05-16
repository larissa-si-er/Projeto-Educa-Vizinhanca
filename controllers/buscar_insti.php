<?php
  include_once '../models/conexao.php';


if(isset($_POST['termo'])) {
    $termo = $_POST['termo'];

    $query = "SELECT id_instituicao, nome, telefone, cep, complemento, numero_insti, email, cnpj FROM instituicao WHERE cnpj LIKE '%$termo%'";
    $resultado = $conn->query($query);

    // Monta a tabela com os resultados da pesquisa
    if($resultado->rowCount() > 0) {
        while($linha = $resultado->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>{$linha['id_instituicao']}</td>";
            echo "<td>{$linha['nome']}</td>";
            echo "<td>{$linha['telefone']}</td>";
            echo "<td>{$linha['cep']}</td>";
            echo "<td>{$linha['complemento']}</td>";
            echo "<td>{$linha['numero_insti']}</td>";
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
}
?>
