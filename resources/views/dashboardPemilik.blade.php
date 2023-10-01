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
    <link rel="stylesheet" href="css/dashboardPemilik.css">

    <!-- Font -->
    <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>
    <!-- Font -->
</head>

<body style="width: 100%">
    <header>
        <!-- Navbar -->
        <div class="d-inline">
            <div id="wrapper">
                <aside id="sidebar-wrapper">
                    <button class="float-end align-text-top pe-1" id="close-sidebar">
                        <i class="bi bi-x" style="color: black"></i>
                    </button>

                    <div class="sidebar-brand p-0 mt-2">
                        <div class="m-0 p-0 d-flex align-items-center">
                            <img src="assets/navbar/logo.png" alt="Logo" width="50" height="50"
                                class="d-inline-block ms-1 float-start">
                            <h2 class="m-0 p-0 ms-2 align-middle" style="color: BLACK"> MONEYTRASH</h2>
                        </div>

                    </div>

                    <ul class="sidebar-nav">
                        <li class="active">
                            <a href="#"><i class="bi bi-house"></i> <span id="icon-home"> Home</span></a>
                        </li>
                        <li>
                            <a href="#"><i class="bi bi-activity"></i><span id="icon-pembayaran">
                                    Pembayaran</span></a>
                        </li>
                        <li>
                            <a href="#"><i class="bi bi-clock-history"></i><span id="icon-riwayat">
                                    Riwayat</span></a>
                        </li>
                        <li>
                            <a href="#"><i class="bi bi-person"></i><span id="icon-pengaturan">
                                    Pengaturan</span></a>
                        </li>
                    </ul>
                </aside>

                <div id="navbar-wrapper">
                    <nav class="navbar navbar-inverse">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <a href="#" class="navbar-brand" id="sidebar-toggle"><i
                                        class="bi bi-list"></i></a>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Navbar -->
    </header>

    <main>
        <div class="me-0" id="content-wrapper">
            <div class="row">
                <div class="col-lg-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <h1>Jenis Layanan</h1>
                                <div class="col-md-6 pb-2 pb-sm-2 pb-md-0 pb-lg-0 pb-xl-0 d-flex justify-content-center">
                                    <button class="btn btn-warning btn-block ambil">Ambil Di Rumah</button>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-success btn-block antar d-flex justify-content-center">Antar Sendiri</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Maps --}}
            <div class="row">
                <div class="col-lg-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <h1>Peta</h1>
                            </div>
                            <div class="row m-0 p-0 border">
                                <div id="map"></div>
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

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>

    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBPCyuCDP-NsuKm_SVIyga-LHZilnWyzmo&callback=initMap"></script>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- JavaScript -->
    <script src="javascript/dashboard.js"></script>

</body>

</html>
