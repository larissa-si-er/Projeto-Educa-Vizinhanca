//NAV - MENU INDEX
const body = document.querySelector("body"),
   nav = document.querySelector("nav"),
   menu = document.querySelector(".menu"),
   sidebarClose = document.querySelector(".sidebarClose"),
   sidebarOpen = document.querySelector(".sidebarOpen")

sidebarOpen.addEventListener("click" , () => {
    nav.classList.add("ativo");
    console.log('online nav')
});
body.addEventListener("click" , e => {
    let clickedElm = e.target;

    if(!clickedElm.classList.contains("sidebarOpen") && !clickedElm.classList.contains("menu")){
        nav.classList.remove("ativo");
    }
});

// acessibilidade - icones
const acess = document.querySelector('.acess-bt');
const acess_Window = document.querySelector(".acess-window");

acess.addEventListener ("click", () => {
    if (acess_Window.style.display === "block") {
        acess_Window.style.display = "none";
      } else {
        acess_Window.style.display = "block";
      }
});


// acessibilidade - dk mode

// DARK MODE - inicio
document.addEventListener('DOMContentLoaded', () => {
    const darkModeStorage = localStorage.getItem('dark-mode')
    const html = document.querySelector('html')
    const header = document.querySelector('header')
    const p = document.querySelector('p')
    const h1 = document.querySelector('h1')
    const h2 = document.querySelector('h2')
    const h3 = document.querySelector('h3')
    const h1_c3 = document.querySelector('.h1-c3')
    const section = document.querySelector('section')
    const footer = document.querySelector('footer')
    const bt = document.querySelector('.b1-c1')
    const inputDarkMode = document.querySelector('.input-dark-mode')

    if(darkModeStorage){
        html.setAttribute("dark", "true");
    }

    inputDarkMode.addEventListener('change', () => {
        if(inputDarkMode.checked){
            html.setAttribute("dark", "true")
            body.setAttribute("dark", "true")
            localStorage.setItem('dark-mode', true);


        }else{
            html.removeAttribute("dark")
            body.removeAttribute("dark")
            localStorage.removeItem('dark-mode');
        }
   })
})

// DARK MODE - FIM


// TEXT-RESIZER - INICIO
function aumentarTexto() {
    var elementosTexto = document.querySelectorAll('body *'); // Seleciona todos os elementos dentro do body

    elementosTexto.forEach(function(elemento) {
        var tamanhoAtual = window.getComputedStyle(elemento).fontSize; // Obtém o tamanho atual da fonte
        var novoTamanho = parseInt(tamanhoAtual) * 1.2; // Aumenta o tamanho da fonte em 20%

        elemento.style.fontSize = novoTamanho + 'px'; // Define o novo tamanho da fonte
    });
}

function diminuirTexto() {
    var elementosTexto = document.querySelectorAll('body *');

    elementosTexto.forEach(function(elemento) {
        var tamanhoAtual = window.getComputedStyle(elemento).fontSize;
        var novoTamanho = parseInt(tamanhoAtual) * 0.8; // Diminui o tamanho da fonte em 20%

        elemento.style.fontSize = novoTamanho + 'px';
    });
}
// TEXT-RESIZER - FIM

// -------------------- FIM ACESSIBILIDADE


// ------------------------JSSETA [INICIO]
document.addEventListener('DOMContentLoaded', function() {
    var setaSubir = document.getElementById('seta-subir');

    window.onscroll = function() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            setaSubir.style.display = "block";
        } else {
            setaSubir.style.display = "none";
        }
    };

    setaSubir.addEventListener('click', function() {
        scrollToTop(9000);
    });

    function scrollToTop(scrollDuration) {
        var scrollStep = -window.scrollY / (scrollDuration / 30),
            scrollInterval = setInterval(function() {
                if (window.scrollY != 0) {
                    window.scrollBy(0, scrollStep);
                } else clearInterval(scrollInterval);
            }, 15);
    }
});
// ----------------------------JSSETA [FIM]



// FAQ - [INICIO]

const faqs = document.querySelectorAll('.faq');

faqs.forEach(faq => {
    faq.addEventListener("click", () => {
        faq.classList.toggle("act");
    });
});

// FAQ - [FIM]
