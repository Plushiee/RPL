<!doctype html>
<html lang="en">

<head>
    <title>MoneyTrash!</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/styles/pilih-akun.css">

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

                <div class="card mx-5 rounded">
                    <div class="card-body p-0 m-0 d-flex align-items-center">
                        <div class="form p-5 border form-pilih">
                            <div class="row mb-5 text-center">
                                <div class="col">
                                    <h1 class="title">Masuk Sebagai</h1>
                                </div>
                            </div>
                            <form method="POST" action="{{ route('loginPemilik') }}">
                                @csrf
                                <div class="row mb-4">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-success submit" id="pemilik">Pemilik
                                            Sampah</a>
                                    </div>
                                </div>
                            </form>
                            <form method="POST" action="{{ route('loginPengambil') }}">
                                @csrf
                                <input type="hidden" id="email" name="email" value="{{ Auth::user()->email }}">
                                <input type="hidden" id="remember" name="remember" value="{{ Auth::user()->remember_token }}">
                                <div class="row mb-4">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-success submit" id="pengambil">Pengambil
                                            Sampah</button>
                                    </div>
                                </div>
                            </form>
                            <form method="POST" action="{{ route('loginPengambil') }}">
                                @csrf
                                <div class="row mb-4">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-success submit" id="bank">Bank
                                            Sampah</button>
                                    </div>
                                </div>
                            </form>
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

    <script src="javascript/pilih.js"></script>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>
