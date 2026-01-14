@include("backend.inc.member_sidebar")

<h1 class="page-title">{{ isset($facility) ? 'Edit Facility' : 'Add New Facility' }}</h1>
<p class="page-subtitle">Create or update facility details.</p>

<div class="card member-card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.manageFacility') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $facility->id ?? '' }}">

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" value="{{ $facility->title ?? '' }}" required id="facilityTitle">
                </div>
                
                <div class="col-md-6 mb-3">
                    <label>Slug</label>
                    <input type="text" name="slog" class="form-control" value="{{ $facility->slog ?? '' }}" id="facilitySlug">
                </div>
                
                <div class="col-md-6 mb-3">
                    <label>Category</label>
                    <select name="category" class="form-control" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->title }}" {{ isset($facility) && $facility->category == $cat->title ? 'selected' : '' }}>{{ $cat->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-12 mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control" id="facilityContent" rows="4">{{ $facility->description ?? '' }}</textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="1" {{ isset($facility) && $facility->status == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ isset($facility) && $facility->status == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Feature Image</label>
                    <input type="file" name="image" class="form-control" onchange="previewImage(event)">
                    @if(isset($facility) && $facility->image)
                        <img src="{{ asset('public/' . $facility->image) }}" id="preview" class="img-thumbnail mt-2" width="150">
                    @else
                        <img id="preview" class="img-thumbnail mt-2" width="150" style="display:none;">
                    @endif
                </div>
            </div>

            <button class="btn btn-primary mt-3">{{ isset($facility) ? 'Update Facility' : 'Save Facility' }}</button>
            <a href="{{ route('admin.facilities') }}" class="btn btn-secondary mt-3">Back</a>
        </form>
    </div>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script>
    // CKEditor
    ClassicEditor.create(document.querySelector('#facilityContent')).catch(error => { console.error(error); });
    document.getElementById('facilityTitle').addEventListener('keyup', function() {
        let slug = this.value.toLowerCase().replace(/ /g,'-').replace(/[^\w-]+/g,'');
        document.getElementById('facilitySlug').value = slug;
    });
    
    function previewImage(event){
        let reader = new FileReader();
        reader.onload = function(){
            let output = document.getElementById('preview');
            output.src = reader.result;
            output.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

@include("backend.inc.member_footer")
