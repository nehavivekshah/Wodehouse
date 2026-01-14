@include("frontend.member.member_sidebar")
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
    <div>
        <h1 class="page-title">Food & Beverage</h1>
        <p class="page-subtitle mb-0">Order fresh food or track your previous orders.</p>
    </div>
    <ul class="nav nav-pills mt-3 mt-md-0" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-menu-tab" data-bs-toggle="pill" data-bs-target="#pills-menu" type="button"><i class="fas fa-book-open me-2"></i>Full Menu</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-orders-tab" data-bs-toggle="pill" data-bs-target="#pills-orders" type="button"><i class="fas fa-receipt me-2"></i>Past Orders</button>
        </li>
    </ul>
</div>
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-menu" role="tabpanel">
        <div class="row">
            <div class="col-md-3 d-none d-md-block">
                <div class="menu-sidebar">
                    <h5 class="mb-3 ps-2 fw-bold text-uppercase small text-muted">Categories</h5>
                    <nav id="menu-navbar" class="nav flex-column">
                        <a class="menu-category-link active" href="#starters">Starters</a>
                        <a class="menu-category-link" href="#main-course">Main Course</a>
                        <a class="menu-category-link" href="#breads">Breads & Rice</a>
                        <a class="menu-category-link" href="#desserts">Desserts</a>
                    </nav>
                </div>
            </div>
            <div class="col-md-9" data-bs-spy="scroll" data-bs-target="#menu-navbar" data-bs-offset="120" tabindex="0">
                <div id="starters" class="mb-5">
                    <h3 class="mb-4 pb-2 border-bottom">Starters</h3>
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="card member-card h-100 flex-row overflow-hidden align-items-center p-0">
                                <img src="https://images.unsplash.com/photo-1511795409834-ef04bbd61622?w=200" class="img-fluid" alt="Bruschetta" style="width: 130px; height: 100%; object-fit: cover;">
                                <div class="card-body p-3">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <h5 class="card-title mb-1">Tomato Bruschetta</h5>
                                        <span class="fw-bold text-accent">₹ 350</span>
                                    </div>
                                    <p class="text-muted small mb-2">Toasted bread with fresh tomatoes & basil.</p>
                                    <button class="btn btn-sm btn-primary" onclick="addToCart()"><i class="fas fa-plus me-1"></i>Add to Cart</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card member-card h-100 flex-row overflow-hidden align-items-center p-0">
                                <img src="https://images.unsplash.com/photo-1599487488170-d11ec9c172f0?w=200" class="img-fluid" alt="Chicken Tikka" style="width: 130px; height: 100%; object-fit: cover;">
                                <div class="card-body p-3">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <h5 class="card-title mb-1">Chicken Tikka</h5>
                                        <span class="fw-bold text-accent">₹ 450</span>
                                    </div>
                                    <p class="text-muted small mb-2">Grilled chicken marinated in spices.</p>
                                    <button class="btn btn-sm btn-primary" onclick="addToCart()"><i class="fas fa-plus me-1"></i>Add to Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="main-course" class="mb-5">
                    <h3 class="mb-4 pb-2 border-bottom">Main Course</h3>
                    <div class="alert alert-light border text-center p-4">
                        <i class="fas fa-utensils fa-2x text-muted mb-2"></i>
                        <p class="mb-0">Main course items are loading...</p>
                    </div>
                </div>
                <div style="height: 100px;"></div>
            </div>
        </div>
        <div class="floating-cart">
            <div class="cart-info">
                <i class="fas fa-shopping-cart me-2"></i>
                <span><strong>2 Items</strong> | ₹ 800.00</span>
            </div>
            <a href="cart.php" class="btn btn-accent">View Cart</a>
        </div>
    </div>
    <div class="tab-pane fade" id="pills-orders" role="tabpanel">
        <div class="card member-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">My Order History</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="ordersTable" class="table table-striped w-100">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Date</th>
                                <th>Items</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><samp>#WG-ORD-86754</samp></td>
                                <td><?php echo date('Y-m-d H:i'); ?></td>
                                <td>Bruschetta (1), Soda (2)</td>
                                <td><strong>₹ 413.00</strong></td>
                                <td><span class="badge bg-warning text-dark">In Preparation</span></td>
                                <td><a href="order_details.php?id=WG-ORD-86754" class="btn btn-sm btn-outline-primary">View Details</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function addToCart() {
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'success',
        title: 'Item added to cart',
        showConfirmButton: false,
        timer: 1500,
        timerProgressBar: true
    });
}
document.addEventListener('DOMContentLoaded', function () {
    var scrollSpy = new bootstrap.ScrollSpy(document.body, {
        target: '#menu-navbar',
        offset: 140
    });
    $('#ordersTable').DataTable({ "order": [[ 1, "desc" ]] });
});
</script>
@include("frontend.member.member_footer")