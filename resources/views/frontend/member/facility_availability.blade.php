@include("frontend.member.member_sidebar")

{{-- CSRF Token for AJAX --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
    .time-slot-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(130px, 1fr));
        gap: 12px;
        margin-top: 20px;
    }

    .time-slot {
        padding: 15px;
        border: 2px solid #e9ecef;
        border-radius: 8px;
        text-align: center;
        cursor: pointer;
        transition: 0.2s;
        font-weight: 600;
        background: #fff;
    }

    .time-slot.available:hover {
        border-color: #0d6efd;
        color: #0d6efd;
        background: #f8f9ff;
    }

    .time-slot.selected { background: var(--accent-color) !important; color: var(--primary-color) !important; border-color: var(--accent-color) !important; }

    .time-slot.booked {
        background: #f8d7da;
        color: #721c24;
        border-color: #f5c6cb;
        cursor: not-allowed;
        opacity: 0.7;
    }

    /* Calendar Highlighting */
    .flatpickr-day.enabled-day {
        background: #e8f5e9 !important;
        border-color: #2e7d32 !important;
        color: #2e7d32 !important;
        font-weight: bold;
    }

    .flatpickr-day.enabled-day:after {
        content: "";
        position: absolute;
        bottom: 3px;
        left: 50%;
        transform: translateX(-50%);
        width: 4px;
        height: 4px;
        border-radius: 50%;
        background: #2e7d32;
    }

    .booking-legend span {
        margin-right: 15px;
        font-size: 0.9rem;
    }

    .card {
        border-radius: 12px;
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h1 class="page-title">Facilities &amp; Bookings</h1>
        <p class="page-subtitle">Reserve a facility or manage your schedule.</p>
    </div>
    <ul class="nav nav-pills" id="booking-tabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link {{ request()->get('mybooking') !== 'active' ? 'active' : '' }}" id="tab-book"
                data-bs-toggle="pill" data-bs-target="#content-book" type="button"
                aria-selected="{{ request()->get('mybooking') !== 'active' ? 'true' : 'false' }}" role="tab">
                <i class="fas fa-plus-circle me-2"></i>New Booking
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link {{ request()->get('mybooking') === 'active' ? 'active' : '' }}" id="tab-history"
                data-bs-toggle="pill" data-bs-target="#content-history" type="button"
                aria-selected="{{ request()->get('mybooking') === 'active' ? 'true' : 'false' }}" tabindex="-1"
                role="tab">
                <i class="fas fa-history me-2"></i>My Bookings
            </button>
        </li>
    </ul>
</div>

<div class="tab-content">

    <div class="tab-pane fade {{ request()->get('mybooking') !== 'active' ? 'show active' : '' }}" id="content-book"
        role="tabpanel" aria-labelledby="tab-book">
        <div class="row">
            <!-- Step 1: Selection -->
            <div class="col-lg-4">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-4">1. Select Facility & Date</h5>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Facility</label>
                            <select id="facilitySelect" class="form-select">
                                <option value="">-- Choose Facility --</option>
                                @foreach($facilities as $facility)
                                    <option value="{{ $facility->id }}">{{ $facility->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Choose Date</label>
                            <input type="text" class="form-control" id="bookingDate"
                                placeholder="Select a facility first..." readonly>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 2: Slots -->
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0">2. Select Time for <span id="selectedDateDisplay"
                                    class="text-primary">Today</span></h5>
                            <div class="booking-legend">
                                <span><i class="fas fa-circle text-success"></i> Available</span>
                                <span><i class="fas fa-circle text-danger"></i> Booked</span>
                            </div>
                        </div>

                        <div id="slotLoader" style="display: none;" class="text-center py-5">
                            <div class="spinner-border text-primary" role="status"></div>
                            <p class="mt-2 text-muted">Checking availability...</p>
                        </div>

                        <div id="slotContainer" class="time-slot-grid">
                            <div class="text-muted py-5 text-center w-100" style="grid-column: 1 / -1;">
                                <i class="fas fa-calendar-alt fa-3x mb-3 opacity-25"></i>
                                <p>Pick a facility and a highlighted date to see available slots.</p>
                            </div>
                        </div>

                        <!-- Step 3: Confirmation -->
                        <div id="confirmation-section" class="mt-5 pt-4 border-top text-center" style="display: none;">
                            <p class="lead">Confirm booking for <strong id="confirm-details"
                                    class="text-primary"></strong>?</p>
                            <button id="finalBookingBtn" class="btn btn-primary btn-lg px-5 shadow-sm">
                                <i class="fas fa-check-circle me-2"></i>Confirm & Proceed
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="tab-pane fade {{ request()->get('mybooking') === 'active' ? 'show active' : '' }}" id="content-history"
        role="tabpanel" aria-labelledby="tab-history">
        <div class="card member-card">
            <div class="card-header">
                <h5>Booking History</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="bookingsTable" class="table table-striped w-100">
                        <thead class="table-light">
                            <tr>
                                <th>Booking ID</th>
                                <th>Facility</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Status</th>
                                <th class="text-center" style="width:100px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bookings as $booking)
                                @php
                                    $today = \Carbon\Carbon::today();
                                    $bookingDate = \Carbon\Carbon::parse($booking->booking_date);
                                @endphp
                                <tr>
                                    <td><samp>BK-{{ $booking->id }}</samp></td>
                                    <td><strong>{{ $booking->facility->title ?? 'N/A' }}</strong></td>
                                    <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('Y-m-d') }}</td>
                                    <td>{{ $booking->slot_time }}</td>
                                    <td>
                                        @if($booking->status === 'pending' && $bookingDate->lt($today))
                                            <span class="badge bg-danger">Expired</span>
                                        @elseif($booking->status === 'pending')
                                            <span class="badge bg-accent">Upcoming</span>
                                        @elseif($booking->status === 'completed')
                                            <span class="badge bg-secondary">Completed</span>
                                        @elseif($booking->status === 'cancelled')
                                            <span class="badge bg-danger">Cancelled</span>
                                        @else
                                            <span class="badge bg-info">{{ ucfirst($booking->status) }}</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($booking->status === 'pending' && $bookingDate->gte($today))
                                            <button class="btn btn-sm btn-outline-danger px-3 py-1"
                                                onclick="confirmCancel({{ $booking->id }})">
                                                Cancel
                                            </button>
                                        @elseif($booking->status === 'completed')
                                            <a href="{{ route('invoice.view', $booking->id) }}"
                                                class="btn btn-sm btn-outline-dark px-3 py-1">
                                                Invoice
                                            </a>
                                        @else
                                            <span class="text-muted">--</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No bookings found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{-- Optional: Pagination if using paginate() --}}
                    @if(method_exists($bookings, 'links'))
                        <div class="mt-3">
                            {{ $bookings->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@include("frontend.member.member_footer")

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // 1. AJAX Setup
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

        const facilitySelect = document.getElementById('facilitySelect');
        const bookingDateInput = document.getElementById('bookingDate');
        const slotContainer = document.getElementById('slotContainer');
        const slotLoader = document.getElementById('slotLoader');
        const confirmationSection = document.getElementById('confirmation-section');
        const selectedDateDisplay = document.getElementById('selectedDateDisplay');
        const confirmDetailsSpan = document.getElementById('confirm-details');
        const finalBookingBtn = document.getElementById('finalBookingBtn');

        let enabledDayIndices = [];
        let selectedSlotValue = null; // This will store '16:00'
        const dayMap = { 'Sunday': 0, 'Monday': 1, 'Tuesday': 2, 'Wednesday': 3, 'Thursday': 4, 'Friday': 5, 'Saturday': 6 };

        // 2. Initialize Flatpickr
        const fp = flatpickr(bookingDateInput, {
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
            minDate: "today",
            defaultDate: "today",
            clickOpens: false,
            onDayCreate: (dObj, dStr, fp, dayElem) => {
                if (enabledDayIndices.includes(dayElem.dateObj.getDay())) {
                    dayElem.classList.add("enabled-day");
                }
            },
            onChange: (selectedDates, dateStr, instance) => {
                selectedDateDisplay.textContent = instance.altInput.value;
                fetchAvailableSlots();
            }
        });

        // Default Today Display
        const dateOptions = { month: 'long', day: 'numeric', year: 'numeric' };
        selectedDateDisplay.textContent = new Date().toLocaleDateString('en-US', dateOptions);

        // 3. Facility Selection Handler
        facilitySelect.addEventListener('change', function () {
            const facilityId = this.value;

            slotContainer.innerHTML = '<div class="text-muted py-5 text-center w-100" style="grid-column: 1 / -1;"><p>Loading schedule...</p></div>';
            confirmationSection.style.display = 'none';

            if (!facilityId) {
                fp.set('clickOpens', false);
                return;
            }

            // Fetch valid days for this facility
            $.get("{{ url('member/get-facility-days') }}/" + facilityId, function (days) {
                enabledDayIndices = days.map(d => isNaN(d) ? dayMap[d] : parseInt(d));

                fp.set('clickOpens', true);
                fp.set('enable', [(date) => enabledDayIndices.includes(date.getDay())]);
                fp.redraw();

                // Auto-fetch slots if today is an allowed day
                const todayIdx = new Date().getDay();
                if (enabledDayIndices.includes(todayIdx)) {
                    fetchAvailableSlots();
                } else {
                    slotContainer.innerHTML = '<div class="alert alert-info w-100 text-center" style="grid-column: 1 / -1;">Facility is closed today. Please pick a highlighted date.</div>';
                }
            });
        });

        // 4. Fetch Slots Function
        function fetchAvailableSlots() {
            const facilityId = facilitySelect.value;
            const date = bookingDateInput.value;

            if (!facilityId || !date) return;

            slotContainer.innerHTML = '';
            slotLoader.style.display = 'block';
            confirmationSection.style.display = 'none';

            $.ajax({
                url: "{{ route('get.slots') }}",
                type: "GET",
                data: { facility_id: facilityId, date: date },
                success: function (response) {
                    slotLoader.style.display = 'none';

                    if (!response.success || response.slots.length === 0) {
                        slotContainer.innerHTML = `<div class="alert alert-warning w-100" style="grid-column: 1 / -1;">${response.message || 'No slots available for this day.'}</div>`;
                        return;
                    }

                    response.slots.forEach(slot => {
                        const slotDiv = document.createElement('div');
                        slotDiv.className = `time-slot ${slot.is_booked ? 'booked' : 'available'}`;

                        // Use display time (like 04:00 PM) for the text
                        slotDiv.innerHTML = `<span>${slot.time}</span>`;

                        if (!slot.is_booked) {
                            slotDiv.onclick = function () {
                                document.querySelectorAll('.time-slot').forEach(s => s.classList.remove('selected'));
                                this.classList.add('selected');

                                // Store the raw_time (like 16:00) for the DB
                                selectedSlotValue = slot.raw_time || slot.time;

                                const facilityName = facilitySelect.options[facilitySelect.selectedIndex].text;
                                confirmDetailsSpan.textContent = `${facilityName} at ${slot.time} on ${fp.altInput.value}`;
                                confirmationSection.style.display = 'block';
                            };
                        }
                        slotContainer.appendChild(slotDiv);
                    });
                },
                error: function () {
                    slotLoader.style.display = 'none';
                    slotContainer.innerHTML = '<div class="alert alert-danger w-100" style="grid-column: 1 / -1;">Error loading slots.</div>';
                }
            });
        }

        // 5. Final Booking & Redirect to Summary
        finalBookingBtn.addEventListener('click', function () {
            const btn = $(this);
            btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>Processing...');

            const payload = {
                facility_id: facilitySelect.value,
                date: bookingDateInput.value,
                time: selectedSlotValue
            };

            $.post("{{ route('member.book.facility') }}", payload)
                .done(function (res) {
                    if (res.success) {
                        // Redirect to the Summary Page provided in previous steps
                        window.location.href = "/member/booking-summary/" + res.booking_id;
                    } else {
                        Swal.fire('Error', res.message, 'error');
                        btn.prop('disabled', false).text('Confirm & Proceed');
                    }
                })
                .fail(function () {
                    Swal.fire('Error', 'Server error occurred.', 'error');
                    btn.prop('disabled', false).text('Confirm & Proceed');
                });
        });

        window.confirmCancel = function (bookingId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to cancel this booking?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, cancel it!',
                cancelButtonText: 'No, keep it'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('member.booking.cancel') }}",
                        type: "POST",
                        data: { booking_id: bookingId },
                        success: function (res) {
                            if (res.success) {
                                Swal.fire('Cancelled!', res.message, 'success');
                                const row = $('button[onclick="confirmCancel(' + bookingId + ')"]').closest('tr');
                                row.find('td:nth-child(5)').html('<span class="badge bg-danger">Cancelled</span>');
                                row.find('td:nth-child(6)').html('<span class="text-muted">--</span>');
                            } else {
                                Swal.fire('Error', res.message, 'error');
                            }
                        },
                        error: function () {
                            Swal.fire('Error', 'Server error occurred.', 'error');
                        }
                    });
                }
            });
        };
    });
</script>