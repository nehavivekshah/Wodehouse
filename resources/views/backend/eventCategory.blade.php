@include('backend.inc.member_sidebar')

<h1 class="page-title">Event Categories</h1>
<p class="page-subtitle">Manage event categories</p>

<div class="card member-card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Category List</h5>
        <a href="{{ route('admin.manageEventCategory') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus"></i> Add Category
        </a>
    </div>

    <div class="card-body">
        <table class="table table-striped" id="categoryTable">
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
                <tr>
                    <td>#{{ $cat->id }}</td>
                    <td>{{ $cat->title }}</td>
                    <td>
                        <span class="badge {{ $cat->status ? 'bg-success' : 'bg-secondary' }}">
                            {{ $cat->status ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>{{ date('Y-m-d', strtotime($cat->created_at)) }}</td>
                    <td>
                        <a href="{{ route('admin.manageEventCategory',['id'=>$cat->id]) }}"
                           class="btn btn-sm btn-outline-primary">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('backend.inc.member_footer')

<script>
$(function(){
    $('#categoryTable').DataTable();
});
</script>
