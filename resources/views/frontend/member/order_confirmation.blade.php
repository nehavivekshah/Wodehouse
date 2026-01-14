@include("frontend.member.member_sidebar")
<div class="container-fluid">
<div class="row justify-content-center">
<div class="col-lg-8 text-center">
<div class="card member-card p-4 p-md-5">
<div class="card-body">
<div style="font-size: 5rem; color: var(--accent-color);">
<i class="fas fa-check-circle"></i>
</div>
<h1 class="page-title mt-3">Order Placed Successfully!</h1>
<p class="page-subtitle">Thank you for your order. We're preparing it for you now.</p>
<div class="alert alert-success-soft mt-4">
Your Order ID is: <strong>#WG-ORD-86754</strong>
</div>
<div class="my-4">
<h5>Estimated Preparation Time</h5>
<p class="fs-4 fw-bold text-accent">20-25 Minutes</p>
</div>
<hr class="my-4">
<div class="d-flex justify-content-center gap-3">
<a href="menu.php" class="btn btn-outline-primary">
<i class="fas fa-receipt me-2"></i> View My Orders
</a>
<a href="dashboard.php" class="btn btn-primary">
<i class="fas fa-home me-2"></i> Go to Dashboard
</a>
</div>
</div>
</div>
</div>
</div>
</div>
@include("frontend.member.member_footer")