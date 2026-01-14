@include("backend.inc.member_sidebar")

<h1 class="page-title">Food Categories</h1>
<p class="page-subtitle">Manage food and beverage menu classifications.</p>

<div class="card member-card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Category List</h5>
        <a href="{{ route('admin.food-category.create') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus"></i> Add New Category
        </a>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="categoriesTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr id="categoryRow{{ $category->id }}">
                        <td>#{{ $category->id }}</td>
                        <td><strong>{{ $category->name }}</strong></td>
                        <td><small class="text-muted">{{ $category->slug }}</small></td>
                        <td>
                            <select class="form-control form-control-sm statusToggle" data-id="{{ $category->id }}">
                                <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </td>
                        <td>{{ date('Y-m-d', strtotime($category->created_at)) }}</td>
                        <td>
                            <a href="{{ route('admin.food-category.edit', $category->id) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <button class="btn btn-sm btn-outline-danger deleteCategoryBtn" data-id="{{ $category->id }}">
                                <i class="fas fa-trash"></i> Delete
                            </button>
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
    // Initialize DataTable
    if (!$.fn.DataTable.isDataTable('#categoriesTable')) {
        $('#categoriesTable').DataTable({
            "order": [[ 0, "desc" ]]
        });
    }

    // Delete Category Logic
    $(document).on('click', '.deleteCategoryBtn', function() {
        let categoryId = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "This will remove the category and may affect linked food items!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/admin/food-category/delete/' + categoryId,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function(response){
                        if(response.success){
                            $('#categoryRow' + categoryId).fadeOut(400, function(){ $(this).remove(); });
                            Swal.fire('Deleted!', 'Category has been deleted.', 'success');
                        }
                    },
                    error: function(err){
                        Swal.fire('Error!', 'Something went wrong.', 'error');
                    }
                });
            }
        });
    });

    // Status toggle logic
    $(document).on('change', '.statusToggle', function(){
        let categoryId = $(this).data('id');
        let status = $(this).val();
        $.ajax({
            url: '/admin/food-category/toggle-status/' + categoryId,
            type: 'POST',
            data: { _token: '{{ csrf_token() }}', status: status },
            success: function(response){
                if(response.success){
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: 'Status updated',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            },
            error: function(err){
                Swal.fire('Error!', 'Could not update status.', 'error');
            }
        });
    });
});
</script>