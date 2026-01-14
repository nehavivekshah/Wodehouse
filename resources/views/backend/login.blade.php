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
        <title>Admin Login - WODEHOUSE GYMKHANA</title>
        <!-- Favicon Icon -->
        <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
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
        <link href="/public/backend/custom.css" rel="stylesheet" media="screen">
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
        <div class="page-header bg-section parallaxie d-none">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-header-box">
                            <h1 class="text-anime-style-3" data-cursor="-opaque">Login</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-contact-us login-page">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-xl-5 col-lg-8 col-md-10">
                        <div class="login-card">
                            <h3>Welcome Admin</h3>
                            <p>Login to your account</p>
                            <form action="/admin/login" method="post">
                                @csrf
                                <div class="mb-3 text-start">
                                    <label for="Username" class="form-label">Username*</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="userName"
                                        name="login_email"
                                        placeholder="Enter Your Username*"
                                        required="required">
                                </div>
                                <div class="mb-3 text-start">
                                    <label for="password" class="form-label">Password*</label>
                                    <div class="input-group">
                                        <input
                                            type="password"
                                            class="form-control"
                                            id="password"
                                            name="login_password"
                                            placeholder="Password"
                                            required="required">
                                        <span class="input-group-text" id="togglePassword">
                                            <i class="fas fa-eye"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            id="rememberMe"
                                            name="rememberMe">
                                        <label class="form-check-label checkbox-label" for="rememberMe">
                                            Remember me
                                        </label>
                                    </div>
                                    <!--<a href="/admin/forgot-password" class="forgot-password">Forgot Password</a>-->
                                </div>
                                <div class="d-grid mb-4">
                                    <button type="submit" class="btn btn-login">LOGIN</button>
                                </div>
                                <!--<p class="mt-3">Not a member?
                                    <a href="contact-us" class="signup-link">Enquire Now</a>
                                </p>-->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="responseMsg">
        <!-- Validation Errors -->
        @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input:<br><br>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <!-- Session Error (custom error message) -->
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
        <!-- Session Success (optional) -->
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
    </div>
    
    <!-- Jquery Library File -->
    <script src="/public/frontend/js/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap js file -->
    <script src="/public/frontend/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Validator js file -->
    <script src="/public/frontend/js/validator.min.js"></script>
    <!-- SlickNav js file -->
    <script src="/public/frontend/js/jquery.slicknav.js"></script>
    <!-- Swiper js file -->
    <script src="/public/frontend/js/swiper-bundle.min.js"></script>
    <!-- Counter js file -->
    <script src="/public/frontend/js/jquery.waypoints.min.js"></script>
    <script src="/public/frontend/js/jquery.counterup.min.js"></script>
    <!-- Magnific js file -->
    <script src="/public/frontend/js/jquery.magnific-popup.min.js"></script>
    <!-- SmoothScroll -->
    <script src="/public/frontend/js/SmoothScroll.js"></script>
    <!-- Parallax js -->
    <script src="/public/frontend/js/parallaxie.js"></script>
    <!-- MagicCursor js file -->
    <script src="/public/frontend/js/gsap.min.js"></script>
    <script src="/public/frontend/js/magiccursor.js"></script>
    <!-- Text Effect js file -->
    <script src="/public/frontend/js/SplitText.js"></script>
    <script src="/public/frontend/js/ScrollTrigger.min.js"></script>
    <!-- YTPlayer js File -->
    <script src="/public/frontend/js/jquery.mb.YTPlayer.min.js"></script>
    <!-- Wow js file -->
    <script src="/public/frontend/js/wow.min.js"></script>
    <!-- Main Custom js file -->
    <script src="/public/frontend/js/function.js"></script>
    <script>
        document
            .getElementById('togglePassword')
            .addEventListener('click', function (e) {
                const passwordInput = document.getElementById('password');
                const type = passwordInput.getAttribute('type') === 'password'
                    ? 'text'
                    : 'password';
                passwordInput.setAttribute('type', type);
                this
                    .querySelector('i')
                    .classList
                    .toggle('fa-eye-slash');
                this
                    .querySelector('i')
                    .classList
                    .toggle('fa-eye');
            });
    </script>
    <script>
        document
            .getElementById('togglePassword')
            .addEventListener('click', function () {
                const passwordInput = document.getElementById('newPassword');
                const icon = this.querySelector('i');
                const type = passwordInput.getAttribute('type') === 'password'
                    ? 'text'
                    : 'password';
                passwordInput.setAttribute('type', type);
                icon
                    .classList
                    .toggle('fa-eye-slash');
                icon
                    .classList
                    .toggle('fa-eye');
            });
        document
            .getElementById('toggleConfirmPassword')
            .addEventListener('click', function () {
                const confirmPasswordInput = document.getElementById('confirmPassword');
                const icon = this.querySelector('i');
                const type = confirmPasswordInput.getAttribute('type') === 'password'
                    ? 'text'
                    : 'password';
                confirmPasswordInput.setAttribute('type', type);
                icon
                    .classList
                    .toggle('fa-eye-slash');
                icon
                    .classList
                    .toggle('fa-eye');
            });
    </script>
</body>
</html>