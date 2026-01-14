@include("frontend.member.member_sidebar")

<div class="row">
    <div class="col-12">
        <div class="card member-card border-0 shadow-sm">
            {{-- Dynamic Event Banner --}}
            <img src="{{ asset($event->image ?? 'images/default-event-large.jpg') }}" class="card-img-top"
                alt="{{ $event->title }}" style="max-height: 400px; object-fit: cover;">

            <div class="card-body p-4">
                <div class="row">
                    {{-- Left Column: Description --}}
                    <div class="col-lg-8">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-3">
                                <li class="breadcrumb-item"><a href="{{ route('member.events') }}">Events</a></li>
                                <li class="breadcrumb-item active">{{ $event->title }}</li>
                            </ol>
                        </nav>

                        <h1 class="page-title mb-3 fw-bold">{{ $event->title }}</h1>

                        <div class="event-description">
                            {{-- <p class="lead text-dark">{{ $event->short_description }}</p> --}}

                            {{-- Allows for HTML content if using a rich text editor --}}
                            <div class="mt-4">
                                {!! $event->content !!}
                            </div>
                        </div>
                    </div>

                    {{-- Right Column: Info Card --}}
                    <div class="col-lg-4">
                        <div class="card sticky-top border-0 shadow-sm" style="background-color: #f4f7f6; top: 100px;">
                            <div class="card-body">
                                <h5 class="mb-4 text-primary fw-bold">Event Details</h5>

                                <ul class="list-unstyled mb-0">
                                    <li class="mb-3 d-flex align-items-start">
                                        <i class="fas fa-calendar-alt fa-fw me-3 mt-1 text-primary"></i>
                                        <div>
                                            <strong class="small text-muted text-uppercase">Date</strong><br>
                                            <span
                                                class="text-dark">{{ $event->event_date->format('l, F jS, Y') }}</span>
                                        </div>
                                    </li>

                                    <li class="mb-3 d-flex align-items-start">
                                        <i class="fas fa-clock fa-fw me-3 mt-1 text-primary"></i>
                                        <div>
                                            <strong class="small text-muted text-uppercase">Time</strong><br>
                                            <span class="text-dark">{{ $event->time }} onwards</span>
                                        </div>
                                    </li>

                                    <li class="mb-3 d-flex align-items-start">
                                        <i class="fas fa-map-marker-alt fa-fw me-3 mt-1 text-primary"></i>
                                        <div>
                                            <strong class="small text-muted text-uppercase">Venue</strong><br>
                                            <span class="text-dark">{{ $event->venue }}</span>
                                        </div>
                                    </li>

                                    <li class="mb-3 d-flex align-items-start">
                                        <i class="fas fa-rupee-sign fa-fw me-3 mt-1 text-primary"></i>
                                        <div>
                                            <strong class="small text-muted text-uppercase">Fee</strong><br>
                                            <span class="text-dark">
                                                {{ $event->price > 0 ? '₹ ' . number_format($event->price, 2) : 'Free for Members' }}
                                            </span>
                                        </div>
                                    </li>

                                    @if($event->capacity)
                                        <li class="mb-0 d-flex align-items-start">
                                            <i class="fas fa-users fa-fw me-3 mt-1 text-primary"></i>
                                            <div>
                                                <strong class="small text-muted text-uppercase">Availability</strong><br>
                                                <span class="text-dark">{{ $event->remaining_spots }} spots left</span>
                                            </div>
                                        </li>
                                    @endif
                                </ul>

                                <div class="d-grid mt-4">
                                    @if($event->is_past)
                                        <button class="btn btn-secondary btn-lg disabled">Event Passed</button>
                                    @elseif($isRegistered)
                                        <button class="btn btn-success btn-lg disabled">
                                            <i class="fas fa-check-circle me-1"></i> Already Registered
                                        </button>
                                    @elseif($event->is_full)
                                        <button class="btn btn-danger btn-lg disabled">Fully Booked</button>
                                    @else
                                        <form action="{{ route('member.events.register', $event->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary btn-lg w-100 shadow-sm">
                                                Register Now
                                            </button>
                                        </form>
                                    @endif
                                </div>

                                <p class="text-center mt-3 mb-0 small text-muted">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Cancellations allowed up to 24h before.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include("frontend.member.member_footer")