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
