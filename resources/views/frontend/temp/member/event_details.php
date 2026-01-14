<?php include("member_sidebar.php"); ?>
<div class="row">
    <div class="col-12">
        <div class="card member-card">
            <img src="https://images.unsplash.com/photo-1511795409834-ef04bbd61622?w=1200" class="card-img-top" alt="Live Music Night" style="max-height: 400px; object-fit: cover;">
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-lg-8">
                        <h1 class="page-title mb-3">Live Music Night</h1>
                        <p class="lead">Join us for an enchanting evening of soulful jazz and classic rock under the stars at the Wodehouse Courtyard.</p>
                        <p>Enjoy a specially curated menu of appetizers and beverages available for order throughout the evening. It's the perfect opportunity to unwind and socialize with fellow members.</p>
                    </div>
                    <div class="col-lg-4">
                        <div class="card" style="background-color: #f4f7f6;">
                             <div class="card-body">
                                <h5 class="mb-3 text-primary">Event Details</h5>
                                <ul class="list-unstyled">
                                    <li class="mb-3 d-flex"><i class="fas fa-calendar-alt fa-fw me-3 mt-1 text-muted"></i> <div><strong>Date:</strong><br><?php echo date('l, F jS, Y', strtotime('+7 days')); ?></div></li>
                                    <li class="mb-3 d-flex"><i class="fas fa-clock fa-fw me-3 mt-1 text-muted"></i> <div><strong>Time:</strong><br>8:00 PM onwards</div></li>
                                    <li class="mb-3 d-flex"><i class="fas fa-map-marker-alt fa-fw me-3 mt-1 text-muted"></i> <div><strong>Venue:</strong><br>Wodehouse Courtyard</div></li>
                                    <li class="mb-3 d-flex"><i class="fas fa-rupee-sign fa-fw me-3 mt-1 text-muted"></i> <div><strong>Fee:</strong><br>₹ 200 per person</div></li>
                                </ul>
                                <div class="d-grid mt-4">
                                     <button class="btn btn-primary btn-lg">Register Now</button>
                                </div>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("member_footer.php"); ?>