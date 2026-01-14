@include('backend.inc.member_sidebar')

<h1 class="page-title">{{ isset($event) ? 'Edit Event' : 'Add Event' }}</h1>

<div class="card member-card">
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data" action="{{ route('admin.manageEvent') }}">
            @csrf
            <input type="hidden" name="id" value="{{ $event->id ?? '' }}">

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Event Title</label>
                    <input type="text" name="title" class="form-control" value="{{ $event->title ?? '' }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Category</label>
                    <select name="category" class="form-control" required>
                        <option value="">Select</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->title }}" {{ isset($event)&&$event->category==$cat->title?'selected':'' }}>
                                {{ $cat->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label>Date</label>
                    <input type="date" name="event_date" class="form-control" value="{{ $event->event_date ?? '' }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label>Time</label>
                    <input type="time" name="time" class="form-control" value="{{ $event->time ?? '' }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label>Duration</label>
                    <input type="text" name="duration" class="form-control" value="{{ $event->duration ?? '' }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Venue</label>
                    <input type="text" name="venue" class="form-control" value="{{ $event->venue ?? '' }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Event Image</label>
                    <input type="file" name="image" class="form-control">
                    @if(isset($event->image))
                        <img src="{{ asset('public/'.$event->image) }}" class="img-thumbnail mt-2" width="150">
                    @endif
                </div>

                <div class="col-md-12 mb-3">
                    <label>Description</label>
                    <textarea name="content" id="eventContent" class="form-control" rows="5">{{ $event->content ?? '' }}</textarea>
                </div>

                <div class="col-md-3 mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="1" {{ isset($event)&&$event->status==1?'selected':'' }}>Active</option>
                        <option value="0" {{ isset($event)&&$event->status==0?'selected':'' }}>Inactive</option>
                    </select>
                </div>
            </div>

            <button class="btn btn-primary">Save Event</button>
            <a href="{{ route('admin.events') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script>
ClassicEditor.create(document.querySelector('#eventContent'));
</script>

@include('backend.inc.member_footer')
