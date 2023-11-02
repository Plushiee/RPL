$(document).ready(function () {
    // ambil id
    var x = document.getElementById("passwordRegister");
    var y = document.getElementById("passwordConformation");
    var show_eye = document.getElementById("showPass");
    var hide_eye = document.getElementById("hidePass");
    var show_eye_conf = document.getElementById("showPassConf");
    var hide_eye_conf = document.getElementById("hidePassConf");

    // Change Color Background eye
    var conf = document.getElementById('conf');
    var pass = document.getElementById('pass');

    // Preparation
    hide_eye.classList.remove("d-none");
    show_eye.style.display = "none";
    hide_eye.style.display = "block";
    show_eye_conf.style.display = "none";
    hide_eye_conf.style.display = "block";

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

    $('.input-group-text.conf').mousedown(function () {
        y.type = "text";
        show_eye_conf.style.display = "block";
        hide_eye_conf.style.display = "none";
        conf.style.backgroundColor = "rgb(206, 208, 209)";
    });

    $('.input-group-text.conf').mouseup(function () {
        y.type = "password";
        show_eye_conf.style.display = "none";
        hide_eye_conf.style.display = "block";
        conf.style.backgroundColor = "rgb(233, 236, 239)";
    });

    $('.register-google').click(function (e) { 
        e.preventDefault();
        
        // Konfigurasi OAuth 2.0
        const clientId = '233436046340-3g8k1tar7j9evj6btbbgb7l9ak4637hn.apps.googleusercontent.com'; // Ganti dengan ID klien OAuth Anda
        const redirectUri = 'https://rpl.plushiee.my.id/register/auth'; // Ganti dengan URI pengalihan Anda

        // Bangun URL otorisasi Google
        const authUrl = `https://accounts.google.com/o/oauth2/auth?` +
            `client_id=${clientId}&redirect_uri=${redirectUri}&` +
            `scope=openid%20profile%20email&response_type=token&prompt=select_account`;

        // Buka jendela otorisasi Google
        window.location.href = authUrl;
    });
});

