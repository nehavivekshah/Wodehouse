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
                <form>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="fullName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="fullName" value="John Doe">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email Address (Cannot be changed)</label>
                            <input type="email" class="form-control" id="email" value="john.doe@example.com" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="contact" class="form-label">Contact Number</label>
                            <input type="text" class="form-control" id="contact" value="+91 98765 43210">
                        </div>
                         <div class="col-md-6 mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" value="123, Marine Drive, Mumbai">
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
                        <strong>WG12345</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Membership Type
                        <strong>Permanent Member</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Membership Status
                        <span class="badge bg-accent">Active</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Validity
                        <strong>Expires on 31 Dec 2025</strong>
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
                <img src="https://i.pravatar.cc/150?u=member123" alt="Profile Picture" class="img-fluid rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover; border: 4px solid #fff; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
                <label for="profilePictureUpload" class="btn btn-sm btn-outline-primary">Change Picture</label>
                <input type="file" class="form-control d-none" id="profilePictureUpload">
            </div>
        </div>
         <div class="card member-card text-center">
            <div class="card-header">
                <h5>Digital Membership Card</h5>
            </div>
            <div class="card-body p-4 bg-primary-dark text-white">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=MemberID:WG12345&bgcolor=112014&color=ffffff" alt="QR Code" class="img-fluid mb-3 bg-white p-2 rounded">
                <h5 class="mb-1 text-white">John Doe</h5>
                <p class="mb-2 text-white-50">ID: WG12345</p>
                <p class="mb-0"><span class="badge bg-accent">Status: Active</span></p>
            </div>
        </div>
    </div>
</div>
@include("frontend.member.member_footer")