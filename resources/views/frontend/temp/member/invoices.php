<?php include("member_sidebar.php"); ?>

<h1 class="page-title">My Invoices</h1>
<p class="page-subtitle">Download your invoices for bookings, orders, and monthly subscriptions.</p>

<div class="card member-card">
    <div class="card-header">
        <h5>Invoice List</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="invoicesTable" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Invoice ID</th>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Description</th>
                        <th class="text-end">Amount</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><samp>INV-WG-2024-07-001</samp></td>
                        <td><?php echo date('Y-m-d'); ?></td>
                        <td>F&B Order</td>
                        <td>Order #WG-ORD-86753</td>
                        <td class="text-end"><strong>₹ 944.00</strong></td>
                        <td class="text-center"><a href="#" class="btn btn-sm btn-outline-primary"><i class="fas fa-download me-2"></i>PDF</a></td>
                    </tr>
                    <tr>
                        <td><samp>INV-WG-2024-07-002</samp></td>
                        <td><?php echo date('Y-m-d', strtotime('-1 day')); ?></td>
                        <td>Facility Booking</td>
                        <td>Tennis Court 1</td>
                        <td class="text-end"><strong>₹ 590.00</strong></td>
                        <td class="text-center"><a href="#" class="btn btn-sm btn-outline-primary"><i class="fas fa-download me-2"></i>PDF</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    $('#invoicesTable').DataTable({
        "order": [[ 1, "desc" ]]
    });
});
</script>

<?php include("member_footer.php"); ?>