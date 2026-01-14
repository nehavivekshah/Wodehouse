@include('backend.inc.member_sidebar')

<h1 class="page-title">{{ $user ? 'Edit User' : 'Add User' }}</h1>
<p class="page-subtitle">{{ $user ? 'Update user information' : 'Fill in details to add a new user' }}</p>

<div class="card member-card">
    <div class="card-body">
        <form action="{{ route('admin.submitManageUser') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $user->id ?? '' }}">

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                    <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $user->first_name ?? '') }}" required>
                    @error('first_name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $user->last_name ?? '') }}">
                    @error('last_name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email ?? '') }}" required>
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="mob" class="form-label">Mobile</label>
                    <input type="text" name="mob" class="form-control" value="{{ old('mob', $user->mob ?? '') }}">
                    @error('mob')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="whatsapp" class="form-label">WhatsApp</label>
                    <input type="text" name="whatsapp" class="form-control" value="{{ old('whatsapp', $user->whatsapp ?? '') }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="dob" class="form-label">Date of Birth</label>
                    <input type="date" name="dob" class="form-control" value="{{ old('dob', $user->dob ?? '') }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="gender" class="form-label">Gender</label>
                    <select name="gender" class="form-control">
                        <option value="">Select Gender</option>
                        <option value="male" {{ (old('gender', $user->gender ?? '') == 'male') ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ (old('gender', $user->gender ?? '') == 'female') ? 'selected' : '' }}>Female</option>
                        <option value="other" {{ (old('gender', $user->gender ?? '') == 'other') ? 'selected' : '' }}>Other</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
                    <select name="role" class="form-control" required>
                        <option value="">Select Role</option>
                        <option value="1" {{ (old('role', $user->role ?? '') == '1') ? 'selected' : '' }}>Admin</option>
                        <option value="3" {{ (old('role', $user->role ?? '') == '3') ? 'selected' : '' }}>Staff</option>
                        <option value="5" {{ (old('role', $user->role ?? '') == '5') ? 'selected' : '' }}>Member</option>
                    </select>
                    @error('role')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" class="form-control">
                        <option value="1" {{ (old('status', $user->status ?? 1) == 1) ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ (old('status', $user->status ?? 1) == 0) ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control">
                    <small class="text-muted">Leave blank to keep current password</small>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="photo" class="form-label">Photo</label>
                    <input type="file" name="photo" class="form-control">
                    @if(isset($user->photo))
                        <img src="{{ asset($user->photo) }}" alt="User Photo" class="img-thumbnail mt-2" width="80">
                    @endif
                </div>
            </div>

            <button type="submit" class="btn btn-primary">{{ $user ? 'Update User' : 'Add User' }}</button>
        </form>
    </div>
</div>

@include('backend.inc.member_footer')
