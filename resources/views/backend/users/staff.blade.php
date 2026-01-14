@include('backend.inc.member_sidebar')

<h1 class="page-title">Staff</h1>
<p class="page-subtitle">Manage all staff members</p>

<div class="card member-card">
    <div class="card-header d-flex justify-content-between">
        <h5>Staff List</h5>
        <a href="{{ route('admin.manageUser') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus"></i> Add Staff
        </a>
    </div>

    <div class="card-body">
        <table class="table table-striped" id="staffTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $staff)
                <tr>
                    <td>#{{ $staff->id }}</td>
                    <td>{{ $staff->first_name }} {{ $staff->last_name }}</td>
                    <td>{{ $staff->email }}</td>
                    <td>{{ $staff->mob ?? '-' }}</td>
                    <td>
                        <select class="form-control form-control-sm staffStatusToggle"
                                data-id="{{ $staff->id }}">
                            <option value="1" {{ $staff->status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $staff->status == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </td>
                    <td>
                        <a href="{{ route('admin.manageUser',['id'=>$staff->id]) }}"
                           class="btn btn-sm btn-outline-primary">Edit</a>
                    
                        <button class="btn btn-sm btn-outline-danger deleteStaffBtn"
                                data-id="{{ $staff->id }}">
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

    $('#staffTable').DataTable();

    // DELETE STAFF
    $('.deleteStaffBtn').click(function () {
        let staffId = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "This staff member will be permanently deleted!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'var(--accent-color)',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/admin/delete-user/' + staffId,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function () {
                        Swal.fire('Deleted!', 'Staff deleted successfully.', 'success');
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
    $('.staffStatusToggle').change(function () {
        let staffId = $(this).data('id');
        let status = $(this).val();

        $.ajax({
            url: '/admin/toggle-user-status/' + staffId,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                status: status
            },
            success: function () {
                Swal.fire('Updated!', 'Staff status updated.', 'success');
            },
            error: function () {
                Swal.fire('Error!', 'Status update failed.', 'error');
            }
        });
    });

});
</script>
