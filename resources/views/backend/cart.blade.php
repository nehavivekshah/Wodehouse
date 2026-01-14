@include("frontend.member.member_sidebar")
<h1 class="page-title">My Cart</h1>
<p class="page-subtitle">Review your F&B order before proceeding to checkout.</p>
<div class="row">
    <div class="col-lg-8">
        <div class="card member-card">
            <div class="card-header">
                <h5>Order Items</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="table-light d-none d-md-table-header-group">
                            <tr>
                                <th style="width: 50%;">Item</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-end">Price</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center p-2">
                                        <img src="https://images.unsplash.com/photo-1598515214211-89d3c72732b2?w=100"
                                            class="img-fluid rounded me-3" alt="Bruschetta"
                                            style="width: 80px; height: 60px; object-fit: cover;">
                                        <div>
                                            <h6 class="mb-0">Classic Tomato Bruschetta</h6>
                                            <small class="text-muted">Starter</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="input-group" style="width: 180px; margin: auto;">
                                        <button class="btn btn-outline-secondary btn-sm quantity-minus"
                                            type="button">-</button>
                                        <input type="text"
                                            class="form-control form-control-sm text-center quantity-input" value="1"
                                            readonly>
                                        <button class="btn btn-outline-secondary btn-sm quantity-plus"
                                            type="button">+</button>
                                    </div>
                                </td>
                                <td class="text-end fw-bold">₹ 350.00</td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger"><i
                                            class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card member-card">
            <div class="card-header">
                <h5>Order Summary</h5>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between px-0">
                        <span>Subtotal</span>
                        <span>₹ 350.00</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between px-0">
                        <span>Taxes (GST)</span>
                        <span>₹ 63.00</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between px-0 fs-5 fw-bold">
                        <span>Total</span>
                        <span class="text-accent">₹ 413.00</span>
                    </li>
                </ul>
                <div class="d-grid mt-4">
                    <a href="checkout.php" class="btn btn-primary btn-lg">Proceed to Checkout</a>
                </div>
            </div>
        </div>
    </div>
</div>
@include("frontend.member.member_footer")
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const quantityGroups = document.querySelectorAll('.input-group');
        quantityGroups.forEach(group => {
            const minusButton = group.querySelector('.quantity-minus');
            const plusButton = group.querySelector('.quantity-plus');
            const quantityInput = group.querySelector('.quantity-input');
            minusButton.addEventListener('click', function () {
                let currentValue = parseInt(quantityInput.value);
                if (currentValue > 1) {
                    quantityInput.value = currentValue - 1;
                }
            });
            plusButton.addEventListener('click', function () {
                let currentValue = parseInt(quantityInput.value);
                quantityInput.value = currentValue + 1;
            });
        });
    });
</script>