<?php
include '../models/conexao.php';

if (isset($_POST['termo'])) {
    $termo = $_POST['termo'];

    $query = "SELECT a.id_aluno, a.nome, a.data_nasc, a.sexo, a.nome_materno, a.cpf, a.email, a.telefone_celular, a.telefone_fixo,
                     e.cep, e.estado, e.logradouro, e.bairro, e.num
              FROM aluno a
              INNER JOIN endereco e ON a.cep = e.cep
              WHERE a.nome LIKE :termo 
                 OR a.data_nasc LIKE :termo 
                 OR a.sexo LIKE :termo 
                 OR a.nome_materno LIKE :termo 
                 OR a.cpf LIKE :termo 
                 OR a.email LIKE :termo 
                 OR a.telefone_celular LIKE :termo 
                 OR a.telefone_fixo LIKE :termo 
                 OR a.id_aluno LIKE :termo";

    try {
        $stmt = $conn->prepare($query);
        $stmt->execute([':termo' => "%$termo%"]);

        if ($stmt->rowCount() > 0) {
            while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>{$linha['id_aluno']}</td>";
                echo "<td>{$linha['nome']}</td>";
                echo "<td>{$linha['data_nasc']}</td>";
                echo "<td>{$linha['nome_materno']}</td>";
                echo "<td>{$linha['sexo']}</td>";
                echo "<td>{$linha['cpf']}</td>";
                echo "<td>{$linha['email']}</td>";
                echo "<td>{$linha['telefone_celular']}</td>";
                echo "<td>{$linha['telefone_fixo']}</td>";
                echo "<td>
                        <button class='view-details' data-id='{$linha['id_aluno']}'>
                            <i class='fa fa-eye' aria-hidden='true'></i>
                        </button>
                      </td>";
                echo "<td style='display:none;' id='details-{$linha['id_aluno']}'>
                        CEP: {$linha['cep']}<br>
                        Logradouro: {$linha['logradouro']}<br>
                        Bairro: {$linha['bairro']}<br>
                        Estado: {$linha['estado']}<br>
                        Número: {$linha['num']}
                      </td>";
                echo "<td>
                        <button id='actionsdelete' title='Excluir'>
                            <a href='exclui-control-A.php?action=excluir&id={$linha['id_aluno']}'><i class='fa-solid fa-trash' style='font-size: 17px; color:#fff;'></i></a>
                        </button>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='11'>Nenhum resultado encontrado.</td></tr>";
        }
    } catch (PDOException $e) {
        echo "<tr><td colspan='11'>Erro ao executar a consulta SQL: " . $e->getMessage() . "</td></tr>";
    }
}
?>
