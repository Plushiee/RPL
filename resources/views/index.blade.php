<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MoneyTrash - Trash Me!, It's Work</title>
    <!-- Favicon CSS -->
    <link rel="icon" type="img/png" sizes="32x32" href="/assets/navbar/logo.png">
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,300i,400,400i,500,500i,700,700i&display=swap"
        rel="stylesheet">
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="/assets/styles/index/plugins.min.css">
    <!-- Style CSS -->
    <link rel="stylesheet" href="/assets/styles/index/app.css">

    <!-- Your CSS -->
    <link rel="stylesheet" href="/assets/styles/index/custom.css">

</head>

<body class="theme-gradient-1" data-appearance="light">
    <main class="main">
        <!-- =========== Start of  Navigation ============ -->

        <nav class="navbar navigation__transparent navbar-expand-lg navbar-light position-absolute">
            <div class="container position-relative">

                <a class="navbar-brand" href="index">
                    <img src="/assets/navbar/logo-long-dark.png" alt="" class="img-fluid" width="230px">
                </a>
                <!-- navbar-brand end -->

                <button class="navbar-toggler d-block d-sm-none" type="button" data-toggle="collapse"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon d-block d-sm-none"></span>
                </button>
                <!-- navbar-toggler end -->

                <div class="navbar-inner ml-auto mr-lg-50 d-block d-sm-none" id="navbar-inner">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <!-- navbar-toggler end -->

                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="login">Login!</a>
                        </li>
                    </ul>
                </div>
                <!-- collapse end -->
                <div class="navbar-btn mr-60 mr-lg-0">
                    <a href="login"
                        class="btn btn-outline btn-outline--sm border-color-white btn-color--white btn-outline-hover--white btn-hover">Login</a>
                </div>
            </div>
        </nav>
        <!-- =========== End of  Navigation ============ -->


        <!-- =========== End of  Hero ============ -->
        <section class="hero hero--v1 hero--full overflow-hidden d-flex align-items-center">
            <div class="background-holder background--center background--cover">
                <img src="img/hero-bg-1.png" alt="" class="background-image-holder">
            </div>
            <div class="gradient-10 background-holder background--center opacity--70"></div>

            <div class="container mb-100">
                <div class="row text-center text-lg-left pb-70 pb-lg-0">
                    <div class="col-12 col-lg-6">
                        <div class="hero-content mb-35">
                            <h1 class="color-white mb-15" style="font-weight: bold">MoneyTrash<br>Trash Me! It's Work
                            </h1>
                            <p class="h6-font color-white">Merupakan suatu terobosan aplikasi berbasis web yang
                                dirancang khusus untuk memberikan dukungan yang sangat vital kepada Bank Sampah dalam
                                pengelolaan dan pelaporan sampah yang ada dan dimilikinya.
                            </p>
                        </div>
                        <a href="register"
                            class="btn btn-bg--cta--1 btn-size--xl color-dark-500 box-shadow--1 btn-hover">Register
                            For Free</a>
                        <div class="col-12 col-lg-5 hero-img pos-abs-bottom-right d-lg-none">
                            <span>
                                <img src="/assets/navbar/logo.png" alt="hero-image" class="img-fluid p-5 m-5"
                                    width="320px">
                            </span>
                        </div>
                    </div>
                    <!-- col-12 end -->

                    <div class="col-12 col-lg-5 hero-img pos-abs-bottom-right d-none d-lg-block">
                        <span>
                            <img src="/assets/navbar/logo-long-vertical.png" alt="hero-image" class="img-fluid">
                        </span>
                    </div>
                    <!-- col-12 end -->
                </div>
            </div>
            <div class="svg-shape w-100">
                <img src="img/layout/hero-wave-1.svg" alt="wave" class="svg">
            </div>
        </section>
        <!-- =========== End of  Hero ============ -->

        <!-- =========== Start of features-one ============ -->
        <section class="features features--v1 mb-30"> <!--space--top -->
            <div class="container mt-10">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="feature text-center mb-50 mb-md-0">
                            <span class="feature-icon mb-1 icon--4x">
                                <iconify-icon icon="icon-park-outline:earth" height="96"></iconify-icon>
                            </span>
                            <h5 class="feature-title mb-0">Praktis</h5>
                            <p class="m-0">Berjalan secara digital
                            </p>
                        </div>
                        <!-- feature end -->
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="feature text-center mb-50 mb-md-0">
                            <span class="feature-icon mb-1 icon--4x">
                                <iconify-icon icon="icon-park-outline:circular-connection"
                                    height="96"></iconify-icon>
                            </span>
                            <h5 class="feature-title mb-0">Terintergrasi</h5>
                            <p class="m-0">Terintegrasi dengan bank sampah
                            </p>
                        </div>
                        <!-- feature end -->
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="feature text-center mb-50 mb-md-0">
                            <span class="feature-icon mb-1 icon--4x">
                                <iconify-icon icon="octicon:thumbsup-24" height="96"></iconify-icon>
                            </span>
                            <h5 class="feature-title mb-0">Mudah</h5>
                            <p class="m-0">Mudah dalam membuang sampah
                            </p>
                        </div>
                        <!-- feature end -->
                    </div>
                </div>
            </div>

            <div class="container mt-30">
                <div class="row">
                    <div class="col-12 text-center">
                        <h1 class="m-0 p-0" id="jumlahMitra" style="font-weight: bold">0</h1>
                        <h5 class="mt-0 mb-4" >Mitra Terintegrasi</h5>
                        <div class="mt-15 rounded" id="map" style="width: 100%; height: 400px;"></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- =========== End of features-one ============ -->

        <!-- =========== Start of footer  ============ -->
        <footer class="footer footer--v1 section-light border-top border-color-light--3 pt-25 pb-25">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-7 mx-auto">
                        <div class="text-center">
                            <a class="mb-25" href="index.html">
                                <img src="/assets/navbar/logo.png" alt="" width="50px">
                            </a>
                            <p class="font-size--16 text-color--400 mb-55">MoneyTrash! <br> Salah satu project RPL yang
                                didirikan oleh Team RPL Moneytrash</p>

                            <div class="widget widget-nav">
                                <ul>
                                    <li>
                                        <a href="#">Kantor</a>
                                    </li>
                                    <li>
                                        <a href="#">Terms & Conditions</a>
                                    </li>
                                    <li>
                                        <a href="#">Privacy Policy</a>
                                    </li>
                                    <li>
                                        <a href="#">Media Social</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- widget end -->
                            <span
                                class="copyright text-color--400 text-dark-400 d-flex align-items-center justify-content-center">
                                &copy;2023 Team RPL
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- =========== End of footer ============ -->

    </main>
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
    <script src="/assets/js/index/plugins.min.js"></script>
    <script src="/assets/js/index/app.js"></script>
    <script src="/javascript/number-rush.js"></script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBg-aZ-Iammau9oEl569JVpJu5olD_2rbQ&callback=initMap&libraries=places"></script>
    <script src="/javascript/gps-map.js"></script>
</body>

</html>
