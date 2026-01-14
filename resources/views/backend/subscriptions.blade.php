@include("backend.inc.member_sidebar")
<h1 class="page-title">My Subscription & Wallet</h1>
<p class="page-subtitle">Manage your membership plan and account balance.</p>

<div class="row justify-content-center">
    <!-- Account Balance Card -->
    <div class="col-lg-8 mb-4">
        <div class="card member-card bg-light border-0" style="background: linear-gradient(135deg, #112014 0%, #1e3c2f 100%); color: white;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-1 text-white-50">Account Balance</h5>
                        <h2 class="mb-0 fw-bold text-white">₹ 12,450.00</h2>
                    </div>
                    <div>
                        <button class="btn btn-light text-success fw-bold"><i class="fas fa-plus-circle me-2"></i>Top Up Wallet</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Subscription Details -->
    <div class="col-lg-8">
        <div class="card member-card">
            <div class="card-header">
                <h5>Current Plan Details</h5>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                        <span class="text-muted">Plan Name</span>
                        <strong>Monthly Membership Dues</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                        <span class="text-muted">Amount</span>
                        <strong>₹ 5,000.00 / month</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                        <span class="text-muted">Renewal Date</span>
                        <strong>August 1, 2024</strong>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@include("backend.inc.member_footer")