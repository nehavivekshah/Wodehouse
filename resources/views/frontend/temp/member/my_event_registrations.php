<?php include("member_sidebar.php"); ?>

<h1 class="page-title">My Event Registrations</h1>
<p class="page-subtitle">A record of all the events you have registered for.</p>

<div class="card member-card">
    <div class="card-header">
        <h5>Registration History</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="eventsTable" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Event Name</th>
                        <th>Date & Time</th>
                        <th>Fee Paid</th>
                        <th>Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Live Music Night</strong></td>
                        <td><?php echo date('Y-m-d', strtotime('+7 days')); ?> 8:00 PM</td>
                        <td>₹ 200.00</td>
                        <td><span class="badge" style="background-color: var(--accent-color); color: #fff;">Upcoming</span></td>
                        <td class="text-center"><button class="btn btn-sm btn-outline-danger">Cancel</button></td>
                    </tr>
                    <tr>
                        <td><strong>Annual Tennis Tournament</strong></td>
                        <td><?php echo date('Y-m-d', strtotime('+15 days')); ?> 9:00 AM</td>
                        <td>₹ 500.00</td>
                        <td><span class="badge" style="background-color: var(--accent-color); color: #fff;">Upcoming</span></td>
                        <td class="text-center"><button class="btn btn-sm btn-outline-danger">Cancel</button></td>
                    </tr>
                    <tr>
                        <td><strong>Wine Tasting Workshop</strong></td>
                        <td><?php echo date('Y-m-d', strtotime('-20 days')); ?> 7:00 PM</td>
                        <td>₹ 1500.00</td>
                        <td><span class="badge bg-secondary">Attended</span></td>
                        <td class="text-center"><a href="#" class="btn btn-sm btn-outline-dark">View Invoice</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    $('#eventsTable').DataTable({
        "order": [[ 1, "desc" ]]
    });
});
</script>

<?php include("member_footer.php"); ?>