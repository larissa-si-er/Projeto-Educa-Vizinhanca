  // Função para redirecionar com base no tipo de cadastro selecionado
  function redirecionarCadastro() {
    var tipoCadastroSelect = document.getElementById('tipoCadastro');
    var tipoCadastro = tipoCadastroSelect.value;

    if (tipoCadastro === 'normal') {
        window.location.href = '../views/auth/cadastro.php';
    } else if (tipoCadastro === 'admin') {
        window.location.href = '../views/auth/cadastro_admin.php';
    }
}