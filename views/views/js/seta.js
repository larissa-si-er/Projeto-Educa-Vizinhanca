window.addEventListener('scroll', function() {
    var seta = document.querySelector('.seta');
    if (window.scrollY === 0) {
        seta.style.display = 'none'; // Oculta a seta quando estiver no topo
    } else {
        seta.style.display = 'block'; // Mostra a seta quando não estiver no topo
    }
});

