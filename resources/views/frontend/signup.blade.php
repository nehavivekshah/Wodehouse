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
                    <h3>Create My Account</h3>
                    <p>Join the Wodehouse Legacy</p>
                    <form action="{{ route('signup') }}" method="POST">
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="mb-3 text-start">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name"
                                placeholder="Enter your first name" required="required" value="{{ old('first_name') }}">
                        </div>
                        <div class="mb-3 text-start">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name"
                                placeholder="Enter your last name" required="required" value="{{ old('last_name') }}">
                        </div>
                        <div class="mb-3 text-start">
                            <label for="mob" class="form-label">Mobile Number</label>
                            <input type="text" class="form-control" id="mob" name="mob"
                                placeholder="Enter your mobile number" required="required" value="{{ old('mob') }}">
                        </div>
                        <div class="mb-3 text-start">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="you@example.com" required="required" value="{{ old('email') }}">
                        </div>
                        <div class="mb-3 text-start">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Minimum 8 characters" required="required">
                                <span class="input-group-text" id="togglePassword">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>
                        <div class="mb-4 text-start">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" placeholder="Re-enter your password"
                                    required="required">
                                <span class="input-group-text" id="toggleConfirmPassword">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>
                        <div class="mb-4 form-check text-start">
                            <input type="checkbox" class="form-check-input" id="agreeTerms" name="agreeTerms"
                                required="required">
                            <label class="form-check-label" for="agreeTerms">
                                I agree to the
                                <a href="#" class="login-link">Terms of Service</a>
                                and
                                <a href="#" class="login-link">Privacy Policy</a>
                            </label>
                        </div>
                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-login">SIGN UP</button>
                        </div>
                        <p class="login-link-text">Already have an account?
                            <a href="{{ route('login') }}" class="login-link">Log In Here</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include("frontend.inc.footer")