@include("frontend.inc.header")
<div class="page-header bg-section parallaxie d-none">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Page Header Box Start -->
                <div class="page-header-box">
                    <h1 class="text-anime-style-3" data-cursor="-opaque">Login</h1>
                </div>
                <!-- Page Header Box End -->
            </div>
        </div>
    </div>
</div>
<div class="page-contact-us login-page">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-xl-5 col-lg-8 col-md-10">
                <div class="login-card">
                    <h3>Forgot Password</h3>
                    <p>Enter your registered email to reset your password</p>
                    <form action="{{ route('forgotPassword') }}" method="POST">
                        @csrf
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="mb-4 text-start">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="you@example.com" required="required" value="{{ old('email') }}">
                        </div>
                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-login">SEND RESET LINK</button>
                        </div>
                        <p class="back-link-text">Remember your password?
                            <a href="{{ route('login') }}" class="back-link">
                                Log In Here
                            </a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include("frontend.inc.footer")