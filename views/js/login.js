// var clickedOnce = false; //controlar se o botão foi clicado uma vez

// function block_codigo(event) {
//     event.preventDefault();
//     var email = document.getElementById('email').value;
//     var cod = document.getElementById('cod').value;

//     if (email !== '') {
//         document.getElementById('div-codigo').style.display = 'flex';

//         if (clickedOnce && cod !== '') {
//             window.location.href = '../auth/esqueceu-senha.php';
//         } else {
//             clickedOnce = true;
//         }
//     }
// }


document.addEventListener('DOMContentLoaded', function() {
    var emailInput = document.getElementById('email');
    var codigoDiv = document.getElementById('div-codigo');
    var submitButton = document.querySelector('.button-submit');

    emailInput.addEventListener('blur', function() {
        if (emailInput.value.trim() !== '') {
            codigoDiv.style.display = 'flex';
        } else {
            codigoDiv.style.display = 'none';
        }
    });

    submitButton.addEventListener('click', function(event) {
        if (emailInput.value.trim() === '') {
            event.preventDefault();
            Swal.fire({
                icon: 'warning', // Altera o ícone para um ícone de atenção
                title: 'Oops...',
                text: 'Por favor, insira seu endereço de e-mail.',
                confirmButtonColor: '#3085d6', // Altera a cor do botão para azul
                confirmButtonText: 'OK' // Altera o texto do botão de confirmação
            });
        }
    });
});

// temporario para apresentar o front end <---
//redirecionar para tela alterar senha
