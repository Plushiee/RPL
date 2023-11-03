<!doctype html>
<html lang="en">

<head>
    <title>MoneyTrash! - Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- App favicon -->
    <link rel="shortcut icon" href="/assets/navbar/logo.png">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/styles/login.css">

</head>

<body>
    <main>
        <!-- Login -->
        <div class="container-lg rounded d-flex justify-content-center mt-2 pt-0 mt-sm-3 mt-md-4 pt-lg-5 pt-xxl-5">
            <div class="card-group">
                <div class="card mx-5">
                    <center>
                        <div class="card-body form-logo">
                            <img src="assets/navbar/logo.png" alt="logo" class="img-fluid mb-3">
                            <h3 class="m-0 p-0">Buang Sampah Mudah dengan MoneyTrash</h3>
                            <p>Trash Me! It’s Work</p>
                        </div>
                    </center>
                </div>

                <div class="card mx-5 rounded border form-login">
                    <div class="card-body p-0 m-0">
                        <div class="form p-5">
                            <div class="row mb-5 text-center">
                                <div class="col">
                                    <h1 class="title">Masuk Akun</h1>
                                </div>
                            </div>
                            <form action="/login/loginCheck" method="POST" id="formLogin">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col">
                                        <input type="email" class="form-control" id="emailLogin" name="emailLogin"
                                            placeholder="Email" autocomplete="email" required>
                                    </div>
                                </div>

                                <div class="row mb-1">
                                    <div class="col">
                                        <div class="input-group px-0">
                                            <input type="password" class="form-control" id="passwordLogin"
                                                name="passwordLogin" placeholder="Kata Sandi"
                                                autocomplete="passwordLogin" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text pass" id="pass">
                                                    <i class="bi bi-eye-fill" id="showPass"></i>
                                                    <i class="bi bi-eye-slash-fill" id="hidePass"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-5 pe-0">
                                        <input type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            {{ __('Ingat Saya') }}
                                        </label>
                                    </div>
                                    <div class="col-7 text-end ps-0">
                                        <a href="">Lupa Kata Sandi?</a>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="g-recaptcha" data-sitekey="6LcHsO4oAAAAAHQ0-JzJ2Pz5yUQQKbK9gGOBdzo5"
                                        data-size="invisible" data-callback="formSubmit" data-badge='inline'> </div>
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-success submit">Masuk</button>
                                    </div>
                                </div>

                                <div class="row text-center">
                                    <div class="col">
                                        <p>Belum Punya Akun? <a href="./register">Mendaftar</a></p>
                                    </div>
                                </div>

                                <div class="divider d-flex align-items-center mb-3">
                                    <p class="text-center fw-bold mx-3 mb-0">atau menggunakan</p>
                                </div>
                            </form>
                            <div class="row mb-3">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary login"><i
                                            class="bi bi-google float-start"></i>Google</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <!-- place footer here -->
    </footer>

    {{-- Javascript  --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script>
        function onSubmit(token) {
            document.getElementById("formRegister").submit(function(event) {
                event.preventDefault();
                grecaptcha.reset();
                grecaptcha.execute();
            });
        }
    </script>
    <script src="javascript/login.js"></script>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>

    {{-- Alert --}}
    @if (session('success'))
        <script>
            $(document).ready(function() {
                // Alert
                var toastMixin = Swal.mixin({
                    toast: true,
                    icon: 'success',
                    title: 'General Title',
                    position: 'top-right',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });

                toastMixin.fire({
                    animation: true,
                    title: 'Akun Berhasil Ditambahkan'
                });
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            $(document).ready(function() {
                // Alert
                var toastMixin = Swal.mixin({
                    toast: true,
                    icon: 'error',
                    title: 'General Title',
                    position: 'top-right',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });

                toastMixin.fire({
                    animation: true,
                    title: 'Email atau kata sandi salah'
                });
            });
        </script>
    @endif
</body>

</html>
