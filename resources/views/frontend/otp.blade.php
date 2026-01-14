@include("frontend.inc.header")
<div class="page-header bg-section parallaxie d-none">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-header-box">
                    <h1 class="text-anime-style-3" data-cursor="-opaque">OTP Verification</h1>
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
                    <h3>Verify OTP</h3>
                    <p>Enter the 4-digit code sent to your mobile</p>
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
                    <form action="{{ route('otp') }}" method="post" class="otp-form">
                        @csrf
                        <div class="mb-4 text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <input type="text" class="form-control text-center otp-input" name="otp1" maxlength="1"
                                    required style="width: 50px; height: 50px; font-size: 24px;">
                                <input type="text" class="form-control text-center otp-input" name="otp2" maxlength="1"
                                    required style="width: 50px; height: 50px; font-size: 24px;">
                                <input type="text" class="form-control text-center otp-input" name="otp3" maxlength="1"
                                    required style="width: 50px; height: 50px; font-size: 24px;">
                                <input type="text" class="form-control text-center otp-input" name="otp4" maxlength="1"
                                    required style="width: 50px; height: 50px; font-size: 24px;">
                            </div>
                        </div>
                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-login">VERIFY OTP</button>
                        </div>
                        <p class="back-link-text">Didn't receive code?
                            <a href="{{ route('loginOtp') }}" class="back-link">
                                Resend OTP
                            </a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Auto-focus next input
    const inputs = document.querySelectorAll('.otp-input');
    inputs.forEach((input, index) => {
        input.addEventListener('keyup', (e) => {
            if (e.target.value.length === 1 && index < inputs.length - 1) {
                inputs[index + 1].focus();
            }
            if (e.key === 'Backspace' && index > 0) {
                inputs[index - 1].focus();
            }
        });
    });
</script>
@include("frontend.inc.footer")