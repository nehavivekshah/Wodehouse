@include("frontend.member.member_sidebar")
<h1 class="page-title">Checkout</h1>
<p class="page-subtitle">Confirm your order details and complete the payment.</p>
<form action="{{ route('member.food.placeOrder') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-lg-7">
            {{-- Order Items Review --}}
            <div class="card member-card mb-4">
                <div class="card-header">
                    <h5>1. Review Order Items</h5>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @foreach($cartItems as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0">{{ $item->food->name }}</h6>
                                    <small class="text-muted">Qty: {{ $item->quantity }} x ₹{{ $item->food->price }}</small>
                                </div>
                                <span>₹{{ number_format($item->quantity * $item->food->price, 2) }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="card member-card">
                <div class="card-header">
                    <h5>2. Service Options</h5>
                </div>
                <div class="card-body">
                    <p>Please specify how you would like to receive your order.</p>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="serviceOption" value="table"
                            id="tableDelivery" checked>
                        <label class="form-check-label" for="tableDelivery">
                            <strong>Deliver to my Table</strong>
                        </label>
                        <div class="ms-4 mt-2">
                            <label for="tableNumber" class="form-label">Enter Table Number</label>
                            <input type="text" class="form-control" name="tableNumber" id="tableNumber"
                                placeholder="e.g., 14" style="max-width: 200px;">
                        </div>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="serviceOption" value="pickup" id="pickup">
                        <label class="form-check-label" for="pickup">
                            <strong>Pickup from Counter</strong>
                            <p class="text-muted small mb-0">You will be notified when your order is ready.</p>
                        </label>
                    </div>

                    <hr class="my-4">

                    <h5 class="mb-3">Payment Method</h5>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="payment_method" value="cash" id="payCash"
                            checked>
                        <label class="form-check-label" for="payCash">
                            <i class="fas fa-money-bill-wave me-2 text-success"></i> <strong>Pay at Counter /
                                Cash</strong>
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_method" value="online" id="payOnline"
                            disabled>
                        <label class="form-check-label text-muted" for="payOnline">
                            <i class="fas fa-credit-card me-2"></i> <strong>Online Payment</strong> (Coming Soon)
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card member-card">
                <div class="card-header">
                    <h5>3. Order Summary & Payment</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between px-0">
                            <span>Subtotal</span>
                            <span>₹ {{ number_format($subtotal, 2) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between px-0">
                            <span>Taxes (GST 18%)</span>
                            <span>₹ {{ number_format($gst, 2) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between px-0 fs-5 fw-bold">
                            <span>Amount to Pay</span>
                            <span class="text-accent">₹ {{ number_format($total, 2) }}</span>
                        </li>
                    </ul>
                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-check-circle me-2"></i> Confirm Order
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@include("frontend.member.member_footer")