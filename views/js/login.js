var clickedOnce = false; //controlar se o botão foi clicado uma vez

function block_codigo(event) {
    event.preventDefault();
    var email = document.getElementById('email').value;
    var cod = document.getElementById('cod').value;

    if (email !== '') {
        document.getElementById('div-codigo').style.display = 'flex';

        if (clickedOnce && cod !== '') {
            window.location.href = '../auth/esqueceu-senha.php';
        } else {
            clickedOnce = true;
        }
    }
}

// temporario para apresentar o front end <---
//redirecionar para tela alterar senha
