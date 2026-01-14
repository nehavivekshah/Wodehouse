@include("frontend.inc.header")

<div class="page-header bg-section parallaxie">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-header-box">
                    <h1 class="text-anime-style-3" data-cursor="-opaque">Events</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-courses">
    <div class="container">
        <div class="row">

            @forelse($events as $event)
            <div class="col-lg-4 col-md-6">
                <div class="course-item wow fadeInUp">
                    <div class="course-image">
                        <a href="{{ url('/event/'.$event->slog) }}" data-cursor-text="View">
                            <figure class="image-anime">
                                <img src="{{ asset('public/'.$event->image ?? 'public/frontend/images/course-1.jpg') }}"
                                     alt="{{ $event->title }}">
                            </figure>
                        </a>
                    </div>

                    <div class="course-body">
                        <div class="course-item-content">
                            <h3>
                                <a href="{{ url('/event/'.$event->slog) }}">
                                    {{ $event->title }}
                                </a>
                            </h3>
                        </div>

                        <div class="course-readmore-btn">
                            <a href="{{ url('/event/'.$event->slog) }}">
                                <img src="{{ asset('public/frontend/images/arrow-black.svg') }}" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-lg-12 text-center">
                <p>No events found.</p>
            </div>
            @endforelse

            {{-- Pagination --}}
            @if($events->hasPages())
            <div class="col-lg-12">
                <div class="page-pagination wow fadeInUp" data-wow-delay="0.5s">
                    {{ $events->links('pagination::bootstrap-4') }}
                </div>
            </div>
            @endif

        </div>
    </div>
</div>

@include("frontend.inc.footer")
