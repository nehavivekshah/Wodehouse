@include("frontend.member.member_sidebar")
<div class="container py-5">
    <div class="card shadow-sm border-0 mx-auto" style="max-width: 800px;">
        <div class="card-header bg-white py-3"><h5 class="mb-0">Booking Summary</h5></div>
        <div class="card-body p-4">
            <div class="d-flex justify-content-between mb-3">
                <span class="text-muted">Facility:</span>
                <span class="fw-bold">{{ $booking->facility->title }}</span>
            </div>
            <div class="d-flex justify-content-between mb-3 pt-3 border-top">
                <span class="text-muted">Date:</span>
                <span class="fw-bold">{{ \Carbon\Carbon::parse($booking->booking_date)->format('F d, Y') }}</span>
            </div>
            <div class="d-flex justify-content-between mb-3 pt-3 border-top">
                <span class="text-muted">Time Slot:</span>
                <span class="fw-bold">{{ \Carbon\Carbon::parse($booking->slot_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($booking->slot_time)->addMinutes($availability->slot_duration)->format('h:i A') }}</span>
            </div>
            <div class="d-flex justify-content-between mb-3 pt-3 border-top pb-3 border-bottom">
                <span class="text-muted">Duration:</span>
                <span class="fw-bold">{{ $availability->slot_duration }} minutes</span>
            </div>

            <h6 class="mt-4 mb-3 fw-bold">Charges</h6>
            <div class="d-flex justify-content-between mb-2">
                <span class="text-muted">Booking Fee</span>
                <span>₹ {{ number_format($bookingFee, 2) }}</span>
            </div>
            <div class="d-flex justify-content-between mb-2">
                <span class="text-muted">GST (18%)</span>
                <span>₹ {{ number_format($gstAmount, 2) }}</span>
            </div>
            <div class="d-flex justify-content-between pt-3 mt-3 border-top">
                <span class="fw-bold fs-5">Total Payable Amount</span>
                <span class="fw-bold fs-5">₹ {{ number_format($totalAmount, 2) }}</span>
            </div>

            <p class="text-center text-muted mt-5" style="font-size: 0.8rem;">
                <strong>Cancellation Policy:</strong> Free cancellation is available up to 12 hours prior...
            </p>

            <div class="d-flex justify-content-center gap-3 mt-4">
                <a href="{{ route('member.facility_availability') }}" class="btn btn-outline-secondary px-4">Go Back & Edit</a>
                <button class="btn btn-dark px-4"><i class="fas fa-lock me-2"></i> Proceed to Pay</button>
            </div>
        </div>
    </div>
</div>