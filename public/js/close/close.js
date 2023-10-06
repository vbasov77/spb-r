$('body').on('click', '.close', function (e) {
    let el = document.getElementById("info");
    removeFadeOut(el, 500);
});

function removeFadeOut(el, speed) {
    var seconds = speed / 500;
    el.style.transition = "opacity " + seconds + "s ease";
    el.style.opacity = 0;
    setTimeout(function () {
        el.parentNode.removeChild(el);
    }, speed);
}