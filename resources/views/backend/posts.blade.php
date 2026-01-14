@include("backend.inc.member_sidebar")

<h1 class="page-title">Posts</h1>
<p class="page-subtitle">Manage all blog posts, drafts, and published content.</p>

<div class="card member-card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Post List</h5>
        <a href="{{ route('admin.managePost') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus"></i> Add New Post
        </a>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="postsTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Author</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                    <tr id="postRow{{ $post->id }}">
                        <td>#{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->category }}</td>
                        <td>{{ $post->author }}</td>
                        <td>
                            <select class="form-control form-control-sm statusToggle" data-id="{{ $post->id }}">
                                <option value="1" {{ $post->status == 1 ? 'selected' : '' }}>Published</option>
                                <option value="0" {{ $post->status == 0 ? 'selected' : '' }}>Draft</option>
                            </select>
                        </td>
                        <td>{{ date('Y-m-d', strtotime($post->created_at)) }}</td>
                        <td>
                            <a href="{{ route('admin.managePost', ['id'=>$post->id]) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <button class="btn btn-sm btn-outline-danger deletePostBtn" data-id="{{ $post->id }}">Delete</button>
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
    $('#postsTable').DataTable();

    // Delete post
    $('.deletePostBtn').click(function() {
        let postId = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "This will permanently delete the post!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'var(--accent-color)',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/admin/delete-post/' + postId,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function(response){
                        $('#postRow' + postId).remove();
                        Swal.fire('Deleted!', 'Post has been deleted.', 'success');
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
        let postId = $(this).data('id');
        let status = $(this).val();
        $.ajax({
            url: '/admin/toggle-post-status/' + postId,
            type: 'POST',
            data: { _token: '{{ csrf_token() }}', status: status },
            success: function(response){
                Swal.fire('Success!', 'Post status updated.', 'success');
            },
            error: function(err){
                Swal.fire('Error!', 'Could not update status.', 'error');
            }
        });
    });
});
</script>
