@include("backend.inc.member_sidebar")

<h1 class="page-title">Facility Categories</h1>
<p class="page-subtitle">Manage all facility categories, drafts, and active categories.</p>

<div class="card member-card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Category List</h5>
        <a href="{{ route('admin.manageFacilityCategory') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus"></i> Add New Category
        </a>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="categoryTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $cat)
                    <tr id="categoryRow{{ $cat->id }}">
                        <td>#{{ $cat->id }}</td>
                        <td>{{ $cat->title }}</td>
                        <td>
                            <select class="form-control form-control-sm statusToggle" data-id="{{ $cat->id }}">
                                <option value="1" {{ $cat->status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $cat->status == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </td>
                        <td>{{ date('Y-m-d', strtotime($cat->created_at)) }}</td>
                        <td>
                            <a href="{{ route('admin.manageFacilityCategory', ['id'=>$cat->id]) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <button class="btn btn-sm btn-outline-danger deleteCategoryBtn" data-id="{{ $cat->id }}">Delete</button>
                        </td>
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
    $('#categoryTable').DataTable();

    // Delete Category
    $('.deleteCategoryBtn').click(function() {
        let catId = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "This will permanently delete the category!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'var(--accent-color)',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/admin/delete-facility-category/' + catId,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function(response){
                        $('#categoryRow' + catId).remove();
                        Swal.fire('Deleted!', 'Category has been deleted.', 'success');
                    },
                    error: function(err){
                        Swal.fire('Error!', 'Something went wrong.', 'error');
                    }
                });
            }
        });
    });

    // Status toggle
    $('.statusToggle').change(function(){
        let catId = $(this).data('id');
        let status = $(this).val();
        $.ajax({
            url: '/admin/toggle-facility-category-status/' + catId,
            type: 'POST',
            data: { _token: '{{ csrf_token() }}', status: status },
            success: function(response){
                Swal.fire('Success!', 'Category status updated.', 'success');
            },
            error: function(err){
                Swal.fire('Error!', 'Could not update status.', 'error');
            }
        });
    });
});
</script>
