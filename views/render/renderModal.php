<?php
function renderizarModalAdicionarCurso($tipoUsuario, $nomeInstituicao = null) {
    ?>
    <div id="modalAdicionar" class="modal">
        <div class="modal-content">
            <span class="fechar">&times;</span>
            <?php if ($tipoUsuario == 'administracao') : ?>
                    <h2>Adicionar Curso</h2>
                <?php else : ?>
                    <h2>Adicione seu Curso</h2>
            <?php endif; ?>
            <form id="formAdicionarCurso" method="post" enctype="multipart/form-data" action="../../controllers/curso_control.php">
                <label for="nome_curso">Título do Curso:</label>
                <input type="text" id="nome_curso" name="nome_curso" required>
                
                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao" rows="4" required></textarea>
                
                <label for="areacurso">Área do Curso:</label>
                <select id="areacurso" name="areacurso" required>
                    <option value="" disabled selected></option>
                    <option value="tecnologia">Tecnologia</option>
                    <option value="Saúde e Bem-Estar">Saúde e Bem-Estar</option>
                    <option value="Educação">Educação</option>
                    <option value="Engenharia">Engenharia</option>
                    <option value="Ciências Exatas e Naturais">Ciências Exatas e Naturais</option>
                    <option value="Ciências sociais, negócios e direito">Ciências sociais, negócios e direito</option>
                    <option value="Ciências Agrárias">Ciências Agrárias</option>
                    <option value="Meio Ambiente">Meio Ambiente</option>
                    <option value="Artes e Design">Artes e Design</option>
                    <option value="Comunicação">Comunicação</option>
                    <option value="Outros">Outros</option>
                </select>

                <label for="tipocurso">Tipo do curso:</label>
                <select id="tipocurso" name="tipocurso" required>
                    <option value="Extenção">Extenção</option>
                    <option value="Livre">Livre</option>
                </select>

                <label for="formato">Formato:</label>
                <select id="formato" name="formato" required>
                    <option value="Presencial">Presencial</option>
                    <option value="EAD">Ead</option>
                    <option value="Híbrido">Híbrido</option>
                </select>

                <label for="quantidadevagas">Quantidade de Vagas:</label>
                <input type="number" id="quantidadevagas" name="quantidadevagas" min="0" required>
                
                <label for="duracao">Duração:</label>
                <input type="text" id="duracao" name="duracao" required>
                
                <label for="turno">Turno:</label>
                <select id="turno" name="turno" required>
                    <option value="Manhã">Manhã</option>
                    <option value="Tarde">Tarde</option>
                    <option value="Noite">Noite</option>
                    <option value="Indefinido">Indefinido</option>
                </select>
                
                <label for="localidade">Local:</label>
                <input type="text" id="localidade" name="localidade" required>
                
                <label for="linksite">Link do Site:</label>
                <input type="url" id="linksite" name="linksite" placeholder="https://example.com" required>
                
                <?php if ($tipoUsuario === 'administracao'): ?>
                    <label for="instituicao">Instituição:</label>
                    <input type="text" id="instituicao" name="instituicao" required>
                <?php else: ?>
                    <input type="hidden" id="instituicao" name="instituicao" value="<?php echo $nomeInstituicao; ?>">
                    <input type="hidden" name="id_instituicao" value="<?php echo htmlspecialchars($_SESSION['user_data']['id_instituicao']); ?>">
                <?php endif; ?>

                <label for="inicio">Início das Inscrições:</label>
                <input type="date" id="inicioinscricoes" name="inicioinscricoes" required>
                
                <label for="termino">Término das Inscrições:</label>
                <input type="date" id="terminoinscricoes" name="terminoinscricoes" required>
                 
                <label for="fotocurso">Foto do Curso:</label>
                <input type="file" id="fotocurso" name="fotocurso" accept="image/*" required>
                
                <button type="submit" class="adicionar">Adicionar</button>
            </form>
        </div>
    </div>
    <?php
}
?>
