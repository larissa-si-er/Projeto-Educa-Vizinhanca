// Evento de scroll para mostrar ou ocultar a seta
window.addEventListener('scroll', function() {
    var seta = document.querySelector('.seta');
    if (window.scrollY === 0) {
        seta.style.display = 'none'; // Oculta a seta quando estiver no topo
    } else {
        seta.style.display = 'block'; // Mostra a seta quando não estiver no topo
    }
});

// Adiciona um evento de clique para a seta
document.querySelector('.seta').addEventListener('click', function() {
    scrollToTop(1000); // Chama a função para scroll suave até o topo em 1000ms (1 segundo)
});

// Função para scroll suave com animação personalizada
function scrollToTop(duration) {
    // Início do scroll
    const start = window.pageYOffset;
    // Diferença até o topo
    const target = 0;
    const distance = target - start;
    const startTime = performance.now();

    // Função de animação
    function animate(currentTime) {
        const timeElapsed = currentTime - startTime;
        const run = ease(timeElapsed, start, distance, duration);
        window.scrollTo(0, run);
        if (timeElapsed < duration) {
            requestAnimationFrame(animate);
        }
    }

    // Função de easing para suavizar o movimento
    function ease(t, b, c, d) {
        t /= d;
        return -c * t * (t - 2) + b;
    }

    // Inicia a animação
    requestAnimationFrame(animate);
}