<?php include("member_sidebar.php"); ?>
<div class="d-flex justify-content-between align-items-center mb-4 btn-print-group">
<div>
<h1 class="page-title">Invoice Details</h1>
<p class="page-subtitle mb-0">View and print your transaction receipt.</p>
</div>
<div>
<a href="payment_history.php" class="btn btn-secondary me-2">
<i class="fas fa-arrow-left me-2"></i>Back
</a>
<button onclick="window.print()" class="btn btn-primary">
<i class="fas fa-print me-2"></i>Print Invoice
</button>
</div>
</div>
<div class="invoice-container">
<div class="row invoice-header align-items-center">
<div class="col-6">
<div class="d-flex align-items-center">
<img src="../images/favicon.png" alt="Logo" class="invoice-logo me-3" style="width: 60px;">
<div>
<h4 class="mb-0 fw-bold text-primary">WODEHOUSE GYMKHANA</h4>
<small class="text-muted">Maharshi Karve Road, Mumbai</small>
</div>
</div>
</div>
<div class="col-6 text-end">
<h2 class="invoice-title">Tax Invoice</h2>
<p class="mb-0 text-muted">Original Recipient</p>
</div>
</div>
<div class="row my-5">
<div class="col-md-6">
<h6 class="text-uppercase text-muted small fw-bold mb-2">Billed To:</h6>
<h5 class="fw-bold mb-1">John Doe</h5>
<p class="mb-0">Member ID: <strong>WG12345</strong></p>
<p class="mb-0">123, Marine Drive, Mumbai</p>
</div>
<div class="col-md-6 text-md-end">
<div class="mb-1">
<span class="text-muted fw-bold me-2">Invoice No:</span>
<span class="fw-bold">INV-WG-2024-001</span>
</div>
<div class="mb-1">
<span class="text-muted fw-bold me-2">Date:</span>
<span><?php echo date('d M, Y'); ?></span>
</div>
<div class="mb-1">
<span class="text-muted fw-bold me-2">Transaction ID:</span>
<span>PAY_Nn5Xh2jF3o</span>
</div>
</div>
</div>
<div class="table-responsive mb-4">
<table class="table table-borderless">
<thead class="table-light">
<tr>
<th class="py-3 ps-3">Description</th>
<th class="py-3 text-center">HSN/SAC</th>
<th class="py-3 text-center">Qty</th>
<th class="py-3 text-end">Rate</th>
<th class="py-3 text-end pe-3">Amount</th>
</tr>
</thead>
<tbody>
<tr>
<td class="ps-3">
<strong>Tomato Bruschetta</strong><br>
<small class="text-muted">Food & Beverage Order</small>
</td>
<td class="text-center">9963</td>
<td class="text-center">1</td>
<td class="text-end">350.00</td>
<td class="text-end pe-3">350.00</td>
</tr>
<tr>
<td class="ps-3">
<strong>Fresh Lime Soda</strong><br>
<small class="text-muted">Beverage</small>
</td>
<td class="text-center">9963</td>
<td class="text-center">2</td>
<td class="text-end">125.00</td>
<td class="text-end pe-3">250.00</td>
</tr>
<tr style="border-bottom: 1px solid #eee;">
<td class="ps-3">
<strong>GST (5%)</strong><br>
<small class="text-muted">Tax</small>
</td>
<td class="text-center">-</td>
<td class="text-center">-</td>
<td class="text-end">-</td>
<td class="text-end pe-3">30.00</td>
</tr>
</tbody>
</table>
</div>
<div class="row justify-content-end">
<div class="col-md-5">
<table class="table table-borderless table-sm">
<tbody>
<tr>
<td class="text-muted">Subtotal</td>
<td class="text-end fw-bold">₹ 600.00</td>
</tr>
<tr>
<td class="text-muted">Tax (GST)</td>
<td class="text-end fw-bold">₹ 30.00</td>
</tr>
<tr class="border-top">
<td class="fs-5 fw-bold pt-3 text-primary">Total Paid</td>
<td class="fs-5 fw-bold pt-3 text-end text-primary">₹ 630.00</td>
</tr>
</tbody>
</table>
</div>
</div>
<div class="text-center mt-5 pt-4 border-top">
<p class="mb-1 fw-bold">Thank you for your patronage!</p>
<p class="small text-muted mb-0">This is a computer-generated invoice.</p>
</div>
</div>
<?php include("member_footer.php"); ?>