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