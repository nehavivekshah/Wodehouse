@include("backend.inc.member_sidebar")
<div class="card member-card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Event Registrations</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover" id="registrationsTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Event</th>
                        <th>Member</th>
                        <th>Status</th>
                        <th>Registered At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($registrations as $reg)
                        <tr>
                            <td>#{{ $reg->id }}</td>
                            <td>
                                <strong>{{ $reg->event->title ?? 'Unknown Event' }}</strong><br>
                                <small class="text-muted">{{ $reg->event ? $reg->event->event_date : '-' }}</small>
                            </td>
                            <td>
                                {{ $reg->user->first_name }} {{ $reg->user->last_name }}<br>
                                <small class="text-muted">{{ $reg->user->email }}</small>
                            </td>
                            <td>
                                @php
                                    $badges = [
                                        'pending' => 'secondary',
                                        'confirmed' => 'success',
                                        'cancelled' => 'danger',
                                        'attended' => 'primary'
                                    ];
                                    $badgeClass = $badges[$reg->status] ?? 'secondary';
                                @endphp
                                <span class="badge bg-{{ $badgeClass }}">{{ ucfirst($reg->status) }}</span>
                            </td>
                            <td>{{ $reg->created_at->format('d M Y, h:i A') }}</td>
                            <td>
                                <button class="btn btn-sm btn-info viewRegBtn" data-id="{{ $reg->id }}"><i
                                        class="fas fa-eye"></i></button>
                                <button class="btn btn-sm btn-primary updateStatusBtn" data-id="{{ $reg->id }}"><i
                                        class="fas fa-edit"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- View Registration Modal -->
<div class="modal fade" id="viewRegModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registration Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="regDetailsContent">
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
                <h5 class="modal-title">Update Registration Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateStatusForm">
                    @csrf
                    <input type="hidden" id="updateRegId">
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select id="regStatusSelect" class="form-control">
                            <option value="pending">Pending</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="cancelled">Cancelled</option>
                            <option value="attended">Attended</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Update Status</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#registrationsTable').DataTable({
                "order": [[0, "desc"]]
            });

            // View Details
            $(document).on('click', '.viewRegBtn', function () {
                let id = $(this).data('id');
                $('#viewRegModal').modal('show');
                $('#regDetailsContent').html('<div class="text-center"><i class="fas fa-spinner fa-spin"></i> Loading...</div>');

                $.ajax({
                    url: '/admin/event-registration-details/' + id,
                    type: 'GET',
                    success: function (response) {
                        if (response.success) {
                            let r = response.registration;
                            let eventDate = r.event ? r.event.event_date : 'N/A';
                            let html = `
                                        <h6>ID: #${r.id}</h6>
                                        <p><strong>Event:</strong> ${r.event ? r.event.title : 'Unknown'}</p>
                                        <p><strong>Date:</strong> ${eventDate}</p>
                                        <hr>
                                        <p><strong>Member:</strong> ${r.user.first_name} ${r.user.last_name}</p>
                                        <p><strong>Email:</strong> ${r.user.email}</p>
                                        <p><strong>Phone:</strong> ${r.user.mob ?? 'N/A'}</p>
                                        <hr>
                                        <p><strong>Status:</strong> <span class="badge bg-secondary">${r.status}</span></p>
                                        <p><strong>Registered At:</strong> ${r.created_at}</p>
                                    `;
                            $('#regDetailsContent').html(html);
                        } else {
                            $('#regDetailsContent').html('<p class="text-danger">Error fetching details.</p>');
                        }
                    },
                    error: function () {
                        $('#regDetailsContent').html('<p class="text-danger">Error fetching details.</p>');
                    }
                });
            });

            // Update Status Modal
            $(document).on('click', '.updateStatusBtn', function () {
                let id = $(this).data('id');
                $('#updateRegId').val(id);
                $('#updateStatusModal').modal('show');
            });

            // Submit Status Update
            $('#updateStatusForm').submit(function (e) {
                e.preventDefault();
                let id = $('#updateRegId').val();
                let status = $('#regStatusSelect').val();

                $.ajax({
                    url: '/admin/event-registration/update/' + id,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        status: status
                    },
                    success: function (res) {
                        if (res.success) {
                            $('#updateStatusModal').modal('hide');
                            Swal.fire('Success', 'Status updated', 'success').then(() => {
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
@include("backend.inc.member_footer")