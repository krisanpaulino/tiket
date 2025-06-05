<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>Tiket Bus Kupang</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('/') }}images/favicon.ico">

    <!--Swiper slider css-->
    <link href="{{ asset('/') }}libs/swiper/swiper-bundle.min.css" rel="stylesheet" type="text/css" />
    @yield('cssplugins')

    <!-- Layout config Js -->
    <script src="{{ asset('/') }}js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('/') }}css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('/') }}css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('/') }}css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ asset('/') }}css/custom.min.css" rel="stylesheet" type="text/css" />

</head>

<body data-bs-spy="scroll" data-bs-target="#navbar-example">

    <!-- Begin page -->
    <div class="layout-wrapper landing">
        <nav class="navbar navbar-expand-lg navbar-landing navbar-light fixed-top" id="navbar">
            <div class="container">
                <a class="navbar-brand" href="/">
                    {{-- <img src="{{ asset('/') }}images/logo-dark.png" class="card-logo card-logo-dark" alt="logo dark"
                        height="17">
                    <img src="{{ asset('/') }}images/logo-light.png" class="card-logo card-logo-light"
                        alt="logo light" height="17"> --}}
                </a>
                <button class="navbar-toggler py-0 fs-20 text-body" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <i class="mdi mdi-menu"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mt-2 mt-lg-0" id="navbar-example">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}#hero">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}#wallet">About</a>
                        </li>
                        @if (Session::get('login_penumpang'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('pesan.page') }}">Pesan Tiket</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('transaksi') }}">History Pesanan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('profil') }}">Profil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/logout">Log Out</a>
                            </li>
                        @endif
                    </ul>

                </div>

            </div>
        </nav>
        <div class="bg-overlay bg-overlay-pattern"></div>
        <!-- end navbar -->
        @yield('content')
        <!--start back-to-top-->
        <button onclick="topFunction()" class="btn btn-danger btn-icon landing-back-top" id="back-to-top">
            <i class="ri-arrow-up-line"></i>
        </button>
        <!--end back-to-top-->

    </div>
    <!-- end layout wrapper -->


    <!-- JAVASCRIPT -->
    <script src="{{ asset('/') }}libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('/') }}libs/simplebar/simplebar.min.js"></script>
    <script src="{{ asset('/') }}libs/node-waves/waves.min.js"></script>
    <script src="{{ asset('/') }}libs/feather-icons/feather.min.js"></script>
    <script src="{{ asset('/') }}js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    @yield('jsplugins')
    <script src="{{ asset('/') }}js/plugins.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <!--Swiper slider js-->
    <script src="{{ asset('/') }}libs/swiper/swiper-bundle.min.js"></script>

    <script src="{{ asset('/') }}js/pages/nft-landing.init.js"></script>

    @yield('scripts')
    <script>
        function dangerToast(message) {
            Toastify({
                'text': message,
                style: {
                    background: '#fd2e64',
                }
            }).showToast()
        }

        function successToast(message) {
            Toastify({
                'text': message,
            }).showToast()
        }
    </script>
</body>

</html>
