@include("frontend.member.member_sidebar")
<h1 class="page-title">Booking Confirmation</h1>
<p class="page-subtitle">Please review your booking details and proceed to payment.</p>
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card member-card">
            <div class="card-header">
                <h5>Booking Summary</h5>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                        <span class="text-muted">Facility:</span>
                        <strong class="fs-5">Tennis Court 1</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                        <span class="text-muted">Date:</span>
                        <strong><?php echo date('F d, Y'); ?></strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                        <span class="text-muted">Time Slot:</span>
                        <strong>04:00 PM - 05:00 PM</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                        <span class="text-muted">Duration:</span>
                        <strong>60 minutes</strong>
                    </li>
                </ul>
            </div>
             <div class="card-body border-top">
                <h5 class="mb-3">Charges</h5>
                 <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <span>Booking Fee</span>
                        <span>₹ 500.00</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <span>GST (18%)</span>
                        <span>₹ 90.00</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 fs-5 fw-bold">
                        <span>Total Payable Amount</span>
                        <span class="text-accent">₹ 590.00</span>
                    </li>
                </ul>
            </div>
            <div class="card-footer text-center p-4">
                <p class="text-muted small mb-3">
                    <strong>Cancellation Policy:</strong> Free cancellation is available up to 12 hours prior to the booking time. No refunds will be issued for cancellations made within 12 hours of the slot.
                </p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    <a href="facility_availability.php" class="btn btn-secondary">Go Back & Edit</a>
                    <button class="btn btn-primary btn-lg"><i class="fas fa-lock me-2"></i>Proceed to Pay</button>
                </div>
            </div>
        </div>
    </div>
</div>
@include("frontend.member.member_footer")