@include("backend.inc.member_sidebar")

<h1 class="page-title">{{ isset($category) ? 'Edit Facility Category' : 'Add New Facility Category' }}</h1>
<p class="page-subtitle">Create or update a facility category.</p>

<div class="card member-card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.manageFacilityCategory') }}">
            @csrf
            <input type="hidden" name="id" value="{{ $category->id ?? '' }}">

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Category Title</label>
                    <input type="text" name="title" class="form-control" value="{{ $category->title ?? '' }}" required
                        id="categoryTitle">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Slug</label>
                    <input type="text" name="slog" class="form-control" value="{{ $category->slog ?? '' }}"
                        id="categorySlug">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Parent Category (Optional)</label>
                    <select name="parent_id" class="form-control">
                        <option value="">None</option>
                        @foreach($parents as $parent)
                            <option value="{{ $parent->id }}" {{ (isset($category) && $category->parent_id == $parent->id) ? 'selected' : '' }}>{{ $parent->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="1" {{ isset($category) && $category->status == 1 ? 'selected' : '' }}>Active
                        </option>
                        <option value="0" {{ isset($category) && $category->status == 0 ? 'selected' : '' }}>Inactive
                        </option>
                    </select>
                </div>
            </div>

            <button class="btn btn-primary mt-3">{{ isset($category) ? 'Update Category' : 'Save Category' }}</button>
            <a href="{{ route('admin.facilityCategory') }}" class="btn btn-secondary mt-3">Back</a>
        </form>
    </div>
</div>

<script>
    document.getElementById('categoryTitle').addEventListener('keyup', function () {
        let slug = this.value.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
        document.getElementById('categorySlug').value = slug;
    });
</script>

@include("backend.inc.member_footer")