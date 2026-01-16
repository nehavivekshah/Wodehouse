@include("backend.inc.member_sidebar")
<div class="card member-card">
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
                                @php
                                    $badges = [
                                        'pending' => 'secondary',
                                        'preparing' => 'info',
                                        'ready' => 'primary',
                                        'completed' => 'success',
                                        'cancelled' => 'danger'
                                    ];
                                    $badgeClass = $badges[$order->status] ?? 'secondary';
                                @endphp
                                <span class="badge bg-{{ $badgeClass }}">{{ ucfirst($order->status) }}</span>
                            </td>
                            <td>{{ $order->created_at->format('d M, h:i A') }}</td>
                            <td>
                                <button class="btn btn-sm btn-info viewOrderBtn" data-id="{{ $order->id }}"><i
                                        class="fas fa-eye"></i></button>
                                <button class="btn btn-sm btn-primary updateStatusBtn" data-id="{{ $order->id }}"><i
                                        class="fas fa-edit"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- View Order Modal -->
<div class="modal fade" id="viewOrderModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Order Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="orderDetailsContent">
                <div class="text-center"><i class="fas fa-spinner fa-spin"></i> Loading...</div>
            </div>
        </div>
    </div>
</div>

<!-- Update Status Modal -->
<div class="modal fade" id="updateStatusModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Order Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateStatusForm">
                    @csrf
                    <input type="hidden" id="updateOrderId">
                    <div class="mb-3">
                        <label class="form-label">Order Status</label>
                        <select id="orderStatusSelect" class="form-control">
                            <option value="pending">Pending</option>
                            <option value="preparing">Preparing</option>
                            <option value="ready">Ready</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Update Status</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#ordersTable').DataTable({
                "order": [[0, "desc"]]
            });

            // View Details
            $(document).on('click', '.viewOrderBtn', function () {
                let id = $(this).data('id');
                $('#viewOrderModal').modal('show');
                $('#orderDetailsContent').html('<div class="text-center"><i class="fas fa-spinner fa-spin"></i> Loading...</div>');

                $.ajax({
                    url: '/admin/food-order-details/' + id,
                    type: 'GET',
                    success: function (response) {
                        if (response.success) {
                            let o = response.order;
                            let itemsHtml = '<ul class="list-group list-group-flush">';
                            o.items.forEach(item => {
                                itemsHtml += `<li class="list-group-item d-flex justify-content-between align-items-center">
                                        ${item.qty}x ${item.food_item ? item.food_item.name : 'Unknown Item'}
                                        <span>₹${item.price}</span>
                                    </li>`;
                            });
                            itemsHtml += '</ul>';

                            let html = `
                                    <h6>Order #${o.id}</h6>
                                    <p><strong>Member:</strong> ${o.user.first_name} ${o.user.last_name} (${o.user.email})</p>
                                    <p><strong>Date:</strong> ${o.created_at}</p>
                                    <p><strong>Status:</strong> <span class="badge bg-secondary">${o.status}</span></p>
                                    <hr>
                                    <h6>Items:</h6>
                                    ${itemsHtml}
                                    <hr>
                                    <h5 class="text-end">Total: ₹${o.total}</h5>
                                `;
                            $('#orderDetailsContent').html(html);
                        } else {
                            $('#orderDetailsContent').html('<p class="text-danger">Error fetching details.</p>');
                        }
                    },
                    error: function () {
                        $('#orderDetailsContent').html('<p class="text-danger">Error fetching details.</p>');
                    }
                });
            });

            // Update Status Modal
            $(document).on('click', '.updateStatusBtn', function () {
                let id = $(this).data('id');
                $('#updateOrderId').val(id);
                $('#updateStatusModal').modal('show');
            });

            // Submit Status Update
            $('#updateStatusForm').submit(function (e) {
                e.preventDefault();
                let id = $('#updateOrderId').val();
                let status = $('#orderStatusSelect').val();

                $.ajax({
                    url: '/admin/food-order/update/' + id,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        status: status
                    },
                    success: function (res) {
                        if (res.success) {
                            $('#updateStatusModal').modal('hide');
                            Swal.fire('Success', 'Order status updated', 'success').then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('Error', 'Failed to update status', 'error');
                        }
                    },
                    error: function () {
                        Swal.fire('Error', 'Something went wrong', 'error');
                    }
                });
            });
        });
    </script>
@endpush
@include("backend.inc.member_footer")