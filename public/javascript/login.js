$(document).ready(function () {
    // ambil id
    var x = document.getElementById("passwordLogin");
    var show_eye = document.getElementById("showPass");
    var hide_eye = document.getElementById("hidePass");

    // Change Color Background eye
    var pass = document.getElementById('pass');

    // Preparation
    hide_eye.classList.remove("d-none");
    show_eye.style.display = "none";
    hide_eye.style.display = "block";

    $('.input-group-text.pass').mousedown(function () {
        x.type = "text";
        show_eye.style.display = "block";
        hide_eye.style.display = "none";
        pass.style.backgroundColor = "rgb(206, 208, 209)";0
    });

    $('.input-group-text.pass').mouseup(function () {
        x.type = "password";
        show_eye.style.display = "none";
        hide_eye.style.display = "block";
        pass.style.backgroundColor = "rgb(233, 236, 239)";
    });

});

