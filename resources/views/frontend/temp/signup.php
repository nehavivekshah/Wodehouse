<?php include("header.php"); ?>
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
                    <form>
                        <div class="mb-3 text-start">
                            <label for="fullName" class="form-label">Full Name</label>
                            <input
                                type="text"
                                class="form-control"
                                id="fullName"
                                name="fullName"
                                placeholder="Enter your full name"
                                required="required">
                        </div>
                        <div class="mb-3 text-start">
                            <label for="email" class="form-label">Email Address</label>
                            <input
                                type="email"
                                class="form-control"
                                id="email"
                                name="email"
                                placeholder="you@example.com"
                                required="required">
                        </div>
                        <div class="mb-3 text-start">
                            <label for="newPassword" class="form-label">Password</label>
                            <div class="input-group">
                                <input
                                    type="password"
                                    class="form-control"
                                    id="newPassword"
                                    name="newPassword"
                                    placeholder="Minimum 8 characters"
                                    required="required">
                                <span class="input-group-text" id="togglePassword">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>
                        <div class="mb-4 text-start">
                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                            <div class="input-group">
                                <input
                                    type="password"
                                    class="form-control"
                                    id="confirmPassword"
                                    name="confirmPassword"
                                    placeholder="Re-enter your password"
                                    required="required">
                                <span class="input-group-text" id="toggleConfirmPassword">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>
                        <div class="mb-4 form-check text-start">
                            <input
                                type="checkbox"
                                class="form-check-input"
                                id="agreeTerms"
                                name="agreeTerms"
                                required="required">
                            <label class="form-check-label" for="agreeTerms">
                                I agree to the
                                <a href="#" class="login-link">Terms of Service</a>
                                and
                                <a href="#" class="login-link">Privacy Policy</a>
                            </label>
                        </div>
                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-login">LOGIN</button>
                        </div>
                        <p class="login-link-text">Already have an account?
                            <a href="login.php" class="login-link">Log In Here</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("footer.php"); ?>