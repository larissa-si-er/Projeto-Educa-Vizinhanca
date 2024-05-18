document.addEventListener('DOMContentLoaded', function() {
    const thumbnails = document.querySelectorAll('.thumbnail');
    const mainImage = document.getElementById('main-image');

    thumbnails.forEach(thumbnail => {
        thumbnail.addEventListener('click', function() {
            const src = this.getAttribute('src');
            mainImage.setAttribute('src', src);
        });
    });

    // JavaScript para aumentar e diminuir a quantidade (como mostrado na resposta anterior)
    const decrementBtn = document.getElementById('decrement');
    const incrementBtn = document.getElementById('increment');
    const quantityInput = document.getElementById('quantity');

    decrementBtn.addEventListener('click', function() {
        let currentValue = parseInt(quantityInput.value);
        if (currentValue > 1) {
            quantityInput.value = currentValue - 1;
        }
    });

    incrementBtn.addEventListener('click', function() {
        let currentValue = parseInt(quantityInput.value);
        quantityInput.value = currentValue + 1;
    });
});

document.getElementById('increment').addEventListener('click', function() {
    var quantityInput = document.getElementById('quantity');
    var currentValue = parseInt(quantityInput.value);
    quantityInput.value = currentValue + 0;
});

document.addEventListener("DOMContentLoaded", function() {
    document.getElementById('color').addEventListener('change', function() {
        var number = parseInt(this.value); // Obter o número selecionado
        var mainImage = document.getElementById('main-image');
        var imagePath = '../img/' + number + '.png';
        mainImage.src = imagePath;
    });
});

document.addEventListener('DOMContentLoaded', function() {
    var thumbnails = document.querySelectorAll('.thumbnail');
    
    thumbnails.forEach(function(thumbnail) {
        thumbnail.addEventListener('click', function() {
            // Adiciona uma classe para a imagem clicada
            this.classList.toggle('expanded');
        });
    });
});

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
  
