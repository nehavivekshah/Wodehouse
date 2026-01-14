@include("backend.inc.member_sidebar")

<div class="container-fluid">
    <h1 class="page-title">Facility Availability</h1>
    <p class="page-subtitle">Set operating hours and slot durations for each facility.</p>

    <div class="row">
        <!-- Add Availability Form -->
        <div class="col-md-4">
            <div class="card member-card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Add Time Slot</h5>
                </div>
                <div class="card-body">
                    <form id="availabilityForm">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="form-label">Select Facility</label>
                            <select name="facility_id" class="form-control" required>
                                <option value="">-- Choose Facility --</option>
                                @foreach($facilities as $facility)
                                    <option value="{{ $facility->id }}" @if($facility->id == $_GET['facility_id']) selected @endif>{{ $facility->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">Day of Week</label>
                            <select name="day_of_week" class="form-control" required>
                                <option value="0">Sunday</option>
                                <option value="1">Monday</option>
                                <option value="2">Tuesday</option>
                                <option value="3">Wednesday</option>
                                <option value="4">Thursday</option>
                                <option value="5">Friday</option>
                                <option value="6">Saturday</option>
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Start Time</label>
                                    <input type="time" name="start_time" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">End Time</label>
                                    <input type="time" name="end_time" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">Slot Duration (Minutes)</label>
                            <input type="number" name="slot_duration" class="form-control" placeholder="e.g. 30" min="1" required>
                        </div>

                        <button type="submit" id="saveBtn" class="btn btn-primary w-100">
                            <i class="fas fa-save me-1"></i> Save Availability
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Availability List -->
        <div class="col-md-8">
            <div class="card member-card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Existing Schedules</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="availabilityTable" class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Facility</th>
                                    <th>Day</th>
                                    <th>Time Range</th>
                                    <th>Slot</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($availabilities as $avail)
                                <tr id="availRow{{ $avail->id }}">
                                    <td>
                                        <strong>{{ $avail->facility->title ?? 'Deleted Facility' }}</strong>
                                    </td>
                                    <td>{{ $avail->day_name }}</td>
                                    <td>
                                        <span class="badge bg-info text-dark">
                                            {{ date('h:i A', strtotime($avail->start_time)) }} - {{ date('h:i A', strtotime($avail->end_time)) }}
                                        </span>
                                    </td>
                                    <td>{{ $avail->slot_duration }} mins</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-danger deleteAvailBtn"
                                            data-id="{{ $avail->id }}"
                                            data-url="{{ route('admin.deleteAvailability', $avail->id) }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include("backend.inc.member_footer")

<script>
$(document).ready(function () {
    // Initialize DataTable
    let table = $('#availabilityTable').DataTable({
        order: [[0, 'asc']],
        pageLength: 10
    });

    // Submit Availability Form via AJAX
    $('#availabilityForm').on('submit', function(e) {
        e.preventDefault();
        
        let $btn = $('#saveBtn');
        let originalText = $btn.html();
        
        // Basic loading state
        $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Saving...');

        $.ajax({
            url: "{{ route('admin.saveAvailability') }}",
            type: 'POST',
            data: $(this).serialize(),
            success: function(response){
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Availability added successfully.',
                    timer: 1500
                }).then(() => {
                    location.reload(); 
                });
            },
            error: function(err){
                $btn.prop('disabled', false).html(originalText);
                
                // If Laravel returns validation errors
                let errorMsg = 'Check your inputs and try again.';
                if(err.status === 422) {
                    errorMsg = Object.values(err.responseJSON.errors).flat().join('<br>');
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    html: errorMsg
                });
            }
        });
    });

    // Delete Availability via AJAX
    $(document).on('click', '.deleteAvailBtn', function() {
        let id = $(this).data('id');
        let deleteUrl = "{{ url('admin/delete-availability') }}/" + id;

        Swal.fire({
            title: 'Are you sure?',
            text: "This time slot will be permanently removed!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: deleteUrl,
                    type: 'DELETE',
                    data: { 
                        _token: '{{ csrf_token() }}' 
                    },
                    success: function(response){
                        if(response.success) {
                            // Smoothly remove the row from the table
                            $('#availRow' + id).fadeOut(400, function() {
                                $(this).remove();
                            });
                            Swal.fire('Deleted!', 'The schedule has been removed.', 'success');
                        }
                    },
                    error: function() {
                        Swal.fire('Error!', 'Something went wrong. Could not delete.', 'error');
                    }
                });
            }
        });
    });
});
</script>