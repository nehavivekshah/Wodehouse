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
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@include("backend.inc.member_footer")

<script>
    $(document).ready(function () {
        $('#bookingsTable').DataTable({
            "order": [[0, "desc"]]
        });
    });
</script>