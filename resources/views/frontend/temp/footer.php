<!-- Footer Start -->
<footer class="main-footer dark-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-12">
                <!-- About Footer Start -->
                <div class="about-footer">
                    <!-- Footer Logo Start -->
                    <div class="footer-logo">
                        <h3 class="text-light">Overview</h3>
                        <!-- <img src="images/footer-logo.svg" alt=""> -->
                    </div>
                    <!-- Footer Logo End -->
                    <!-- About Footer Content Start -->
                    <div class="about-footer-content">
                        <p>
                            Experience a century of elegance and modern convenience at Wodehouse Gymkhana. A
                            premier boutique Gymkhana dedicated to sociability, world-class facilities, and
                            memorable member experiences.</p>
                    </div>
                    <!-- About Footer Content End -->
                    <!-- Footer Social Link Start -->
                    <!-- <div class="footer-social-links"> <ul> <li><a href="#"><i class="fa-brands
                    fa-pinterest-p"></i></a></li> <li><a href="#"><i class="fa-brands
                    fa-x-twitter"></i></a></li> <li><a href="#"><i class="fa-brands
                    fa-facebook-f"></i></a></li> <li><a href="#"><i class="fa-brands
                    fa-instagram"></i></a></li> </ul> </div> -->
                    <!-- Footer Social Link End -->
                </div>
                <!-- About Footer End -->
            </div>
            <div class="col-lg-3 col-md-4">
                <!-- Footer Links Start -->
                <div class="footer-contact-details footer-links">
                    <h3>Say Hello</h3>
                    <ul>
                        <li>
                            <a href="tel:">+91-9820543616</a>
                        </li>
                        <li>
                            <a href="mailto:">admin@wodehousegymkhana.in</a>
                        </li>
                        <li>182, Maharshi Karve Road, Nariman Point, Mumbai – 400 021 India</li>
                    </ul>
                </div>
                <!-- Footer Links End -->
            </div>
            <div class="col-lg-2 col-md-3">
                <!-- Footer Links Start -->
                <div class="footer-links">
                    <h3>quick links</h3>
                    <ul>
                        <li>
                            <a href="index.php">Home</a>
                        </li>
                        <li>
                            <a href="#">About Us</a>
                        </li>
                        <li>
                            <a href="#">Facilities</a>
                        </li>
                        <li>
                            <a href="#">Events</a>
                        </li>
                        <li>
                            <a href="#">News & Updates</a>
                        </li>
                    </ul>
                </div>
                <!-- Footer Links End -->
            </div>
            <div class="col-lg-3 col-md-5">
                <!-- Footer Newsletter Box Start -->
                <div class="footer-newsletter-box footer-links">
                    <h3>Newsletters</h3>
                    <form id="latestnewsForm" action="#" method="POST">
                        <div class="form-group">
                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                id="mail"
                                placeholder="Enter your email"
                                required="">
                                <button type="submit" class="btn-default btn-highlighted">Subscribe Now</button>
                            </div>
                        </form>
                    </div>
                    <!-- Footer Newsletter Box End -->
                </div>
            </div>
            <!-- Footer Copyright Section Start -->
            <div class="footer-copyright">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <!-- Footer Copyright Start -->
                        <div class="footer-copyright-text">
                            <p>Copyright © 2025 Wodehouse Gymkhana. All Rights Reserved.</p>
                        </div>
                        <!-- Footer Copyright End -->
                    </div>
                    <div class="col-md-6">
                        <!-- Footer Menu Start -->
                        <div class="footer-menu">
                            <ul>
                                <li>
                                    <a href="#">Help</a>
                                </li>
                                <li>
                                    <a href="#">Privacy Policy</a>
                                </li>
                                <li>
                                    <a href="#">Term's & Condition</a>
                                </li>
                            </ul>
                        </div>
                        <!-- Footer Menu End -->
                    </div>
                </div>
            </div>
            <!-- Footer Copyright Section End -->
        </div>
    </footer>
    <!-- Footer End -->
    <!-- Jquery Library File -->
    <script src="js/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap js file -->
    <script src="js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Validator js file -->
    <script src="js/validator.min.js"></script>
    <!-- SlickNav js file -->
    <script src="js/jquery.slicknav.js"></script>
    <!-- Swiper js file -->
    <script src="js/swiper-bundle.min.js"></script>
    <!-- Counter js file -->
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <!-- Magnific js file -->
    <script src="js/jquery.magnific-popup.min.js"></script>
    <!-- SmoothScroll -->
    <script src="js/SmoothScroll.js"></script>
    <!-- Parallax js -->
    <script src="js/parallaxie.js"></script>
    <!-- MagicCursor js file -->
    <script src="js/gsap.min.js"></script>
    <script src="js/magiccursor.js"></script>
    <!-- Text Effect js file -->
    <script src="js/SplitText.js"></script>
    <script src="js/ScrollTrigger.min.js"></script>
    <!-- YTPlayer js File -->
    <script src="js/jquery.mb.YTPlayer.min.js"></script>
    <!-- Wow js file -->
    <script src="js/wow.min.js"></script>
    <!-- Main Custom js file -->
    <script src="js/function.js"></script>
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