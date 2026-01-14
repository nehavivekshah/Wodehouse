@include("frontend.member.member_sidebar")

<h1 class="page-title">My Bookings</h1>
<p class="page-subtitle">View your upcoming, past, and cancelled facility bookings.</p>

<div class="card member-card">
    <div class="card-header">
        <h5>Booking History</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="bookingsTable" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Booking ID</th>
                        <th>Facility</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Amount</th>
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
                        <td>₹ 590.00</td>
                        <td><span class="badge" style="background-color: var(--accent-color); color: #fff;">Upcoming</span></td>
                        <td><button class="btn btn-sm btn-outline-danger" onclick="confirmCancel()">Cancel</button></td>
                    </tr>
                    <tr>
                        <td><samp>BK-78350</samp></td>
                        <td><strong>Tennis Court 2</strong></td>
                        <td><?php echo date('Y-m-d', strtotime('-5 days')); ?></td>
                        <td>02:00 PM - 03:00 PM</td>
                        <td>₹ 590.00</td>
                        <td><span class="badge bg-secondary">Completed</span></td>
                        <td><a href="#" class="btn btn-sm btn-outline-primary">View Invoice</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Initialize DataTables
    $('#bookingsTable').DataTable({
        "order": [[ 2, "desc" ]] // Order by date column descending by default
    });
});

// SweetAlert2 for cancellation confirmation
function confirmCancel() {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this! Please check the cancellation policy.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, cancel it!',
        confirmButtonColor: 'var(--accent-color)'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
                'Cancelled!',
                'Your booking has been cancelled.',
                'success'
            )
        }
    })
}
</script>

@include("frontend.member.member_footer")