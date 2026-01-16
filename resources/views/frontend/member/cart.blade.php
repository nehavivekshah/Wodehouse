@include("frontend.member.member_sidebar")

<meta name="csrf-token" content="{{ csrf_token() }}">

<h1 class="page-title">My Cart</h1>
<p class="page-subtitle">Review your F&B order before proceeding to checkout.</p>

<div class="row">
    {{-- CART ITEMS --}}
    <div class="col-lg-8">
        <div class="card member-card">
            <div class="card-header">
                <h5>Order Items</h5>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width:45%">Item</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-end">Price</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php $subtotal = 0; @endphp

                            @forelse($cartItems as $item)
                                @php
                                    $itemTotal = $item->quantity * $item->food->price;
                                    $subtotal += $itemTotal;
                                @endphp

                                <tr id="row-{{ $item->id }}" data-id="{{ $item->id }}">
                                    <td>
                                        <div class="d-flex align-items-center p-2">
                                            <img src="/public/{{ $item->food->image }}" class="img-fluid rounded me-3"
                                                style="width:80px;height:60px;object-fit:cover">
                                            <div>
                                                <h6 class="mb-0">{{ $item->food->name }}</h6>
                                                <small class="text-muted">
                                                    {{ $item->food->category ?? 'Food Item' }}
                                                </small>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="text-center">
                                        <div class="input-group" style="width:140px;margin:auto;">
                                            <button class="btn btn-outline-secondary btn-sm qty-minus">-</button>
                                            <input type="text" class="form-control form-control-sm text-center qty-input"
                                                value="{{ $item->quantity }}" readonly>
                                            <button class="btn btn-outline-secondary btn-sm qty-plus">+</button>
                                        </div>
                                    </td>

                                    <td class="text-end fw-bold">
                                        ₹ {{ number_format($itemTotal, 2) }}
                                    </td>

                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-danger remove-item">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">
                                        Your cart is empty
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- ORDER SUMMARY --}}
    <div class="col-lg-4">
        @php
            $gst = $subtotal * 0.18;
            $total = $subtotal + $gst;
        @endphp

        <div class="card member-card">
            <div class="card-header">
                <h5>Order Summary</h5>
            </div>

            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between px-0">
                        <span>Subtotal</span>
                        <span id="summ-subtotal">₹ {{ number_format($subtotal, 2) }}</span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between px-0">
                        <span>GST (18%)</span>
                        <span id="summ-gst">₹ {{ number_format($gst, 2) }}</span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between px-0 fs-5 fw-bold">
                        <span>Total</span>
                        <span id="summ-total" class="text-accent">
                            ₹ {{ number_format($total, 2) }}
                        </span>
                    </li>
                </ul>

                <div class="d-grid mt-4">
                    @if($subtotal > 0)
                        <a href="{{ route('member.food.checkout') }}" class="btn btn-primary btn-lg">
                            Proceed to Checkout
                        </a>
                    @else
                        <button class="btn btn-secondary btn-lg" disabled>
                            Cart Empty
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@include("frontend.member.member_footer")

{{-- JS --}}
<script>
    $(document).ready(function () {

        $('.qty-plus').click(function () {
            let row = $(this).closest('tr');
            updateQuantity(row, 1);
        });

        $('.qty-minus').click(function () {
            let row = $(this).closest('tr');
            updateQuantity(row, -1);
        });

        $('.remove-item').click(function () {
            let row = $(this).closest('tr');
            removeItem(row.data('id'));
        });

        function updateQuantity(row, change) {
            let input = row.find('.qty-input');
            let qty = parseInt(input.val()) + change;

            if (qty < 1) return;

            $.post("{{ route('member.food.cart.update') }}", {
                _token: $('meta[name="csrf-token"]').attr('content'),
                id: row.data('id'),
                quantity: qty
            }, function (response) {
                if (response.success) {
                    input.val(qty);
                    // Update item total
                    row.find('.text-end.fw-bold').text('₹ ' + parseFloat(response.item_total).toFixed(2));

                    // Update Summary
                    updateSummary(response);
                }
            });
        }

        function removeItem(id) {
            Swal.fire({
                title: 'Remove item?',
                text: 'This item will be removed from cart.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Remove'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post("{{ route('member.food.cart.remove') }}", {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        id: id
                    }, function (response) {
                        if (response.success) {
                            $('#row-' + id).fadeOut(300, function () {
                                $(this).remove();
                            });
        
                            // Update summary
                            updateSummary(response);
        
                            // Reload if cart empty
                            if (response.cart_count === 0) {
                                setTimeout(() => location.reload(), 300);
                            }
                        }
                    });
                }
            });
        }


        function updateSummary(response) {
            $('#summ-subtotal').text('₹ ' + parseFloat(response.subtotal).toFixed(2));
            $('#summ-gst').text('₹ ' + parseFloat(response.gst).toFixed(2));
            $('#summ-total').text('₹ ' + parseFloat(response.total).toFixed(2));
        }
    });
</script>
