@include('backend.inc.member_sidebar')

<h1 class="page-title">{{ isset($category) ? 'Edit Event Category' : 'Add Event Category' }}</h1>

<div class="card member-card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.manageEventCategory') }}">
            @csrf
            <input type="hidden" name="id" value="{{ $category->id ?? '' }}">

            <div class="mb-3">
                <label>Category Title</label>
                <input type="text" name="title" class="form-control"
                       value="{{ $category->title ?? '' }}" required>
            </div>

            <div class="mb-3">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="1" {{ isset($category)&&$category->status==1?'selected':'' }}>Active</option>
                    <option value="0" {{ isset($category)&&$category->status==0?'selected':'' }}>Inactive</option>
                </select>
            </div>

            <button class="btn btn-primary">Save Category</button>
            <a href="{{ route('admin.eventCategory') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
</div>

@include('backend.inc.member_footer')
