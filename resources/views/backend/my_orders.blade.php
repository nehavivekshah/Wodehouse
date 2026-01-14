@include("frontend.member.member_sidebar")

<h1 class="page-title">My Orders</h1>
<p class="page-subtitle">A history of all your past food and beverage orders.</p>

<div class="card member-card">
    <div class="card-header">
        <h5>Order History</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="ordersTable" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><samp>#WG-ORD-86754</samp></td>
                        <td><?php echo date('Y-m-d H:i:s'); ?></td>
                        <td><strong>₹ 413.00</strong></td>
                        <td><span class="badge" style="background-color: #ffc107; color: #000;">In Preparation</span></td>
                        <td class="text-center"><a href="#" class="btn btn-sm btn-outline-dark">View Details</a></td>
                    </tr>
                    <tr>
                        <td><samp>#WG-ORD-86712</samp></td>
                        <td><?php echo date('Y-m-d H:i:s', strtotime('-1 day')); ?></td>
                        <td><strong>₹ 1250.00</strong></td>
                        <td><span class="badge bg-success">Delivered</span></td>
                        <td class="text-center"><a href="#" class="btn btn-sm btn-outline-dark">View Details</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    $('#ordersTable').DataTable({
        "order": [[ 1, "desc" ]]
    });
});
</script>

@include("frontend.member.member_footer")