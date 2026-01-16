@include("frontend.member.member_sidebar")
<style>
    .floating-cart {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .floating-cart:hover {
        transform: translateY(-5px);
        box-shadow: 0 1rem 3rem rgba(0, 0, 0, .175) !important;
    }
</style>
<div class="container-fluid">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
        <div>
            <h1 class="page-title">Food & Beverage</h1>
            <p class="page-subtitle mb-0">Order fresh food or track your previous orders.</p>
        </div>

        <ul class="nav nav-pills mt-3 mt-md-0" role="tablist">
            <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#menu" type="button">
                    <i class="fas fa-book-open me-2"></i>Full Menu
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#orders" type="button">
                    <i class="fas fa-receipt me-2"></i>Past Orders
                </button>
            </li>
        </ul>
    </div>

    <div class="tab-content">
        {{-- TAB: MENU --}}
        <div class="tab-pane fade show active" id="menu">
            @if($categories->isEmpty())
                <div class="card member-card py-5 text-center">
                    <div class="card-body">
                        <i class="fas fa-utensils fa-3x text-muted mb-3"></i>
                        <h5>No Menu Available</h5>
                        <p class="text-muted">We're currently updating our kitchen. Please check back later!</p>
                    </div>
                </div>
            @else
                <div class="row">
                    {{-- Categories Sidebar --}}
                    <div class="col-md-3 d-none d-md-block">
                        <div class="menu-sidebar sticky-top" style="top: 100px;">
                            <h6 class="text-uppercase text-muted fw-bold mb-3 small">Categories</h6>
                            <nav id="menu-navbar" class="nav flex-column side-nav-links">
                                @foreach($categories as $category)
                                    <a class="nav-link py-2 ps-0 text-dark border-bottom-hover" href="#{{ $category->slug }}">
                                        {{ $category->name }}
                                    </a>
                                @endforeach
                            </nav>
                        </div>
                    </div>

                    {{-- Menu Items --}}
                    <div class="col-md-9" data-bs-spy="scroll" data-bs-target="#menu-navbar" data-bs-offset="150">
                        @foreach($categories as $category)
                            <div id="{{ $category->slug }}" class="mb-5">
                                <h3 class="mb-4 pb-2 border-bottom fw-bold">{{ $category->name }}</h3>

                                <div class="row">
                                    @forelse($category->items as $item)
                                        <div class="col-lg-6 mb-4">
                                            <div
                                                class="card member-card h-100 flex-row overflow-hidden align-items-center p-0 shadow-sm">
                                                <img src="{{ asset('/public/'.$item->image ?? 'images/no-food.png') }}" alt="{{ $item->name }}"
                                                    style="width:130px; height:100%; object-fit:cover; min-height: 130px;">

                                                <div class="card-body p-3">
                                                    <div class="d-flex justify-content-between align-items-start">
                                                        <h5 class="mb-1 fw-bold">{{ $item->name }}</h5>
                                                        <span class="fw-bold text-primary">
                                                            ₹{{ number_format($item->price, 2) }}
                                                        </span>
                                                    </div>

                                                    <p class="text-muted small mb-3 line-clamp-2">
                                                        {{ $item->description }}
                                                    </p>

                                                    <button class="btn btn-sm btn-outline-primary rounded-pill px-3"
                                                        onclick="addToCart({{ $item->id }})">
                                                        <i class="fas fa-plus me-1"></i>Add to Cart
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-12">
                                            <div class="alert alert-light border text-center">
                                                No items available in {{ $category->name }}.
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Floating Cart - Positioned Bottom Right --}}
            <div class="floating-cart shadow-lg p-3 bg-white border rounded-pill d-flex align-items-center justify-content-between fixed-bottom mb-4 me-4 ms-auto"
                style="width: 320px; z-index: 1050; right: 20px; left: auto;">

                <div class="cart-info ps-2">
                    <i class="fas fa-shopping-cart text-primary me-2"></i>
                    <span id="cart-summary" class="fw-bold small text-dark">0 Items | ₹ 0.00</span>
                </div>

                <a href="{{ route('member.food.cart') }}" class="btn btn-primary rounded-pill px-4 btn-sm shadow-sm">
                    View Cart
                </a>
            </div>
        </div>

        {{-- TAB: ORDERS --}}
        <div class="tab-pane fade" id="orders">
            <div class="card member-card shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">My Order History</h5>
                </div>

                <div class="card-body">
                    @if($orders->isEmpty())
                        <div class="text-center py-5">
                            <i class="fas fa-receipt fa-3x text-light mb-3"></i>
                            <h5 class="text-muted">No orders found</h5>
                            <p class="small text-muted mb-3">You haven't placed any food orders yet.</p>
                            <button class="btn btn-primary btn-sm rounded-pill px-4"
                                onclick="document.querySelector('[data-bs-target=\'#menu\']').click()">
                                Order Now
                            </button>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover align-middle" id="ordersTable">
                                <thead class="table-light">
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Date</th>
                                        <th>Items</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td><span class="badge bg-light text-dark border">#ORD-{{ $order->id }}</span></td>
                                            <td class="small">{{ $order->created_at->format('M d, Y h:i A') }}</td>
                                            <td class="small">
                                                @foreach($order->items as $i)
                                                    {{ $i->foodItem->name }} ({{ $i->qty }})@if(!$loop->last), @endif
                                                @endforeach
                                            </td>
                                            <td><strong class="text-dark">₹{{ number_format($order->total, 2) }}</strong></td>
                                            <td>
                                                @php
                                                    $statusClass = match ($order->status) {
                                                        'completed' => 'success',
                                                        'preparing' => 'warning',
                                                        'pending' => 'secondary',
                                                        'cancelled' => 'danger',
                                                        default => 'info'
                                                    };
                                                @endphp
                                                <span class="badge rounded-pill bg-{{ $statusClass }}">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('member.food.order.details', $order->id) }}"
                                                    class="btn btn-sm btn-light border shadow-sm">
                                                    View Details
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@include("frontend.member.member_footer")

{{-- Styles for clean UI --}}
<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .menu-category-link.active {
        color: var(--bs-primary) !important;
        font-weight: bold;
        border-left: 3px solid var(--bs-primary);
        padding-left: 10px !important;
    }

    .border-bottom-hover:hover {
        border-bottom: 1px solid var(--bs-primary);
    }
</style>

<script>
    // Logic to handle adding to cart
    function addToCart(id) {
        $.post("{{ route('member.food.cart.add') }}", {
            _token: '{{ csrf_token() }}',
            food_id: id
        })
            .done(function (response) {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: 'Item added to cart',
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true
                });

                // Update cart widget
                if (response.success) {
                    $('#cart-summary').text(response.cart_count + ' Items | ₹ ' + parseFloat(response.cart_total).toFixed(2));
                }
            })
            .fail(function () {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: 'Failed to add item',
                    showConfirmButton: false,
                    timer: 1500
                });
            });
    }

    document.addEventListener('DOMContentLoaded', function () {
        // Initialize ScrollSpy
        const scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#menu-navbar',
            offset: 160
        });

        // Initialize DataTable if orders exist
        if (document.getElementById('ordersTable')) {
            $('#ordersTable').DataTable({
                order: [[1, 'desc']],
                pageLength: 10,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search orders..."
                }
            });
        }
    });
</script>
