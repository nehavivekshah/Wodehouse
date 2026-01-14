<?php include("member_sidebar.php"); ?>
<h1 class="page-title">Events</h1>
<p class="page-subtitle">Discover upcoming social gatherings, tournaments, and workshops at the Gymkhana.</p>
<h3 class="mb-3">Upcoming Events</h3>
<div class="row">
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card member-card h-100">
            <img src="https://images.unsplash.com/photo-1511795409834-ef04bbd61622?w=500" class="card-img-top" alt="Live Music Night" style="height: 220px; object-fit: cover;">
            <div class="card-body d-flex flex-column">
                <p class="text-muted mb-1 small"><?php echo date('D, M d, Y', strtotime('+7 days')); ?> • 8:00 PM</p>
                <h5 class="card-title">Live Music Night</h5>
                <p class="card-text">Enjoy an evening of soulful jazz music at the Wodehouse Courtyard.</p>
                <div class="mt-auto pt-3">
                    <a href="event_details.php" class="btn btn-primary">View Details & Register</a>
                </div>
            </div>
        </div>
    </div>
</div>
<h3 class="mb-3 mt-4">Past Events</h3>
<div class="row">
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card member-card h-100 opacity-75">
            <img src="https://images.unsplash.com/photo-1511795409834-ef04bbd61622??w=500" class="card-img-top" alt="Wine Tasting" style="height: 220px; object-fit: cover;">
            <div class="card-body d-flex flex-column">
                <p class="text-muted mb-1 small"><?php echo date('D, M d, Y', strtotime('-20 days')); ?></p>
                <h5 class="card-title">Wine Tasting Workshop</h5>
                <p class="card-text">A look back at our successful wine tasting event.</p>
                 <div class="mt-auto pt-3">
                    <a href="#" class="btn btn-secondary disabled">View Details</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("member_footer.php"); ?>