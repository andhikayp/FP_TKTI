<!doctype html>
<html lang="en" class="no-focus">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>Simarak</title>

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="{{ base_url('codebase/src/assets/media/favicons/favicon.png') }}">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
          <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
        <!-- END Icons -->

        <!-- Stylesheets -->

        <!-- Fonts and Codebase framework -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,400i,600,700">
        <link rel="stylesheet" id="css-main" href="{{ base_url('codebase/src/assets/css/codebase.min.css') }}">
        <link rel="stylesheet" id="css-main" href="{{ base_url('css/style.css') }}">

        <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
        <!-- <link rel="stylesheet" id="css-theme" href="{{ base_url('codebase/src//css/themes/flat.min.css"> -->
        <!-- END Stylesheets -->
        <style>

              #main-container{
                /* The image used */
                background-image: url("{{ base_url('codebase/src/assets/media/favicons/back.png') }}");

                /* Full height */
                height: 100%; 

                /* Center and scale the image nicely */
                background-repeat: repeat;
                background-size: contain;
              }
            </style>
    </head>
    <body>
        <div id="page-container" class="sidebar-inverse side-scroll page-header-fixed page-header-inverse main-content-boxed">

            <!-- Sidebar -->
            <nav id="sidebar">
                <!-- Sidebar Content -->
                <div class="sidebar-content">
                    <!-- Side Header -->
                    <div class="content-header content-header-fullrow bg-black-op-10">
                        <div class="content-header-section text-center align-parent">
                            <!-- Close Sidebar, Visible only on mobile screens -->
                            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                            <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r" data-toggle="layout" data-action="sidebar_close">
                                <i class="fa fa-times text-danger"></i>
                            </button>
                            <!-- END Close Sidebar -->

                            <!-- Logo -->
                            <div class="content-header-item">
                                <a class="link-effect font-w700" href="{{ base_url('') }}">
                                    <span class="font-size-xl text-dual-primary-dark">sima</span><span class="font-size-xl text-primary">rak</span>
                                </a>
                            </div>
                            <!-- END Logo -->
                        </div>
                    </div>
                    <!-- END Side Header -->

                    <!-- Side Main Navigation -->
                    <div class="content-side content-side-full">
                        <!--
                        Mobile navigation, desktop navigation can be found in #page-header

                        If you would like to use the same navigation in both mobiles and desktops, you can use exactly the same markup inside sidebar and header navigation ul lists
                        -->
                        <ul class="nav-main">
                        <li>
                                <a class="active" href="{{ base_url('') }}">Beranda</a>
                            </li>
                            <li>
                                <a  href="#layanan">Layanan</a>
                            </li>
                            <li>
                                <a href="#tentang-kami">Tentang Kami</a>
                            </li>
                            <li>
                                <a href="#">Login</a>
                            </li>
                        </ul>
                    </div>
                    <!-- END Side Main Navigation -->
                </div>
                <!-- Sidebar Content -->
            </nav>
            <!-- END Sidebar -->

            <!-- Header -->
            <header id="page-header">
                <!-- Header Content -->
                <div class="content-header">
                    <!-- Left Section -->
                    <div class="content-header-section">
                        <!-- Logo -->
                        <div class="content-header-item">
                            <a class="link-effect font-w700 mr-5" href="index.html">
                                <span class="font-size-xl text-dual-primary-dark">sima</span><span class="font-size-xl text-primary">rak</span>
                            </a>
                        </div>
                        <!-- END Logo -->
                    </div>
                    <!-- END Left Section -->

                    <!-- Middle Section -->
                    <div class="content-header-section d-none d-lg-block">
                        <!-- Header Navigation -->
                        <!--
                        Desktop Navigation, mobile navigation can be found in #sidebar

                        If you would like to use the same navigation in both mobiles and desktops, you can use exactly the same markup inside sidebar and header navigation ul lists
                        If your sidebar menu includes headings, they won't be visible in your header navigation by default
                        If your sidebar menu includes icons and you would like to hide them, you can add the class 'nav-main-header-no-icons'
                        -->
                        <ul class="nav-main-header">
                            <li>
                                <a class="active" href="{{ base_url('') }}">Beranda</a>
                            </li>
                            <li>
                                <a  href="#layanan">Layanan</a>
                            </li>
                            <li>
                                <a href="#tentang-kami">Tentang Kami</a>
                            </li>
                            <li>
                                <a href="{{ base_url('auth/index') }}">Login</a>
                            </li>
                        </ul>
                        <!-- END Header Navigation -->
                    </div>
                    <!-- END Middle Section -->

                    <!-- Right Section -->
                    <div class="content-header-section">
                        <!-- Color Themes + A few of the many header options (used just for demonstration) -->
                        <!-- Themes functionality initialized in Template._uiHandleTheme() -->
                        <div class="btn-group ml-5" role="group">
                            <button type="button" class="btn btn-circle btn-dual-secondary" id="page-header-themes-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-paint-brush"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right min-width-150" aria-labelledby="page-header-themes-dropdown">
                                <h6 class="dropdown-header text-center">Color Themes</h6>
                                <div class="row no-gutters text-center">
                                    <div class="col-4 mb-5">
                                        <a class="text-default" data-toggle="theme" data-theme="default" href="javascript:void(0)">
                                            <i class="fa fa-2x fa-circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-4 mb-5">
                                        <a class="text-elegance" data-toggle="theme" data-theme="{{ base_url('codebase/src/assets/css/themes/elegance.min.css')}}" href="javascript:void(0)">
                                            <i class="fa fa-2x fa-circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-4 mb-5">
                                        <a class="text-pulse" data-toggle="theme" data-theme="{{ base_url('codebase/src/assets/css/themes/pulse.min.css')}}" href="javascript:void(0)">
                                            <i class="fa fa-2x fa-circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-4 mb-5">
                                        <a class="text-flat" data-toggle="theme" data-theme="{{ base_url('codebase/src/assets/css/themes/flat.min.css')}}" href="javascript:void(0)">
                                            <i class="fa fa-2x fa-circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-4 mb-5">
                                        <a class="text-corporate" data-toggle="theme" data-theme="{{ base_url('codebase/src/assets/css/themes/corporate.min.css')}}" href="javascript:void(0)">
                                            <i class="fa fa-2x fa-circle"></i>
                                        </a>
                                    </div>
                                    <div class="col-4 mb-5">
                                        <a class="text-earth" data-toggle="theme" data-theme="{{ base_url('codebase/src/assets/css/themes/earth.min.css')}}" href="javascript:void(0)">
                                            <i class="fa fa-2x fa-circle"></i>
                                        </a>
                                    </div>
                                </div>
                                <h6 class="dropdown-header text-center">Header</h6>
                                <button type="button" class="btn btn-sm btn-block btn-alt-secondary" data-toggle="layout" data-action="header_fixed_toggle">Fixed Mode</button>
                                <button type="button" class="btn btn-sm btn-block btn-alt-secondary mb-10" data-toggle="layout" data-action="header_style_inverse_toggle">Style</button>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="be_layout_api.html">
                                    <i class="si si-chemistry"></i> All Options (API)
                                </a>
                            </div>
                        </div>
                        <!-- END Color Themes + A few of the many header options -->

                        <!-- Open Search Section -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <button type="button" class="btn btn-circle btn-dual-secondary" data-toggle="layout" data-action="header_search_on">
                            <i class="fa fa-search"></i>
                        </button>
                        <!-- END Open Search Section -->

                        <!-- Toggle Sidebar -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none" data-toggle="layout" data-action="sidebar_toggle">
                            <i class="fa fa-navicon"></i>
                        </button>
                        <!-- END Toggle Sidebar -->
                    </div>
                    <!-- END Right Section -->
                </div>
                <!-- END Header Content -->

                <!-- Header Search -->
                <div id="page-header-search" class="overlay-header">
                    <div class="content-header content-header-fullrow">
                        <form action="bd_search.html" method="post">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <!-- Close Search Section -->
                                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                                    <button type="button" class="btn btn-secondary px-15" data-toggle="layout" data-action="header_search_off">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <!-- END Close Search Section -->
                                </div>
                                <input type="text" class="form-control" placeholder="Search or hit ESC.." id="page-header-search-input" name="page-header-search-input">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-secondary px-15">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END Header Search -->

                <!-- Header Loader -->
                <!-- Please check out the Activity page under Elements category to see examples of showing/hiding it -->
                <div id="page-header-loader" class="overlay-header bg-primary">
                    <div class="content-header content-header-fullrow text-center">
                        <div class="content-header-item">
                            <i class="fa fa-sun-o fa-spin text-white"></i>
                        </div>
                    </div>
                </div>
                <!-- END Header Loader -->
            </header>
            <!-- END Header -->

            <!-- Main Container -->
            <main id="main-container">
                    <!-- Slider Area Start-->
                <div class="slider-area">
                    <div class="slider-active">
                        <div class="single-slider slider-height d-flex align-items-center">
                            <div class="container">
                                <div class="row d-flex align-items-center">
                                    <div class="col-lg-3 col-md-4 "></div>
                                    <div class="col-lg-6 col-md-9 " style="text-align:center;">
                                        <div class="hero__caption">
                                            <span data-animation="fadeInUp" data-delay=".4s">Sistem Informasi Berbagi Makanan</span>
                                            <h1 data-animation="fadeInUp" data-delay=".6s">Selamat Datang<br>Orang Baik</h1>
                                            <!-- Slider btn -->
                                        <div class="slider-btns">
                                                <!-- Video Btn -->
                                                <a data-animation="fadeInUp"  data-delay="1.0s" class="popup-video video-btn ani-btn" href="#"><i class="fas fa-play"></i></a>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 "></div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
                <!-- Slider Area End -->

                
                <!-- Page Content -->
                <div class="content content-full" id="itungan">
                    <div class="row visible" data-toggle="appear">
                        <!-- Row #1 -->
                        <div class="col-6 col-xl-3">
                            <a class="block block-link-rotate block-transparent text-right bg-primary-lighter" href="javascript:void(0)">
                                <div class="block-content block-content-full clearfix">
                                    <div class="float-left mt-10 d-none d-sm-block">
                                        <i class="si si-users fa-3x text-primary"></i>
                                    </div>
                                    <div class="font-size-h3 font-w600 text-primary-darker" data-toggle="countTo" data-speed="1000" data-to="1500">0</div>
                                    <div class="font-size-sm font-w600 text-uppercase text-primary-dark">Donatur</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-xl-3">
                            <a class="block block-link-rotate block-transparent text-right bg-primary-lighter" href="javascript:void(0)">
                                <div class="block-content block-content-full clearfix">
                                    <div class="float-left mt-10 d-none d-sm-block">
                                        <i class="si si-users fa-3x text-primary"></i>
                                    </div>
                                    <div class="font-size-h3 font-w600 text-primary-darker"><span data-toggle="countTo" data-speed="1000" data-to="780">0</span></div>
                                    <div class="font-size-sm font-w600 text-uppercase text-primary-dark">Mitra</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-xl-3">
                            <a class="block block-link-rotate block-transparent text-right bg-primary-lighter" href="javascript:void(0)">
                                <div class="block-content block-content-full clearfix">
                                    <div class="float-left mt-10 d-none d-sm-block">
                                        <i class="si si-users fa-3x text-primary"></i>
                                    </div>
                                    <div class="font-size-h3 font-w600 text-primary-darker" data-toggle="countTo" data-speed="1000" data-to="15">0</div>
                                    <div class="font-size-sm font-w600 text-uppercase text-primary-dark">Relawan</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-xl-3">
                            <a class="block block-link-rotate block-transparent text-right bg-primary-lighter" href="javascript:void(0)">
                                <div class="block-content block-content-full clearfix">
                                    <div class="float-left mt-10 d-none d-sm-block">
                                        <i class="si si-users fa-3x text-primary"></i>
                                    </div>
                                    <div class="font-size-h3 font-w600 text-primary-darker" data-toggle="countTo" data-speed="1000" data-to="4252">0</div>
                                    <div class="font-size-sm font-w600 text-uppercase text-primary-dark">Penerima Bantuan</div>
                                </div>
                            </a>
                        </div>
                        <!-- END Row #1 -->
                    </div>
                </div>
                <!-- END Page Content -->

                <!-- Best Features Start -->
                <section class="best-features-area inner-padding" id="layanan">
                    <div class="container">
                        <div class="row justify-content-end">
                            <div class="col-xl-8 col-lg-10">
                                <!-- Section Tittle -->
                                <div class="row">
                                    <div class="col-lg-10 col-md-10">
                                        <div class="section-tittle">
                                            <h2>Layanan</h2>
                                        </div>
                                    </div>
                                </div>
                                <!-- Section caption -->
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="single-features mb-70">
                                            <div class="features-icon">
                                                <span class="flaticon-support"></span>
                                            </div>
                                            <div class="features-caption">
                                                <h3>Donatur</h3>
                                                <p>Donatur dapat memesan makanan untuk memberi bantuan kepada orang yang membutuhkan</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="single-features mb-70">
                                            <div class="features-icon">
                                                <span class="flaticon-support"></span>
                                            </div>
                                            <div class="features-caption">
                                                <h3>Mitra</h3>
                                                <p>Mitra menyediakan makanan sesuai yang dipesan oleh Donatur</p>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="single-features mb-70">
                                            <div class="features-icon">
                                                <span class="flaticon-support"></span>
                                            </div>
                                            <div class="features-caption">
                                                <h3>Relawan</h3>
                                                <p>Relawan mengantarkan makanan kepada Penerima Bantuan</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="single-features mb-70">
                                            <div class="features-icon">
                                                <span class="flaticon-support"></span>
                                            </div>
                                            <div class="features-caption">
                                                <h3>Penerima Bantuan</h3>
                                                <p>Penerima Bantuan akan menerima bantuan yang diantarkan oleh relawan dibuat oleh mitra dan sumber dana dari donatur</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Shpe -->
                    <div class="features-shpae features-shpae2 d-none d-lg-block" style="margin-top:-14%;">
                        <img src="{{ base_url('codebase/src/assets/media/favicons/layanan.png') }}" alt="">
                    </div>
                </section>
                <!-- Best Features End -->

                <!-- Applic App Start -->
                <div class="applic-apps section-padding2" style="margin-top:10%;margin-bottom:5%;" id="tentang-kami">
                    <div class="container-fluid">
                        <div class="row">
                            <!-- slider Heading -->
                            <div class="col-xl-4 col-lg-4 col-md-8">
                                <div style="text-align:justify; padding-right:2%;" class="single-cases-info mb-30">
                                    <h3>Tentang Kami</h3>
                                    <p>Simarak adalah platform yang mempunyai tujuan memudahkan manusia untuk saling membantu. Pada platform ini, donatur dapat dengan mudah untuk menyumbangkan bantuannya berupa uang. Uang tersebut akan diolah oleh mitra sehingga bantuan yang diberikan dapat berupa makanan atau kebutuhan primer lainnya. Setelah proses pengolahan selesai, relawan akan mengantarkan bantuan tersebut kepada penerima bantuan.</p>
                                </div>
                            </div>
                            <!-- OwL -->
                            <div class="col-xl-6 col-lg-8 col-md-col-md-7" style="margin-left : 10%;">
                                <div class="app-active owl-carousel"> 
                                    <div class="single-cases-img">
                                        <img width="100%"src="{{ base_url('codebase/src/assets/media/favicons/App1.png') }}" alt="">
                                    </div>
                                    <!-- <div class="single-cases-img">
                                        <img src="{{ base_url('codebase/src/assets/media/favicons/App2.png') }}" alt="">
                                    </div>
                                    <div class="single-cases-img">
                                        <img src="{{ base_url('codebase/src/assets/media/favicons/App3.png') }}" alt="">
                                    </div>
                                    <div class="single-cases-img">
                                        <img src="{{ base_url('codebase/src/assets/media/favicons/App2.png') }}" alt="">
                                    </div>
                                    <div class="single-cases-img">
                                        <img src="{{ base_url('codebase/src/assets/media/favicons/App1.png') }}" alt="">
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Applic App End -->
                


            </main>
            <!-- END Main Container -->

            <!-- Footer -->
            <footer id="page-footer" class="opacity-0">
                <div class="content py-20 font-size-xs clearfix">
                    <div class="float-left">
                        <a class="font-w600" href="#" target="_blank">Simarak 1.0</a> &copy; <span class="js-year-copy">2020</span>
                    </div>
                </div>
            </footer>
            <!-- END Footer -->
        </div>

        <script src="{{ base_url('codebase/src/assets/js/codebase.core.min.js')}}"></script>

        <script src="{{ base_url('codebase/src/assets/js/codebase.app.min.js')}}"></script>

        <script src="{{ base_url('codebase/src/assets/js/plugins/chartjs/Chart.bundle.min.js')}}"></script>

        <script src="{{ base_url('codebase/src/assets/js/pages/be_pages_dashboard.min.js')}}"></script>
        
    </body>
</html>