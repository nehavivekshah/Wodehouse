@include('backend.inc.member_sidebar')

<h1 class="page-title">Events</h1>
<p class="page-subtitle">Manage all upcoming & past events</p>

<div class="card member-card">
    <div class="card-header d-flex justify-content-between">
        <h5>Event List</h5>
        <a href="{{ route('admin.manageEvent') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus"></i> Add Event
        </a>
    </div>

    <div class="card-body">
        <table class="table table-striped" id="eventsTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Date</th>
                    <th>Venue</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                <tr>
                    <td>#{{ $event->id }}</td>
                    <td>{{ $event->title }}</td>
                    <td>{{ $event->category }}</td>
                    <td>{{ date('d M Y', strtotime($event->event_date)) }}</td>
                    <td>{{ $event->venue }}</td>
                    <td>
                        <select class="form-control form-control-sm eventStatusToggle"
                                data-id="{{ $event->id }}">
                            <option value="1" {{ $event->status == 1 ? 'selected' : '' }}>Published</option>
                            <option value="0" {{ $event->status == 0 ? 'selected' : '' }}>Draft</option>
                        </select>
                    </td>
                    <td>
                        <a href="{{ route('admin.manageEvent',['id'=>$event->id]) }}"
                           class="btn btn-sm btn-outline-primary">Edit</a>
                    
                        <button class="btn btn-sm btn-outline-danger deleteEventBtn"
                                data-id="{{ $event->id }}">
                            Delete
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('backend.inc.member_footer')

<script>
$(document).ready(function () {

    $('#eventsTable').DataTable();

    // DELETE EVENT
    $('.deleteEventBtn').click(function () {
        let eventId = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "This event will be permanently deleted!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'var(--accent-color)',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/admin/delete-event/' + eventId,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function () {
                        Swal.fire('Deleted!', 'Event deleted successfully.', 'success');
                        location.reload();
                    },
                    error: function () {
                        Swal.fire('Error!', 'Something went wrong.', 'error');
                    }
                });
            }
        });
    });

    // STATUS TOGGLE
    $('.eventStatusToggle').change(function () {
        let eventId = $(this).data('id');
        let status = $(this).val();

        $.ajax({
            url: '/admin/toggle-event-status/' + eventId,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                status: status
            },
            success: function () {
                Swal.fire('Updated!', 'Event status updated.', 'success');
            },
            error: function () {
                Swal.fire('Error!', 'Status update failed.', 'error');
            }
        });
    });

});
</script>
