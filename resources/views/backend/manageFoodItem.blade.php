@include("backend.inc.member_sidebar")

<h1 class="page-title">{{ isset($item) ? 'Edit' : 'Add' }} Food Item</h1>

<div class="card member-card">
    <div class="card-body">
        <form action="{{ route('admin.submitFoodItem') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($item)) <input type="hidden" name="id" value="{{ $item->id }}"> @endif

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Item Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $item->name ?? old('name') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Category</label>
                    <select name="category_id" class="form-control" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ (isset($item) && $item->category_id == $cat->id) ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Price</label>
                    <input type="number" step="0.01" name="price" class="form-control" value="{{ $item->price ?? old('price') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="1" {{ (isset($item) && $item->status == 1) ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ (isset($item) && $item->status == 0) ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div class="col-md-12 mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ $item->description ?? old('description') }}</textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control">
                    @if(isset($item->image))
                        <img src="/public/{{ asset($item->image) }}" class="mt-2" style="width: 100px; border-radius: 5px;">
                    @endif
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Save Item</button>
                <a href="{{ route('admin.foodItem') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

@include("backend.inc.member_footer")