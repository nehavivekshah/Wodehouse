<?php include("member_sidebar.php"); ?>
<h1 class="page-title">Checkout</h1>
<p class="page-subtitle">Confirm your order details and complete the payment.</p>
<div class="row">
<div class="col-lg-7">
<div class="card member-card">
<div class="card-header">
<h5>1. Service Options</h5>
</div>
<div class="card-body">
<p>Please specify how you would like to receive your order.</p>
<div class="form-check mb-3">
<input class="form-check-input" type="radio" name="serviceOption" id="tableDelivery" checked>
<label class="form-check-label" for="tableDelivery">
<strong>Deliver to my Table</strong>
</label>
<div class="ms-4 mt-2">
<label for="tableNumber" class="form-label">Enter Table Number</label>
<input type="text" class="form-control" id="tableNumber" placeholder="e.g., 14" style="max-width: 200px;">
</div>
</div>
<div class="form-check">
<input class="form-check-input" type="radio" name="serviceOption" id="pickup">
<label class="form-check-label" for="pickup">
<strong>Pickup from Counter</strong>
<p class="text-muted small mb-0">You will be notified when your order is ready.</p>
</label>
</div>
</div>
</div>
</div>
<div class="col-lg-5">
<div class="card member-card">
<div class="card-header">
<h5>2. Order Summary & Payment</h5>
</div>
<div class="card-body">
<ul class="list-group list-group-flush">
<li class="list-group-item d-flex justify-content-between px-0">
<span>Subtotal</span>
<span>₹ 350.00</span>
</li>
<li class="list-group-item d-flex justify-content-between px-0">
<span>Taxes (GST)</span>
<span>₹ 63.00</span>
</li>
<li class="list-group-item d-flex justify-content-between px-0 fs-5 fw-bold">
<span>Amount to Pay</span>
<span class="text-accent">₹ 413.00</span>
</li>
</ul>
<div class="d-grid mt-4">
<a href="order_confirmation.php" class="btn btn-primary btn-lg">
<i class="fas fa-lock me-2"></i> Pay Securely
</a>
</div>
</div>
</div>
</div>
</div>
<?php include("member_footer.php"); ?>