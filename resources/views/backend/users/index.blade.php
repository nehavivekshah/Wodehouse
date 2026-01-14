@include('backend.inc.member_sidebar')

<h1 class="page-title">Users</h1>
<p class="page-subtitle">Manage all users of the system</p>

<div class="card member-card">
    <div class="card-header d-flex justify-content-between">
        <h5>User List</h5>
        <a href="{{ route('admin.manageUser') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus"></i> Add User
        </a>
    </div>

    <div class="card-body">
        <table class="table table-striped" id="usersTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>#{{ $user->id }}</td>
                    <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ ucfirst($user->role) }}</td>
                    <td>
                        <select class="form-control form-control-sm userStatusToggle"
                                data-id="{{ $user->id }}">
                            <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </td>
                    <td>
                        <a href="{{ route('admin.manageUser',['id'=>$user->id]) }}"
                           class="btn btn-sm btn-outline-primary">Edit</a>
                    
                        <button class="btn btn-sm btn-outline-danger deleteUserBtn"
                                data-id="{{ $user->id }}">
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

    $('#usersTable').DataTable();

    // DELETE USER
    $('.deleteUserBtn').click(function () {
        let userId = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "This user will be permanently deleted!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'var(--accent-color)',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/admin/delete-user/' + userId,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function () {
                        Swal.fire('Deleted!', 'User deleted successfully.', 'success');
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
    $('.userStatusToggle').change(function () {
        let userId = $(this).data('id');
        let status = $(this).val();

        $.ajax({
            url: '/admin/toggle-user-status/' + userId,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                status: status
            },
            success: function () {
                Swal.fire('Updated!', 'User status updated.', 'success');
            },
            error: function () {
                Swal.fire('Error!', 'Status update failed.', 'error');
            }
        });
    });

});
</script>
