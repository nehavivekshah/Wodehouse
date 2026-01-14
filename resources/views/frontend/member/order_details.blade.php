@include("frontend.member.member_sidebar")
<h1 class="page-title">Order Details #{{ $order->id }}</h1>
<div class="row">
    <div class="col-lg-8">
        <div class="card member-card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Order Items</h5>
                <span
                    class="badge bg-{{ $order->status == 'completed' ? 'success' : 'warning' }}">{{ ucfirst($order->status) }}</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Item</th>
                                <th class="text-center">Qty</th>
                                <th class="text-end">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                                <tr>
                                    <td>{{ $item->foodItem->name ?? 'Unknown Item' }}</td>
                                    <td class="text-center">{{ $item->qty }}</td>
                                    <td class="text-end">₹ {{ number_format($item->price, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <th colspan="2" class="text-end">Total</th>
                                <th class="text-end fs-5">₹ {{ number_format($order->total, 2) }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card member-card">
            <div class="card-header">
                <h5 class="mb-0">Order Info</h5>
            </div>
            <div class="card-body">
                <p><strong>Date:</strong> {{ $order->created_at->format('d M Y, h:i A') }}</p>
                <!-- Add more info like payment status etc -->
                <a href="{{ route('member.menu') }}" class="btn btn-outline-primary w-100">Back to Menu</a>
            </div>
        </div>
    </div>
</div>
@include("frontend.member.member_footer")