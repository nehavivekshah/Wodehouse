@include("frontend.member.member_sidebar")
<h1 class="page-title">Dashboard</h1>
<p class="page-subtitle">Welcome back, John! Here's a quick overview of your account.</p>
<div class="row">
    <div class="col-lg-8">
        <div class="card member-card">
            <div class="card-header">
                <h5>Your Monthly Activity</h5>
            </div>
            <div class="card-body">
                <canvas id="activityChart" style="height: 250px;"></canvas>
            </div>
        </div>
        <div class="card member-card">
            <div class="card-header">
                <h5><i class="fas fa-bullhorn me-2"></i>Latest News & Announcements</h5>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    <a href="agm.php" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1">Annual General Meeting Announcement</h6>
                            <small class="text-muted">3 days ago</small>
                        </div>
                        <p class="mb-1">The AGM will be held on August 30th. All members are invited to attend and participate.</p>
                    </a>
                    <a href="menu.php" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1">New Menu Launch at the Wodehouse Courtyard</h6>
                            <small class="text-muted">1 week ago</small>
                        </div>
                        <p class="mb-1">Come and try our new continental menu prepared by Chef Anton, starting next Monday.</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card member-card">
            <div class="card-header">
                <h5><i class="fas fa-link me-2"></i>Quick Links</h5>
            </div>
            <div class="list-group list-group-flush">
                <a href="facility_availability.php" class="list-group-item list-group-item-action"><i class="fas fa-calendar-alt fa-fw me-2 text-muted"></i> Book a Facility</a>
                <a href="menu.php" class="list-group-item list-group-item-action"><i class="fas fa-utensils fa-fw me-2 text-muted"></i> Order Food & Beverage</a>
                <a href="events.php" class="list-group-item list-group-item-action"><i class="fas fa-glass-cheers fa-fw me-2 text-muted"></i> View Events</a>
            </div>
        </div>
        <div class="card member-card">
            <div class="card-header">
                <h5><i class="fas fa-calendar-day me-2"></i>Upcoming Bookings</h5>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    <div class="list-group-item">
                        <p class="mb-1 fw-bold">Tennis Court 1</p>
                        <small class="text-muted">Today, 5:00 PM - 6:00 PM</small>
                    </div>
                    <div class="list-group-item">
                        <p class="mb-1 fw-bold">Tennis Court</p>
                        <small class="text-muted">Tomorrow, 10:00 AM - 11:00 AM</small>
                    </div>
                </div>
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
<script>
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('activityChart').getContext('2d');
    const activityChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
            datasets: [{
                label: 'Bookings',
                data: [5, 8, 12, 7, 10, 14],
                backgroundColor: 'rgba(122, 150, 127, 0.6)',
                borderColor: 'rgba(122, 150, 127, 1)',
                borderWidth: 1
            },
            {
                label: 'Orders',
                data: [10, 15, 11, 14, 18, 20],
                backgroundColor: 'rgba(17, 32, 20, 0.6)',
                borderColor: 'rgba(17, 32, 20, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: { y: { beginAtZero: true } },
            plugins: { legend: { position: 'top' } }
        }
    });
});
</script>
@include("frontend.member.member_footer")