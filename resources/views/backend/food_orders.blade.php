@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Food Orders</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="ordersTable">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Member</th>
                            <th>Items</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>#{{ $order->id }}</td>
                                <td>
                                    {{ $order->user->first_name }} {{ $order->user->last_name }}<br>
                                    <small class="text-muted">{{ $order->user->email }}</small>
                                </td>
                                <td>
                                    <ul class="list-unstyled mb-0 small">
                                        @foreach($order->items as $item)
                                            <li>{{ $item->qty }}x {{ $item->foodItem->name ?? 'Unknown' }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>₹{{ number_format($order->total, 2) }}</td>
                                <td>
                                    <select class="form-select form-select-sm status-select" data-id="{{ $order->id }}"
                                        style="width: 130px; border-color: {{ $order->status == 'completed' ? 'green' : ($order->status == 'cancelled' ? 'red' : 'orange') }}">
                                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending
                                        </option>
                                        <option value="preparing" {{ $order->status == 'preparing' ? 'selected' : '' }}>Preparing
                                        </option>
                                        <option value="ready" {{ $order->status == 'ready' ? 'selected' : '' }}>Ready</option>
                                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed
                                        </option>
                                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled
                                        </option>
                                    </select>
                                </td>
                                <td>{{ $order->created_at->format('d M, h:i A') }}</td>
                                <td>
                                    <button class="btn btn-sm btn-info view-details" data-order="{{ json_encode($order) }}">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function () {
                $('#ordersTable').DataTable({
                    "order": [[0, "desc"]]
                });

                // Update Status
                $('.status-select').change(function () {
                    let id = $(this).data('id');
                    let status = $(this).val();
                    let select = $(this);

                    $.ajax({
                        url: '/admin/food-order/update/' + id,
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            status: status
                        },
                        success: function (res) {
                            if (res.success) {
                                toastr.success('Order status updated');
                                // Optional: update border color
                            }
                        },
                        error: function () {
                            toastr.error('Failed to update status');
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection