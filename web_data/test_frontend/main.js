
/*
$(window).on("scroll", function() {
    $(".scroll-section").each(function() {
        if (isElementInViewport(this)) {
            $(this).addClass("visible");
        }
    });
});

function isElementInViewport(el) {
    var rect = el.getBoundingClientRect();
    return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );

*/
$(window).on("scroll", function () {
    $(".scroll-section").each(function () {
        if (isElementInViewport(this)) {
            $(this).addClass("visible");
            if ($(this).hasClass("scroll-1")) {
                var rect = this.getBoundingClientRect();
                if (rect.left <= 0) {
                    $(this).addClass("scroll-left");
                }
            } else if ($(this).hasClass("scroll-2")) {
                var rect = this.getBoundingClientRect();
                if (rect.left <= 0) {
                    $(this).addClass("scroll-right");
                }
            } else if ($(this).hasClass("scroll-3")) {
                var rect = this.getBoundingClientRect();
                if (rect.right <= (window.innerWidth || document.documentElement.clientWidth)) {
                    $(this).addClass("scroll-right");
                }
            } else if ($(this).hasClass("scroll-4")) {
                var rect = this.getBoundingClientRect();
                if (rect.top <= 0) {
                    $(this).addClass("scroll-down");
                }
            }
        }
    });
});

function isElementInViewport(el) {
    var rect = el.getBoundingClientRect();
    return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
}


const hamburgerMenu = document.querySelector('.hamburger-menu');

hamburgerMenu.addEventListener('click', () => {
    // Utilisation de SweetAlert pour afficher la fenêtre contextuelle
    Swal.fire({
        title: '🪙',
        html: '<ul><li><a href="#">Accueil</a></li><li><a href="#">Services</a></li><li><a href="https://codepen.io/h-lautre">Produits</a></li><li><a href="https://github.com/berru-g/">Contact</a></li></ul>',
        showCloseButton: true,
        showConfirmButton: false,
        customClass: {
            popup: 'custom-swal-popup',
            closeButton: 'custom-swal-close-button',
            content: 'custom-swal-content',
        }
    });
});

