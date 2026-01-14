@include("backend.inc.member_sidebar")

<h1 class="page-title">Food & Beverage Items</h1>
<p class="page-subtitle">Manage menu items, prices, and availability.</p>

<div class="card member-card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Item List</h5>
        <a href="{{ route('admin.manageFoodItem') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus"></i> Add New Item
        </a>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="foodItemsTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                    <tr id="itemRow{{ $item->id }}">
                        <td>
                            <img src="/public/{{ asset($item->image ?? 'assets/images/no-image.png') }}" 
                                 alt="" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                        </td>
                        <td><strong>{{ $item->name }}</strong></td>
                        <td><span class="badge badge-info">{{ $item->category->name ?? 'N/A' }}</span></td>
                        <td>${{ number_format($item->price, 2) }}</td>
                        <td>
                            <select class="form-control form-control-sm statusToggle" data-id="{{ $item->id }}">
                                <option value="1" {{ $item->status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $item->status == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </td>
                        <td>
                            <a href="{{ route('admin.manageFoodItem', $item->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <button class="btn btn-sm btn-outline-danger deleteItemBtn" data-id="{{ $item->id }}">Delete</button>
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
    $('#foodItemsTable').DataTable();

    // Delete Item
    $(document).on('click', '.deleteItemBtn', function() {
        let id = $(this).data('id');
        Swal.fire({
            title: 'Delete Item?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/admin/delete-food-item/' + id,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function() {
                        $('#itemRow' + id).fadeOut();
                        Swal.fire('Deleted!', 'Item removed.', 'success');
                    }
                });
            }
        });
    });

    // Status Toggle
    $(document).on('change', '.statusToggle', function() {
        let id = $(this).data('id');
        let status = $(this).val();
        $.ajax({
            url: '/admin/toggle-food-item-status/' + id,
            type: 'POST',
            data: { _token: '{{ csrf_token() }}', status: status },
            success: function() {
                Swal.fire({ toast: true, position: 'top-end', icon: 'success', title: 'Status updated', showConfirmButton: false, timer: 1500 });
            }
        });
    });
});
</script>