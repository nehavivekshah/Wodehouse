@include("backend.inc.member_sidebar")

<h1 class="page-title">Facility Bookings</h1>
<p class="page-subtitle">View and manage all facility bookings.</p>

<div class="card member-card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Bookings List</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover" id="bookingsTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Facility</th>
                        <th>Member</th>
                        <th>Date & Time</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Booked At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                        <tr>
                            <td>#{{ $booking->id }}</td>
                            <td>{{ $booking->facility_name }}</td>
                            <td>
                                {{ $booking->first_name }} {{ $booking->last_name }}<br>
                                <small class="text-muted">{{ $booking->email }}</small>
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}<br>
                                <small>{{ $booking->slot_time }}</small>
                            </td>
                            <td>₹{{ number_format($booking->amount, 2) }}</td>
                            <td>
                                <span class="badge bg-{{ $booking->status == 'confirmed' ? 'success' : 'warning' }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($booking->created_at)->format('d M Y, h:i A') }}</td>
                            <td>
                                <button class="btn btn-sm btn-info viewBookingBtn" data-id="{{ $booking->id }}"><i
                                        class="fas fa-eye"></i></button>
                                <button class="btn btn-sm btn-primary updateStatusBtn" data-id="{{ $booking->id }}"><i
                                        class="fas fa-edit"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- View Booking Modal -->
<div class="modal fade" id="viewBookingModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Booking Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="bookingDetailsContent">
                <!-- Content loaded via AJAX -->
                <div class="text-center"><i class="fas fa-spinner fa-spin"></i> Loading...</div>
            </div>
        </div>
    </div>
</div>

<!-- Update Status Modal -->
<div class="modal fade" id="updateStatusModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Booking Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateStatusForm">
                    @csrf
                    <input type="hidden" id="updateBookingId">
                    <div class="mb-3">
                        <label class="form-label">Booking Status</label>
                        <select id="bookingStatusSelect" class="form-control">
                            <option value="pending">Pending</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="cancelled">Cancelled</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Update Status</button>
                </form>
            </div>
        </div>
    </div>
</div>

@include("backend.inc.member_footer")

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#bookingsTable').DataTable({
                "order": [[0, "desc"]]
            });

            // View Booking Details
            $(document).on('click', '.viewBookingBtn', function () {
                let id = $(this).data('id');
                $('#viewBookingModal').modal('show');
                $('#bookingDetailsContent').html('<div class="text-center"><i class="fas fa-spinner fa-spin"></i> Loading...</div>');

                $.ajax({
                    url: '/admin/booking-details/' + id,
                    type: 'GET',
                    success: function (response) {
                        if (response.success) {
                            let b = response.booking;
                            let html = `
                                <p><strong>Booking ID:</strong> #${b.id}</p>
                                <p><strong>Facility:</strong> ${b.facility_name}</p>
                                <p><strong>Member:</strong> ${b.first_name} ${b.last_name}</p>
                                <p><strong>Email:</strong> ${b.email}</p>
                                <p><strong>Phone:</strong> ${b.mob ?? 'N/A'}</p>
                                <hr>
                                <p><strong>Date:</strong> ${b.booking_date}</p>
                                <p><strong>Time:</strong> ${b.slot_time}</p>
                                <p><strong>Amount:</strong> ₹${b.amount}</p>
                                <p><strong>Status:</strong> <span class="badge bg-secondary">${b.status}</span></p>
                                <p><strong>Booked At:</strong> ${b.created_at}</p>
                            `;
                            $('#bookingDetailsContent').html(html);
                        } else {
                            $('#bookingDetailsContent').html('<p class="text-danger">Error fetching details.</p>');
                        }
                    },
                    error: function () {
                        $('#bookingDetailsContent').html('<p class="text-danger">Error fetching details.</p>');
                    }
                });
            });

            // Open Update Status Modal
            $(document).on('click', '.updateStatusBtn', function () {
                let id = $(this).data('id');
                $('#updateBookingId').val(id);
                $('#updateStatusModal').modal('show');
            });

            // Submit Status Update
            $('#updateStatusForm').submit(function (e) {
                e.preventDefault();
                let id = $('#updateBookingId').val();
                let status = $('#bookingStatusSelect').val();

                $.ajax({
                    url: '/admin/update-booking-status/' + id,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        status: status
                    },
                    success: function (response) {
                        if (response.success) {
                            $('#updateStatusModal').modal('hide');
                            Swal.fire('Success', 'Status updated successfully', 'success').then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('Error', 'Failed to update status', 'error');
                        }
                    },
                    error: function () {
                        Swal.fire('Error', 'Something went wrong', 'error');
                    }
                });
            });
        });
    </script>
@endpush