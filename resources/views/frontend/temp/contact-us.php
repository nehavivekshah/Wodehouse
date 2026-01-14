<?php include("header.php"); ?>
<div class="page-header bg-section parallaxie">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Page Header Box Start -->
                <div class="page-header-box">
                    <h1 class="text-anime-style-3" data-cursor="-opaque">Contact Us</h1> 
                </div>
                <!-- Page Header Box End -->
            </div>
        </div>
    </div>
</div>
<div class="page-contact-us">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <!-- Contact Us Content Start -->
                    <div class="contact-us-content">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h3 class="wow fadeInUp">contact us</h3>
                            <h2 class="text-anime-style-3" data-cursor="-opaque">Welcome to Wodehouse Gymkhana a premier boutique club</h2>
                        </div>
                        <!-- Section Title End -->

                        <!-- Contact Info List Start -->
                        <div class="contact-info-list">
                            
                            <!-- Contact Info Item Start -->
                            <div class="contact-info-item wow fadeInUp" data-wow-delay="0.2s">
                                <div class="contact-info-header">
                                    <div class="icon-box">
                                        <img src="images/icon-phone.svg" alt="">
                                    </div>
                                    <div class="contact-info-title">
                                        <h3>contact us</h3>
                                    </div>
                                </div>        
                                <div class="contact-info-content">
                                    <p>Accounts : <a href="tel:+919769459645">+91 - 97694 59645</a></p>
                                    <p>General Enquiries : <a href="tel:+919820543616">+91 - 98205 43616</a></p>
                                    <p>Email : <a href="mailto:admin@wodehousegymkhana.in">admin@wodehousegymkhana.in</a></p>
                                </div>
                            </div>
                            <!-- Contact Info Item End -->
                            
                            

                            <!-- Contact Info Item Start -->
                            <div class="contact-info-item wow fadeInUp" data-wow-delay="0.6s">
                                <div class="contact-info-header">
                                    <div class="icon-box">
                                        <img src="images/icon-location.svg" alt="">
                                    </div>
                                    <div class="contact-info-title">
                                        <h3>location</h3>
                                    </div>
                                </div>        
                                <div class="contact-info-content">
                                    <p>182, Maharshi Karve Road, Nariman Point, Mumbai – 400 021 India</p>
                                </div>
                            </div>
                            <!-- Contact Info Item End -->
                             <!-- Contact Info Item Start -->
                            <div class="contact-info-item wow fadeInUp w-100" data-wow-delay="0.4s">
                                <div class="contact-info-header">
                                    <div class="icon-box">
                                        <img src="images/icon-clock.svg" alt="">
                                    </div>
                                    <div class="contact-info-title">
                                        <h3>working hours</h3>
                                    </div>
                                </div>        
                                <div class="contact-info-content">
                                    <p><b>Office Working Hours :</b> 10.00 am - 6 pm</p>
                                    <p><b>Club Timings :</b> 7 am - 12 pm</p>
                                    <p><b>All day breakfast and snacks:</b> 7 am - 12 pm</p>
                                    <p><b>Lunch:</b> 12 pm - 3 pm (last order at 2.30 pm)</p>
                                    <p><b>Dinner:</b> 6.30 pm - 12 pm (Last order at 11 pm)</p>
                                    <p><b>Center Court Bar:</b><br>
                                    12 pm - 3 pm (last order at 2.30 pm) <br>
                                    6.30 pm - 12 pm (Last order at 11 pm)</p>
                                </div>
                            </div>
                            <!-- Contact Info Item End -->
                        </div>
                        <!-- Contact Info List End -->
                    </div>
                    <!-- Contact Us Content End -->
                </div>
                <div class="col-lg-6">
                    <!-- Contact Us Form Start -->
                    <div class="contact-us-form">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h2 class="text-anime-style-3" data-cursor="-opaque">Get in touch with us !</h2>
                        </div>
                        <!-- Section Title End -->
                        <!-- Contact Form Start -->
                        <div class="contact-form">
                            <form id="contactForm" action="#" method="POST" data-toggle="validator" class="wow fadeInUp">
                                <div class="row">                                
                                    <div class="form-group col-md-6 mb-4">
                                        <input type="text" name="fname" class="form-control" id="fname" placeholder="First Name" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group col-md-6 mb-4">
                                        <input type="text" name="lname" class="form-control" id="lname" placeholder="Last Name" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                                <div class="form-group col-md-6 mb-4">
                                        <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone No." required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group col-md-6 mb-4">
                                        <input type="email" name ="email" class="form-control" id="email" placeholder="E-mail" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group col-md-12 mb-4">
                                        <select name="subject" id="subject" class="form-control">
                                            <option value="General Enquiry" selected>General Enquiry</option>
                                            <option value="Membership">Membership</option>
                                            <option value="Events">Events</option>
                                            <option value="Support">Support</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12 mb-5">
                                        <textarea name="message" class="form-control" id="message" rows="4" placeholder="Write Message..."></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn-default"><span>submit message</span></button>
                                        <div id="msgSubmit" class="h3 hidden"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Contact Form End -->
                    </div>
                    <!-- Contact Us Form End -->
                </div>
            </div>
        </div>
    </div>
<?php include("footer.php"); ?>