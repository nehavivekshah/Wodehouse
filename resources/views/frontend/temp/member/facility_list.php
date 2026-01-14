<?php include("member_sidebar.php"); ?>

<h1 class="page-title">Book a Facility</h1>
<p class="page-subtitle">Choose a facility to check real-time availability and make a booking.</p>

<div class="row">
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card member-card h-100 service-item">
            <div class="service-image">
                <a href="facility_availability.php">
                    <figure class="image-anime">
                        <img src="../images/service-1.png" class="card-img-top" alt="Tennis">
                    </figure>
                </a>
            </div>
            <div class="card-body d-flex flex-column">
                <h5 class="card-title">Tennis Courts</h5>
                <p class="card-text">Our premium clay courts are maintained to the highest standards, perfect for both casual and competitive play.</p>
                <a href="facility_availability.php" class="btn btn-highlighted mt-auto">Check Availability</a>
            </div>
        </div>
    </div>
     <div class="col-lg-4 col-md-6 mb-4">
        <div class="card member-card h-100 service-item">
             <div class="service-image">
                <a href="facility_availability.php">
                    <figure class="image-anime">
                        <img src="../images/billiards-pg.jpg" class="card-img-top" alt="Billiards">
                    </figure>
                </a>
            </div>
            <div class="card-body d-flex flex-column">
                <h5 class="card-title">Billiards Room</h5>
                <p class="card-text">A classic, well-maintained billiards room for a leisurely game with fellow members.</p>
                <a href="facility_availability.php" class="btn btn-highlighted mt-auto">Check Availability</a>
            </div>
        </div>
    </div>
     <div class="col-lg-4 col-md-6 mb-4">
        <div class="card member-card h-100 service-item">
             <div class="service-image">
                <a href="facility_availability.php">
                    <figure class="image-anime">
                         <img src="../images/card-room-pg.jpg" class="card-img-top" alt="Card Room">
                    </figure>
                </a>
            </div>
            <div class="card-body d-flex flex-column">
                <h5 class="card-title">Card Room</h5>
                <p class="card-text">Enjoy a game of bridge, rummy, or other card games in our quiet and comfortable card room.</p>
                <a href="facility_availability.php" class="btn btn-highlighted mt-auto">Check Availability</a>
            </div>
        </div>
    </div>
</div>

<?php include("member_footer.php"); ?>