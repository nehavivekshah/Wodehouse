@include("frontend.member.member_sidebar")

<h1 class="page-title">Notifications & Preferences</h1>
<p class="page-subtitle">Manage how we communicate with you for bookings, events, and announcements.</p>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card member-card">
            <div class="card-header">
                <h5>Communication Channels</h5>
            </div>
            <div class="card-body">
                <form>
                    <div class="alert alert-secondary" role="alert">
                        <i class="fas fa-info-circle me-2"></i>
                        Please note that critical account and security alerts will always be sent via email.
                    </div>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-3">
                            <div>
                                <label for="emailNotifications" class="form-check-label h6">Email Notifications</label>
                                <p class="mb-0 text-muted small">For confirmations, receipts, and important updates.</p>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="emailNotifications" checked style="transform: scale(1.4);">
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-3">
                             <div>
                                <label for="whatsappNotifications" class="form-check-label h6">WhatsApp Alerts</label>
                                <p class="mb-0 text-muted small">For booking reminders and instant payment links.</p>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="whatsappNotifications" checked style="transform: scale(1.4);">
                            </div>
                        </li>
                    </ul>

                    <hr class="my-4">

                    <h5 class="mb-3">Broadcast Messages</h5>
                     <div class="list-group-item d-flex justify-content-between align-items-center px-0 py-3">
                         <div>
                            <label for="broadcastOptIn" class="form-check-label h6">Promotional Offers</label>
                            <p class="mb-0 text-muted small">Opt-in for promotional news and special offers via WhatsApp/Email.</p>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="broadcastOptIn" style="transform: scale(1.4);">
                        </div>
                    </div>

                    <div class="mt-4 border-top pt-4">
                         <button type="submit" class="btn btn-highlighted">Save Preferences</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@include("frontend.member.member_footer")