@include("backend.inc.member_sidebar")

<h1 class="page-title">{{ isset($post) ? 'Edit Post' : 'Add New Post' }}</h1>
<p class="page-subtitle">Create or update blog content.</p>

<div class="card member-card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.managePost.submit') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $post->id ?? '' }}">

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" value="{{ $post->title ?? '' }}" required id="postTitle">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Slug</label>
                    <input type="text" name="slog" class="form-control" value="{{ $post->slog ?? '' }}" id="postSlug">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Category</label>
                    <select name="category" class="form-control" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->title }}" {{ isset($post) && $post->category == $cat->title ? 'selected' : '' }}>{{ $cat->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Author</label>
                    <input type="text" name="author" class="form-control" value="{{ $post->author ?? '' }}">
                </div>

                <div class="col-md-12 mb-3">
                    <label>Short Description</label>
                    <textarea name="shortContent" class="form-control" rows="2">{{ $post->shortContent ?? '' }}</textarea>
                </div>

                <div class="col-md-12 mb-3">
                    <label>Content</label>
                    <textarea name="content" class="form-control" id="postContent" rows="6">{{ $post->content ?? '' }}</textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Tags</label>
                    <input type="text" name="tags" class="form-control" value="{{ $post->tags ?? '' }}" placeholder="news, sports, events">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="1" {{ isset($post) && $post->status == 1 ? 'selected' : '' }}>Published</option>
                        <option value="0" {{ isset($post) && $post->status == 0 ? 'selected' : '' }}>Draft</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Feature Image</label>
                    <input type="file" name="imgs" class="form-control" onchange="previewImage(event)">
                    @if(isset($post) && $post->imgs)
                        <img src="{{ asset('public/' . $post->imgs) }}" id="preview" class="img-thumbnail mt-2" width="150">
                    @else
                        <img id="preview" class="img-thumbnail mt-2" width="150" style="display:none;">
                    @endif
                </div>
            </div>

            <button class="btn btn-primary mt-3">{{ isset($post) ? 'Update Post' : 'Save Post' }}</button>
            <a href="{{ route('admin.posts') }}" class="btn btn-secondary mt-3">Back</a>
        </form>
    </div>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script>
    // CKEditor
    ClassicEditor.create(document.querySelector('#postContent')).catch(error => { console.error(error); });

    // Auto-generate slug
    document.getElementById('postTitle').addEventListener('keyup', function() {
        let slug = this.value.toLowerCase().replace(/ /g,'-').replace(/[^\w-]+/g,'');
        document.getElementById('postSlug').value = slug;
    });

    // Image preview
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
