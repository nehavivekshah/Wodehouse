@include("frontend.member.member_sidebar")
<h1 class="page-title">My Profile</h1>
<p class="page-subtitle">View and manage your personal details and membership information.</p>
<div class="row">
    <div class="col-lg-8">
        <div class="card member-card">
            <div class="card-header">
                <h5>Personal Details</h5>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('member.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name"
                                value="{{ old('first_name', $user->first_name) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name"
                                value="{{ old('last_name', $user->last_name) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email Address (Cannot be changed)</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}"
                                readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="mob" class="form-label">Contact Number</label>
                            <input type="text" class="form-control" id="mob" name="mob"
                                value="{{ old('mob', $user->mob) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address"
                                value="{{ old('address', $meta->address ?? '') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" id="city" name="city"
                                value="{{ old('city', $meta->city ?? '') }}">
                        </div>

                        <div class="col-12 mb-3">
                            <label for="profile_photo" class="form-label">Profile Picture</label>
                            <input type="file" class="form-control" id="profile_photo" name="profile_photo">
                            <small class="text-muted">Allowed formats: jpg, png, jpeg. Max size: 2MB.</small>
                        </div>

                        <div class="col-12 mt-3">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card member-card">
            <div class="card-header">
                <h5>Membership Information</h5>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Membership ID
                        <strong>{{ $user->member_id ?? 'N/A' }}</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Membership Type
                        <strong>Permanent Member</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Membership Status
                        <span
                            class="badge bg-{{ $user->status == 1 ? 'success' : 'secondary' }}">{{ $user->status == 1 ? 'Active' : 'Inactive' }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card member-card text-center">
            <div class="card-header">
                <h5>Profile Picture</h5>
            </div>
            <div class="card-body">
                <img src="{{ $user->photo ? asset($user->photo) : 'https://i.pravatar.cc/150?u=' . $user->id }}"
                    alt="Profile Picture" class="img-fluid rounded-circle mb-3"
                    style="width: 150px; height: 150px; object-fit: cover; border: 4px solid #fff; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
                <!-- Removed separate file input, integrated into main form -->
            </div>
        </div>
        <div class="card member-card text-center">
            <div class="card-header">
                <h5>Digital Membership Card</h5>
            </div>
            <div class="card-body p-4 bg-primary-dark text-white">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=MemberID:{{ $user->member_id ?? $user->id }}&bgcolor=112014&color=ffffff"
                    alt="QR Code" class="img-fluid mb-3 bg-white p-2 rounded">
                <h5 class="mb-1 text-white">{{ $user->first_name }} {{ $user->last_name }}</h5>
                <p class="mb-2 text-white-50">ID: {{ $user->member_id ?? 'N/A' }}</p>
                <p class="mb-0"><span class="badge bg-accent">Status:
                        {{ $user->status == 1 ? 'Active' : 'Inactive' }}</span></p>
            </div>
        </div>
    </div>
</div>
@include("frontend.member.member_footer")