<?php include("member_sidebar.php"); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="page-title">Facilities & Bookings</h1>
        <p class="page-subtitle">Reserve a facility or manage your schedule.</p>
    </div>
    <ul class="nav nav-pills" id="booking-tabs" role="tablist">
        <li class="nav-item">
            <button class="nav-link active" id="tab-book" data-bs-toggle="pill" data-bs-target="#content-book" type="button"><i class="fas fa-plus-circle me-2"></i>New Booking</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" id="tab-history" data-bs-toggle="pill" data-bs-target="#content-history" type="button"><i class="fas fa-history me-2"></i>My Bookings</button>
        </li>
    </ul>
</div>
<div class="tab-content">
    <div class="tab-pane fade show active" id="content-book">
        <div class="card member-card">
            <div class="card-body p-lg-5">
                <div class="row">
                    <div class="col-lg-4 border-end">
                        <h5 class="mb-3">1. Select Facility & Date</h5>
                        <div class="mb-3">
                            <label for="facilitySelect" class="form-label fw-bold">Facility</label>
                            <select id="facilitySelect" class="form-select">
                                <option selected>Tennis Court</option>
                                <option>Billiards Room</option>
                                <option>Squash Court</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="bookingDate" class="form-label fw-bold">Date</label>
                            <input type="text" class="form-control" id="bookingDate" placeholder="Select a date...">
                        </div>
                    </div>
                    <div class="col-lg-8 ps-lg-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                             <h5 class="mb-0">2. Select an Available Slot for <strong id="selectedDateDisplay" class="text-primary">Today</strong></h5>
                             <div class="booking-legend">
                                <span><i class="fas fa-circle text-success"></i> Available</span>
                                <span><i class="fas fa-circle text-danger"></i> Booked</span>
                            </div>
                        </div>
                        <div class="time-slot-grid">
                            <div class="time-slot available">09:00 AM</div>
                            <div class="time-slot booked">10:00 AM</div>
                            <div class="time-slot available">11:00 AM</div>
                            <div class="time-slot available">12:00 PM</div>
                            <div class="time-slot available">01:00 PM</div>
                            <div class="time-slot booked">02:00 PM</div>
                            <div class="time-slot available">03:00 PM</div>
                            <div class="time-slot available">04:00 PM</div>
                            <div class="time-slot available">05:00 PM</div>
                        </div>
                    </div>
                </div>
                <div id="confirmation-section" class="mt-4 text-center border-top pt-4" style="display: none;">
                    <h5 class="mb-3">3. Confirm Your Booking</h5>
                    <p class="lead">You have selected <strong class="text-accent" id="confirm-details">Tennis Court at 04:00 PM</strong>.</p>
                    <a href="booking_confirmation.php" class="btn btn-primary btn-lg"><i class="fas fa-check-circle me-2"></i>Proceed to Confirmation</a>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="content-history">
        <div class="card member-card">
            <div class="card-header">
                <h5>Booking History</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="bookingsTable" class="table table-striped w-100">
                        <thead>
                            <tr>
                                <th>Booking ID</th>
                                <th>Facility</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><samp>BK-78541</samp></td>
                                <td><strong>Tennis Court 1</strong></td>
                                <td><?php echo date('Y-m-d'); ?></td>
                                <td>04:00 PM - 05:00 PM</td>
                                <td><span class="badge bg-accent">Upcoming</span></td>
                                <td><button class="btn btn-sm btn-outline-danger" onclick="confirmCancel()">Cancel</button></td>
                            </tr>
                            <tr>
                                <td><samp>BK-78350</samp></td>
                                <td><strong>Tennis Court 2</strong></td>
                                <td><?php echo date('Y-m-d', strtotime('-5 days')); ?></td>
                                <td>02:00 PM - 03:00 PM</td>
                                <td><span class="badge bg-secondary">Completed</span></td>
                                <td><a href="view_invoice.php?id=BK-78350" class="btn btn-sm btn-outline-primary">Invoice</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const fp = flatpickr("#bookingDate", {
        altInput: true, altFormat: "F j, Y", dateFormat: "Y-m-d", defaultDate: "today", minDate: "today",
        onChange: function(selectedDates, dateStr, instance) {
            document.getElementById('selectedDateDisplay').textContent = instance.altInput.value;
        }
    });
    document.getElementById('selectedDateDisplay').textContent = fp.altInput.value;
    const timeSlots = document.querySelectorAll('.time-slot-grid .time-slot');
    const confirmationSection = document.getElementById('confirmation-section');
    const confirmDetailsSpan = document.getElementById('confirm-details');
    const facilitySelect = document.getElementById('facilitySelect');
    timeSlots.forEach(slot => {
        slot.addEventListener('click', function(e) {
            if (this.classList.contains('booked')) return;
            timeSlots.forEach(s => s.classList.remove('selected'));
            this.classList.add('selected');
            const facilityName = facilitySelect.options[facilitySelect.selectedIndex].text;
            confirmDetailsSpan.textContent = `${facilityName} at ${this.textContent}`;
            confirmationSection.style.display = 'block';
        });
    });
    $('#bookingsTable').DataTable({ "order": [[ 2, "desc" ]] });
});
function confirmCancel() {
    Swal.fire({
        title: 'Cancel Booking?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: 'var(--primary-color)',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, cancel it'
    }).then((result) => {
        if (result.isConfirmed) Swal.fire('Cancelled!', 'Booking cancelled.', 'success')
    })
}
</script>
<?php include("member_footer.php"); ?>