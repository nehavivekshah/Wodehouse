<?php include("member_sidebar.php"); ?>
<h1 class="page-title">Change Password</h1>
<p class="page-subtitle">For your security, we recommend choosing a strong password that you don't use elsewhere.</p>
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card member-card">
             <div class="card-header">
                <h5>Set a New Password</h5>
            </div>
            <div class="card-body">
                <form id="changePasswordForm">
                    <div class="mb-3">
                        <label for="currentPassword" class="form-label">Current Password</label>
                        <input type="password" class="form-control" id="currentPassword" required>
                    </div>
                    <div class="mb-3">
                        <label for="newPassword" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="newPassword" required placeholder="Minimum 8 characters">
                         <div class="form-text">
                            Your password must be at least 8 characters long and include letters and numbers.
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="confirmPassword" class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" id="confirmPassword" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Password</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
document.getElementById('changePasswordForm').addEventListener('submit', function(e) {
    e.preventDefault();
    Swal.fire({
        title: 'Success!',
        text: 'Your password has been updated successfully.',
        icon: 'success',
        confirmButtonColor: 'var(--primary-color)'
    });
});
</script>
<?php include("member_footer.php"); ?>