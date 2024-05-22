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
    var elementosTexto = document.querySelectorAll('body :not(.acess-window):not(.moreorless) p'); 

    elementosTexto.forEach(function(elemento) {
        var tamanhoAtual = parseFloat(window.getComputedStyle(elemento).fontSize);
        var novoTamanho = tamanhoAtual + 1; // 1px

        if (novoTamanho <= 20) {
            elemento.style.fontSize = novoTamanho + 'px';
        }
    });
}

function diminuirTexto() {
    var elementosTexto = document.querySelectorAll('body:not(.acess-window):not(.moreorless) p');

    elementosTexto.forEach(function(elemento) {
        var tamanhoAtual = parseFloat(window.getComputedStyle(elemento).fontSize);
        var novoTamanho = tamanhoAtual - 1; // Diminui em 1px


        if (novoTamanho >= 12) {
            elemento.style.fontSize = novoTamanho + 'px';
        }
    });
}
// TEXT-RESIZER - FIM

// -------------------- FIM ACESSIBILIDADE


// ------------------------JSSETA [INICIO]
document.addEventListener('DOMContentLoaded', function() {
    var scrollToTopBtn = document.querySelector(".seta");

    window.onscroll = function() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            scrollToTopBtn.style.display = "block";
        } else {
            scrollToTopBtn.style.display = "none";
        }
    };

    scrollToTopBtn.addEventListener("click", function(event) {
        event.preventDefault();
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
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
