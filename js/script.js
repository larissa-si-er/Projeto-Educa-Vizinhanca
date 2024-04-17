const body = document.querySelector("body"),
   nav = document.querySelector("nav"),
   menu = document.querySelector(".menu"),
   sidebarClose = document.querySelector(".sidebarClose"),
   sidebarOpen = document.querySelector(".sidebarOpen")

sidebarOpen.addEventListener("click" , () => {
    nav.classList.add("ativo");
});
body.addEventListener("click" , e => {
    let clickedElm = e.target;

    if(!clickedElm.classList.contains("sidebarOpen") && !clickedElm.classList.contains("menu")){
        nav.classList.remove("ativo");
    }
});

// acessibilidade - icone
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

// FAQ - [INICIO]

const faqs = document.querySelectorAll('.faq');

faqs.forEach(faq => {
    faq.addEventListener("click", () => {
        faq.classList.toggle("act");
    });
});

// FAQ - [FIM]
