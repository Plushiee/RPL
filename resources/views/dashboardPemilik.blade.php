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

<body>
    <main>
        <div id="wrapper">

            <aside id="sidebar-wrapper">
                <div class="sidebar-brand">
                    <h2><img src="assets/navbar/logo.png" alt="Logo" width="30" height="24"
                            class="d-inline-block align-text-top">
                        MONEYTRASH</h2>
                </div>
                <ul class="sidebar-nav">
                    <li class="active">
                        <a href="#"><i class="fa fa-home"></i>Home</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-plug"></i>Plugins</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-user"></i>Users</a>
                    </li>
                </ul>
            </aside>

            <div id="navbar-wrapper">
                <nav class="navbar navbar-inverse">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <a href="#" class="navbar-brand" id="sidebar-toggle"><i class="bi bi-list"></i></a>
                        </div>
                    </div>
                </nav>
            </div>

            <section id="content-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="content-title">Test</h2>
                        <p>Lorem ipsum...</p>
                    </div>
                </div>
            </section>

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

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- JavaScript -->
    <script type="text/javascript" src="{{ URL::asset('js/dashboard.js') }}"></script>
</body>

</html>
