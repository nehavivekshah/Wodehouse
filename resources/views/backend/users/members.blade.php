@include('backend.inc.member_sidebar')

<h1 class="page-title">Members</h1>
<p class="page-subtitle">Manage all members of the system</p>

<div class="card member-card">
    <div class="card-header d-flex justify-content-between">
        <h5>Member List</h5>
        <a href="{{ route('admin.manageUser') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus"></i> Add Member
        </a>
    </div>

    <div class="card-body">
        <table class="table table-striped" id="membersTable">
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
                @foreach($users as $member)
                <tr>
                    <td>#{{ $member->id }}</td>
                    <td>{{ $member->first_name }} {{ $member->last_name }}</td>
                    <td>{{ $member->email }}</td>
                    <td>{{ $member->mob ?? '-' }}</td>
                    <td>
                        <select class="form-control form-control-sm memberStatusToggle"
                                data-id="{{ $member->id }}">
                            <option value="1" {{ $member->status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $member->status == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </td>
                    <td>
                        <a href="{{ route('admin.manageUser',['id'=>$member->id]) }}"
                           class="btn btn-sm btn-outline-primary">Edit</a>
                    
                        <button class="btn btn-sm btn-outline-danger deleteMemberBtn"
                                data-id="{{ $member->id }}">
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

    $('#membersTable').DataTable();

    // DELETE MEMBER
    $('.deleteMemberBtn').click(function () {
        let memberId = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "This member will be permanently deleted!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'var(--accent-color)',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/admin/delete-user/' + memberId,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function () {
                        Swal.fire('Deleted!', 'Member deleted successfully.', 'success');
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
    $('.memberStatusToggle').change(function () {
        let memberId = $(this).data('id');
        let status = $(this).val();

        $.ajax({
            url: '/admin/toggle-user-status/' + memberId,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                status: status
            },
            success: function () {
                Swal.fire('Updated!', 'Member status updated.', 'success');
            },
            error: function () {
                Swal.fire('Error!', 'Status update failed.', 'error');
            }
        });
    });

});
</script>
