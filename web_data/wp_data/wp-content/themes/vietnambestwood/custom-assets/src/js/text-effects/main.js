export function mainTextEffect($) {
    $(window).on("scroll", function () {
    $(".text-intro-effect").find( "p, h1, h2, h3" ).each(function () {
        if (isElementInViewport(this)) {
            $(this).addClass("visible");
        }
    });
});
}


function isElementInViewport(el) {
    var rect = el.getBoundingClientRect();
    return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
}

console.log('OK')