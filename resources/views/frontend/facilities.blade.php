@include("frontend.inc.header")

<div class="page-header bg-section parallaxie">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-header-box">
                    <h1 class="text-anime-style-3" data-cursor="-opaque">{{ $type ?? 'Facilities' }}</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-courses">
    <div class="container">
        <div class="row">

            @forelse($facilities as $facility)
                <div class="col-lg-4 col-md-6">
                    <div class="course-item wow fadeInUp">
                        <div class="course-image">
                            <a href="{{ url('/facility/'.$facility->slog) }}" data-cursor-text="View">
                                <figure class="image-anime">
                                    <img
                                        src="{{ asset($facility->image ? 'public/'.$facility->image : 'public/frontend/images/course-1.jpg') }}"
                                        alt="{{ $facility->title }}">
                                </figure>
                            </a>
                        </div>

                        <div class="course-body">
                            <div class="course-item-content">
                                <h3 class="facility-title">
                                    <a href="{{ url('/facility/'.$facility->slog) }}"
                                       title="{{ $facility->title }}">
                                        {{ $facility->title }}
                                    </a>
                                </h3>
                            </div>

                            <div class="course-readmore-btn">
                                <a href="{{ url('/facility/'.$facility->slog) }}">
                                    <img src="{{ asset('public/frontend/images/arrow-black.svg') }}" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-lg-12 text-center">
                    <p>No facilities found.</p>
                </div>
            @endforelse

            {{-- Pagination --}}
            @if ($facilities->hasPages())
                <div class="col-lg-12">
                    <div class="page-pagination wow fadeInUp" data-wow-delay="0.5s">
                        {{ $facilities->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>

@include("frontend.inc.footer")
