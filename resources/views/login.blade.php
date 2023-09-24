<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/login.css">

</head>

<body>
    <header>
        <div class="container-fluid container-nav">
            <nav class="navbar bg-body-tertiary">
                <a class="navbar-brand float-start mx-4" href="#">
                    <img src="assets/navbar/logo.png" alt="logo" height="50px">
                </a>
            </nav>
        </div>
    </header>

    <main>
        <!-- Login -->
        <div class="form container-lg rounded px-0 mx-0">
            <div class="border p-5">

                <div class="row mb-5 text-center">
                    <div class="col">
                        <h1 class="title">Masuk Akun</h1>
                    </div>
                </div>
                <form action="">
                    <div class="row mb-3">
                        <div class="col">
                            <input type="email" class="form-control" id="emailLogin" placeholder="Email">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="input-group px-0">
                                <input type="password" class="form-control" id="passwordLogin" placeholder="Kata Sandi">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="bi bi-eye-fill" id="showPass"></i>
                                        <i class="bi bi-eye-slash-fill" id="hidePass"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row text-end mb-3">
                        <div class="col">
                            <a href="">Lupa Kata Sandi?</a>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success submit">Masuk</button>
                        </div>
                    </div>

                    <div class="row text-center">
                        <div class="col">
                            <p>Belum Punya Akun? <a href="">Mendaftar</a></p>
                        </div>
                    </div>

                    <div class="divider d-flex align-items-center mb-3">
                        <p class="text-center fw-bold mx-3 mb-0">atau</p>
                    </div>

                    <div class="row mb-3">
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary login"><i class="bi bi-google float-start"></i> Login Menggunakan Google</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <footer>
        <!-- place footer here -->
    </footer>

    {{-- Javascript  --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <script src="javascript/login.js"></script>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>
