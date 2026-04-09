<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Ecommerce Dashboard &mdash; Stisla</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/modules/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA -->
</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i
                                    class="fas fa-bars"></i></a></li>
                    </ul>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown"
                            class="nav-link dropdown-toggle nav-link-lg nav-link-user" aria-expanded="false">
                            <div class="d-sm-none d-lg-inline-block">
                                <i class="fas fa-globe"></i> EN
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="" class="dropdown-item has-icon text-primary">
                                <i class="fas fa-check-circle"></i> English
                            </a>
                            <a href="" class="dropdown-item has-icon ">
                                <i class="fas fa-check-circle"></i> Bahasa Indonesia
                            </a>
                        </div>
                    </li>
                    <li class="dropdown"><a href="#" data-toggle="dropdown"
                            class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt=""
                                src="https://omdb-app-master-mx2c8l.laravel.cloud/assets/img/avatar/avatar-1.png"
                                class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">Hi, Rahmatul fadillah</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-divider"></div>
                            <a href="{{ url('/logout') }}" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="index.html">rahmatul fadillah</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="index.html">MS</a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">Pages</li>
                        <li class="dropdown">
                            <a href="#" class="nav-link has-dropdown"><i
                                    class="fas fa-film"></i><span>Movies</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="{{ url('dashboard') }}">Search Movies</a></li>
                                <li class=active><a class="nav-link" href="{{ url('dashboard') }}">My Favorites</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </aside>
            </div>

            <!-- Main Content -->
            <div class="main-content" style="min-height: 583px;">
                <section class="section">
                    <div class="section-header">
                        <h1>My Favorites</h1>
                        <div class="section-header-breadcrumb">
                            <div class="breadcrumb-item active">Dashboard</>
                            </div>
                            <div class="breadcrumb-item">Favorites</div>
                        </div>
                    </div>

                    <div class="section-body">
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Favorite Movies</h4>
                                    </div>
                                    <div class="card-body">
                                        <div id="favorites-content">
                                            <div class="text-center py-5">
                                                <i class="fas fa-heart-broken fa-3x text-muted mb-3 d-block"></i>
                                                <h5 class="text-muted">No favorites yet</h5>
                                                <p class="text-muted">Start adding movies to your favorites list!</p>
                                                <a href="" class="btn btn-primary mt-2">
                                                    <i class="fas fa-search"></i> Search Movies
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <!-- General JS Scripts -->
            <script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
            <script src="{{ asset('assets/modules/popper.js') }}"></script>
            <script src="{{ asset('assets/modules/tooltip.js') }}"></script>
            <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
            <script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
            <script src="{{ asset('assets/modules/moment.min.js') }}"></script>
            <script src="{{ asset('assets/js/stisla.js') }}"></script>

            <!-- JS Libraies -->
            <script src="{{ asset('assets/modules/jquery.sparkline.min.js') }}"></script>
            <script src="{{ asset('assets/modules/chart.min.js') }}"></script>
            <script src="{{ asset('assets/modules/owlcarousel2/dist/owl.carousel.min.js') }}"></script>
            <script src="{{ asset('assets/modules/summernote/summernote-bs4.js') }}"></script>
            <script src="{{ asset('assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

            <!-- Page Specific JS File -->
            <script src="{{ asset('assets/js/page/index.js') }}"></script>

            <!-- Template JS File -->
            <script src="{{ asset('assets/js/scripts.js') }}"></script>
            <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>

</html>