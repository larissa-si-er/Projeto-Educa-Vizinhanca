<?php
include '../models/conexao.php';

if (isset($_POST['termo'])) {
    $termo = $_POST['termo'];
    error_log("Termo de busca: " . $termo);  // Debug: log the search term

    $query = "SELECT i.id_instituicao, i.nome_insti, i.telefone_fixo, i.telefone_celular, i.cep, i.email, i.cnpj, e.estado, e.logradouro, e.bairro, e.num
              FROM instituicao i
              INNER JOIN endereco e ON i.cep = e.cep
              WHERE i.nome_insti LIKE :termo 
                 OR i.telefone_fixo LIKE :termo 
                 OR i.telefone_celular LIKE :termo 
                 OR i.cep LIKE :termo 
                 OR i.email LIKE :termo 
                 OR i.cnpj LIKE :termo 
                 OR i.id_instituicao LIKE :termo";

    try {
        $stmt = $conn->prepare($query);
        $stmt->execute([':termo' => "%$termo%"]);
        error_log("Número de resultados: " . $stmt->rowCount());  // Debug: log the number of results

        if ($stmt->rowCount() > 0) {
            while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>{$linha['id_instituicao']}</td>";
                echo "<td>{$linha['nome_insti']}</td>";
                echo "<td>{$linha['telefone_fixo']}</td>";
                echo "<td>{$linha['telefone_celular']}</td>";
                echo "<td>{$linha['email']}</td>";
                echo "<td>{$linha['cnpj']}</td>";
                echo "<td>{$linha['cep']}</td>";  // Outputting CEP
                echo "<td>
                        <button class='view-details' data-id='{$linha['id_instituicao']}'>
                            <i class='fa fa-eye' aria-hidden='true'></i>
                        </button>
                      </td>";
                echo "<td style='display:none;' id='details-{$linha['id_instituicao']}'>
                        Logradouro: {$linha['logradouro']}<br>
                        Bairro: {$linha['bairro']}<br>
                        Estado: {$linha['estado']}<br>
                        Número: {$linha['num']}
                      </td>";
                echo "<td>
                        <button id='actionsdelete' title='Excluir'>
                            <a href='excluir-control.php?action=excluir&id={$linha['id_instituicao']}'><i class='fa-solid fa-trash' style='font-size: 17px; color:#fff;'></i></a>
                        </button>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='9'>Nenhum resultado encontrado.</td></tr>";
        }
    } catch (PDOException $e) {
        echo "<tr><td colspan='9'>Erro ao executar a consulta SQL: " . $e->getMessage() . "</td></tr>";
    }
} else {
    echo "<tr><td colspan='9'>Termo de busca não especificado.</td></tr>";
}
?>
