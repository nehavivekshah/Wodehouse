@include("backend.inc.member_sidebar")
<h1 class="page-title">Payment History</h1>
<p class="page-subtitle">View transactions and download invoices.</p>
<div class="card member-card">
    <div class="card-header">
        <h5>Transactions & Invoices</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="paymentHistoryTable" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Transaction ID</th>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Details</th>
                        <th class="text-end">Amount</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><samp>PAY_Nn5Xh2jF3o</samp></td>
                        <td><?php echo date('Y-m-d'); ?></td>
                        <td>F&B Order</td>
                        <td>Order #WG-ORD-86753</td>
                        <td class="text-end"><strong>₹ 630.00</strong></td>
                        <td class="text-center"><span class="badge bg-success">Success</span></td>
                        <td class="text-center">
                            <a href="view_invoice.php?id=PAY_Nn5Xh2jF3o" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-file-invoice me-1"></i> View Invoice
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td><samp>PAY_Nn4Wb1kG8q</samp></td>
                        <td><?php echo date('Y-m-d', strtotime('-1 day')); ?></td>
                        <td>Facility Booking</td>
                        <td>Tennis Court 1</td>
                        <td class="text-end"><strong>₹ 590.00</strong></td>
                        <td class="text-center"><span class="badge bg-success">Success</span></td>
                        <td class="text-center">
                             <a href="view_invoice.php?id=PAY_Nn4Wb1kG8q" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-file-invoice me-1"></i> View Invoice
                             </a>
                        </td>
                    </tr>
                    <tr>
                        <td><samp>PAY_Nn2Ry7pL4u</samp></td>
                        <td><?php echo date('Y-m-d', strtotime('-5 days')); ?></td>
                        <td>Event</td>
                        <td>Live Music Night</td>
                        <td class="text-end"><strong>₹ 200.00</strong></td>
                        <td class="text-center"><span class="badge bg-danger">Failed</span></td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-secondary disabled">-</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    $('#paymentHistoryTable').DataTable({ "order": [[ 1, "desc" ]] });
});
</script>
@include("backend.inc.member_footer")