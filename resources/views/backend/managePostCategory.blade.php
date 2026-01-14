@include("backend.inc.member_sidebar")

<h1 class="page-title">{{ isset($category) ? 'Edit Category' : 'Add Category' }}</h1>
<p class="page-subtitle">Add or update post categories.</p>

<div class="card member-card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.managePostCategory.submit') }}">
            @csrf
            <input type="hidden" name="id" value="{{ $category->id ?? '' }}">

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" value="{{ $category->title ?? '' }}" required id="catTitle">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Slug</label>
                    <input type="text" name="slog" class="form-control" value="{{ $category->slog ?? '' }}" id="catSlug">
                </div>

                <div class="col-md-3 mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="1" {{ isset($category) && $category->status == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ isset($category) && $category->status == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>

            <button class="btn btn-primary mt-3">{{ isset($category) ? 'Update Category' : 'Save Category' }}</button>
            <a href="{{ route('admin.postCategory') }}" class="btn btn-secondary mt-3">Back</a>
        </form>
    </div>
</div>

<script>
document.getElementById('catTitle').addEventListener('keyup', function(){
    let slug = this.value.toLowerCase().replace(/ /g,'-').replace(/[^\w-]+/g,'');
    document.getElementById('catSlug').value = slug;
});
</script>

@include("backend.inc.member_footer")
