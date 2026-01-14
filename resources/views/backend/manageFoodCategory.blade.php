@include("backend.inc.member_sidebar")

<h1 class="page-title">{{ isset($category) ? 'Edit' : 'Add' }} Food Category</h1>
<p class="page-subtitle">Define classification for your food and beverage menu.</p>

<div class="card member-card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Category Information</h5>
        <a href="{{ route('admin.foodCategory') }}" class="btn btn-sm btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.submitManageFoodCategory') }}" method="POST">
            @csrf
            
            @if(isset($category))
                <input type="hidden" name="id" value="{{ $category->id }}">
            @endif

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Category Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="categoryName" 
                           class="form-control @error('name') is-invalid @enderror" 
                           placeholder="e.g. Fast Food, Beverages, Desserts" 
                           value="{{ old('name', $category->name ?? '') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">URL Slug</label>
                    <input type="text" name="slug" id="categorySlug" 
                           class="form-control" 
                           placeholder="e.g. fast-food" 
                           value="{{ old('slug', $category->slug ?? '') }}">
                    <small class="text-muted">You can leave this blank to auto-generate from the name.</small>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control">
                        <option value="1" {{ (old('status', $category->status ?? 1) == 1) ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ (old('status', $category->status ?? 1) == 0) ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>

            <hr>

            <div class="form-actions mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> {{ isset($category) ? 'Update' : 'Save' }} Category
                </button>
                <button type="reset" class="btn btn-light">Reset</button>
            </div>
        </form>
    </div>
</div>

@include("backend.inc.member_footer")

<script>
    // Auto-generate slug from Name
    $(document).ready(function() {
        $('#categoryName').on('input', function() {
            let text = $(this).val();
            let slug = text.toLowerCase()
                           .replace(/[^a-z0-9 -]/g, '') 
                           .replace(/\s+/g, '-')       
                           .replace(/-+/g, '-');       
            $('#categorySlug').val(slug);
        });
    });
</script>