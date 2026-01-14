@include("frontend.member.member_sidebar")

<div class="container-fluid">
    <div class="mb-4">
        <h1 class="page-title">Events</h1>
        <p class="page-subtitle">Discover upcoming social gatherings, tournaments, and workshops at the Gymkhana.</p>
    </div>

    {{-- Upcoming Events Section --}}
    <h3 class="mb-4 fw-bold">Upcoming Events</h3>
    <div class="row">
        @forelse($upcomingEvents as $event)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card member-card h-100 shadow-sm border-0">
                    <div class="position-relative">
                        <img src="{{ asset($event->image ?? 'images/event-placeholder.jpg') }}" class="card-img-top"
                            alt="{{ $event->title }}" style="height: 220px; object-fit: cover;">
                        @if($event->is_featured)
                            <span class="badge bg-primary position-absolute top-0 end-0 m-3">Featured</span>
                        @endif
                    </div>

                    <div class="card-body d-flex flex-column">
                        <p class="text-primary mb-1 small fw-bold">
                            <i class="far fa-calendar-alt me-1"></i>
                            {{ $event->event_date->format('D, M d, Y') }} • {{ $event->time }}
                        </p>
                        <h5 class="card-title fw-bold text-dark">{{ $event->title }}</h5>
                        <p class="card-text text-muted small line-clamp-2">
                            {{ Str::limit(strip_tags($event->content), 100) }}
                        </p>

                        <div class="mt-auto pt-3 border-top">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-dark fw-bold">
                                    {{-- Assuming price is not in DB based on migration, removing price display or checking
                                    migration again --}}
                                    {{-- Migration has no price column. Removing price check. --}}
                                    View Details
                                </span>
                                <a href="{{ route('member.events.details', $event->id) }}"
                                    class="btn btn-primary btn-sm rounded-pill px-3">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card bg-light border-0 py-5 text-center mb-4">
                    <div class="card-body">
                        <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                        <h5>No Upcoming Events</h5>
                        <p class="text-muted">Check back soon for new workshops and gatherings!</p>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    {{-- Past Events Section --}}
    <h3 class="mb-4 mt-4 fw-bold text-muted">Past Events</h3>
    <div class="row">
        @forelse($pastEvents as $event)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card member-card h-100 opacity-75 grayscale shadow-sm border-0">
                    <img src="{{ asset($event->image ?? 'images/event-placeholder.jpg') }}" class="card-img-top"
                        alt="{{ $event->title }}" style="height: 200px; object-fit: cover; filter: grayscale(50%);">

                    <div class="card-body d-flex flex-column">
                        <p class="text-muted mb-1 small">
                            {{ $event->event_date->format('M d, Y') }}
                        </p>
                        <h6 class="card-title fw-bold">{{ $event->title }}</h6>
                        <p class="card-text small text-muted">A look back at this successful event.</p>

                        <div class="mt-auto pt-2">
                            <a href="{{ route('member.events.details', $event->id) }}"
                                class="btn btn-outline-secondary btn-sm rounded-pill w-100">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-muted small italic">No past events recorded.</p>
            </div>
        @endforelse
    </div>
</div>

@include("frontend.member.member_footer")

<style>
    .grayscale {
        transition: filter 0.3s ease;
    }

    .grayscale:hover {
        filter: grayscale(0%);
        opacity: 1 !important;
    }

    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>