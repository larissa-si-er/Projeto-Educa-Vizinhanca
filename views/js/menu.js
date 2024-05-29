// NAV 
document.addEventListener("DOMContentLoaded", function() {
    const body = document.querySelector("body"),
        nav = document.querySelector("nav"),
        menu = document.querySelector(".menu"),
        sidebarClose = document.querySelector(".sidebarClose"),
        sidebarOpen = document.querySelector(".sidebarOpen");
  
    sidebarOpen.onclick = () => {
        nav.classList.add("ativo");
        console.log('online nav');
    };
  
    body.onclick = e => {
        let clickedElm = e.target;
  
        if (!clickedElm.classList.contains("sidebarOpen") && !clickedElm.classList.contains("menu")) {
            nav.classList.remove("ativo");
        }
    };
  });
  


//   teste
document.addEventListener("DOMContentLoaded", function() {
    function obterNomeDiaSemana(dia) {
        const diasDaSemana = ["dom", "seg", "ter", "qua", "qui", "sex", "sáb"];
        return diasDaSemana[dia];
    }

    function adicionarZero(numero) {
        return numero < 10 ? `0${numero}` : numero;
    }

    // Obter a data atual
    const dataAtual = new Date();

    const diaSemana = dataAtual.getDay();
    const nomeDiaSemana = obterNomeDiaSemana(diaSemana);
    const dia = adicionarZero(dataAtual.getDate());
    const mes = adicionarZero(dataAtual.getMonth() + 1); // Janeiro é 0
    const ano = dataAtual.getFullYear();

    const diaSemanaSpan = `<span class="weekday">${nomeDiaSemana}</span>`;
    const dataFormatada = `${diaSemanaSpan} ${dia}/${mes}/${ano}`;

    const elementoDataAtual = document.getElementById("data-atual");
    elementoDataAtual.innerHTML = dataFormatada;
});

