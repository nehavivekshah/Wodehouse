@include("frontend.inc.header")
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
                    <h3>Welcome Members</h3>
                    <p>Login to your account</p>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
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
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="mb-3 text-start">
                            <label for="memberId" class="form-label">Member Id / Email*</label>
                            <input type="text" class="form-control" id="memberId" name="memberId"
                                placeholder="Enter Your Member Id / Email*" required="required"
                                value="{{ old('memberId') }}">
                        </div>
                        <div class="mb-3 text-start">
                            <label for="password" class="form-label">Password*</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Password" required="required">
                                <span class="input-group-text" id="togglePassword">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="rememberMe" name="rememberMe">
                                <label class="form-check-label checkbox-label" for="rememberMe">
                                    Remember me
                                </label>
                            </div>
                            <a href="login-otp" class="forgot-password">Login with OTP</a>
                        </div>
                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-login">LOGIN</button>
                        </div>
                        <p class="mt-3">Not a member?
                            <a href="contact-us" class="signup-link">Enquire Now</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include("frontend.inc.footer")