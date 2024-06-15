<?php
include_once './models/conexao.php'; // Verifique o caminho correto

// Verifica se o termo de pesquisa foi enviado
if(isset($_POST['termo'])) {
    $termo = $_POST['termo'];

    try {
        // Atualize a consulta SQL para pesquisar em várias colunas da tabela
        $query = "SELECT id_aluno, nome, data_nasc, sexo, nome_materno, cpf, email, telefone_celular, telefone_fixo, usuario, cep FROM aluno 
                  WHERE cpf LIKE :termo OR nome LIKE :termo OR email LIKE :termo OR telefone_celular LIKE :termo OR telefone_fixo LIKE :termo OR usuario LIKE :termo OR cep LIKE :termo";
        
        // Prepara a consulta
        $stmt = $conn->prepare($query);
        
        // Bind do parâmetro
        $termoPesquisa = "%$termo%";
        $stmt->bindParam(':termo', $termoPesquisa, PDO::PARAM_STR);
        
        // Executa a consulta
        $stmt->execute();
        
        // Verifica se a consulta retornou resultados
        if($stmt->rowCount() > 0) {
            // Monta a tabela com os resultados da pesquisa
            while($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
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
                echo "<td>{$linha['usuario']}</td>";
                echo "<td>{$linha['cep']}</td>";
                echo "<td>
                        <button id='actionseditar' title='Editar'>
                            <a href='editar.php?id={$linha['id_aluno']}'><i class='fa-solid fa-pen-to-square' style='font-size: 18px; color:#fff;'></i></a>
                        </button>
                        <button id='actionsdelete' title='Excluir'>
                            <a href='excluir.php?action=excluir&id={$linha['id_aluno']}'><i class='fa-solid fa-trash' style='font-size: 17px; color:#fff;'></i></a>
                        </button>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='13'>Nenhum resultado encontrado.</td></tr>";
        }
    } catch (PDOException $e) {
        echo "Erro na consulta: " . $e->getMessage();
    }
}
?>
