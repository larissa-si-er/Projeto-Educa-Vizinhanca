
        // Redirecionar
        function redirecionarCadastro() {
            var tipoCadastroSelect = document.getElementById('tipoCadastro');
            var tipoCadastro = tipoCadastroSelect.value;

            sessionStorage.setItem('tipoCadastro', tipoCadastro);

            if (tipoCadastro === 'normal') {
                window.location.href = '../auth/cadastro.php';
            } else if (tipoCadastro === 'instituicao') {
                window.location.href = '../auth/cadastro_admin.php';
            }
        }
        
        // Restaurar 
        document.addEventListener('DOMContentLoaded', function() {
            var tipoCadastroSelect = document.getElementById('tipoCadastro');
            var savedTipoCadastro = sessionStorage.getItem('tipoCadastro');
        
            if (savedTipoCadastro && savedTipoCadastro !== "") {
                tipoCadastroSelect.value = savedTipoCadastro;
                // Limpa o sessionStorage
                sessionStorage.removeItem('tipoCadastro');
            } 
            else 
            {
                tipoCadastroSelect.value = "";  // opção padrão
            }
        });


