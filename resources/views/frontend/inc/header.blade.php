<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Meta -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0, maximum-scale=1">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="WEBbrella Infotech">
        <!-- Page Title -->
        <title>WODEHOUSE GYMKHANA</title>
        <!-- Favicon Icon -->
        <link rel="shortcut icon" type="image/x-icon" href="/public/frontend/images/favicon.png">
        <!-- Google Fonts Css-->
        <link rel="preconnect" href="https://fonts.googleapis.com/">
        <link
            rel="preconnect"
            href="https://fonts.gstatic.com/"
            crossorigin="crossorigin">
        <link
            href="https://fonts.googleapis.com/css2?family=Inter+Tight:ital,wght@0,100..900;1,100..900&amp;display=swap"
            rel="stylesheet">
        <!-- Bootstrap Css -->
        <link href="/public/frontend/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <!-- SlickNav Css -->
        <link href="/public/frontend/css/slicknav.min.css" rel="stylesheet">
        <!-- Swiper Css -->
        <link rel="stylesheet" href="/public/frontend/css/swiper-bundle.min.css">
        <!-- Font Awesome Icon Css-->
        <link href="/public/frontend/css/all.min.css" rel="stylesheet" media="screen">
        <!-- Animated Css -->
        <link href="/public/frontend/css/animate.css" rel="stylesheet">
        <!-- Magnific Popup Core Css File -->
        <link rel="stylesheet" href="/public/frontend/css/magnific-popup.css">
        <!-- Mouse Cursor Css File -->
        <link rel="stylesheet" href="/public/frontend/css/mousecursor.css">
        <!-- Main Custom Css -->
        <link href="/public/frontend/css/custom.css" rel="stylesheet" media="screen">
        <link href="/public/frontend/custom.css" rel="stylesheet" media="screen">
    </head>
    <body>
        <!-- Preloader Start -->
        <div class="preloader d-none">
            <div class="loading-container">
                <div class="loading"></div>
                <div id="loading-icon"><img src="/public/frontend/images/loader.svg" alt=""></div>
            </div>
        </div>
        <!-- Preloader End -->
        <!-- Header Start -->
        <header class="main-header">
            <div class="header-sticky">
                <nav class="navbar navbar-expand-lg">
                    <div class="container">
                        <!-- Logo Start -->
                        <a class="navbar-brand" href="/">
                            <img src="/public/frontend/images/favicon.png" alt="Logo">
                        </a>
                        <!-- Logo End -->
                        <!-- Main Menu Start -->
                        <div class="collapse navbar-collapse main-menu position-relative">
                            <div class="nav-menu-wrapper">
                                <ul class="navbar-nav mr-auto" id="menu">
                                    <li class="nav-item submenu">
                                        <a class="nav-link" href="/">Home</a>
                                    </li>
                                    <li class="nav-item submenu">
                                        <a class="nav-link" href="/about-us">About Us</a>
                                    </li>
                                    <li class="nav-item submenu">
                                        <a class="nav-link" href="">Sports</a>
                                        <ul>
                                            <li class="nav-item">
                                                <a class="nav-link" href="/tennis">Tennis</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="/billiards">Billiards</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="/functional-training">Funtional Training</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="/table-tennis">Table Tennis</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="/card-room">Card Room</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="/childrens-play-area">Children's Play Area</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <!-- <li class="nav-item"><a class="nav-link"
                                    href="services.html">Sports</a></li> -->
                                    <li class="nav-item submenu">
                                        <a class="nav-link" href="/facilities">Facilities</a>
                                        <ul>
                                            @foreach($facilitiesCategory as $cat)
                                                <li class="nav-item">
                                                    <a class="nav-link" href="/facilities/{{ $cat->slog }}">
                                                        {{ $cat->title }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>

                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/dining-bar">Dining & Bar</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/events">Events</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/blogs">Blogs</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/gymkhana-affiliation">Gymkhana Affiliation</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/contact-us">Contact Us</a>
                                    </li>
                                    <!-- <li class="nav-item submenu">
                                        <a class="nav-link" href="">Notices</a>
                                        <ul>
                                            <li class="nav-item">
                                                <a class="nav-link" href="agm">AGM</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#">Annual Report</a>
                                            </li>
                                        </ul>
                                    </li> -->
                                    <!-- Header Btn Start -->
                                    <div class="header-btn">
                                        <a href="login" class="btn-default btn-highlighted">Login</a>
                                    </div>
                                    <!-- Header Btn End -->
                                </ul>
                            </div>
                        </div>
                        <!-- Main Menu End -->
                        <div class="navbar-toggle"></div>
                    </div>
                </nav>
                <div class="responsive-menu"></div>
            </div>
        </header>
        <!-- Header End -->
         