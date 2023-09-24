$(document).ready(function () {
    var x = document.getElementById("passwordLogin");
    var show_eye = document.getElementById("showPass");
    var hide_eye = document.getElementById("hidePass");
    hide_eye.classList.remove("d-none");

    show_eye.style.display = "none";
    hide_eye.style.display = "block";

    $('.input-group-text').mousedown(function () {
        x.type = "text";
        show_eye.style.display = "block";
        hide_eye.style.display = "none";
    });

    $('.input-group-text').mouseup(function () {
        x.type = "password";
        show_eye.style.display = "none";
        hide_eye.style.display = "block";
    });
});

