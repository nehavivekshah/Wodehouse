@include("frontend.inc.header")

<div class="page-header bg-section parallaxie">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-header-box">
                    <h1 class="text-anime-style-3" data-cursor="-opaque">
                        {{ $facility->title }}
                    </h1>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="about-us">
    <div class="container">
        <div class="row">
            {{-- Image Section --}}
            <div class="col-lg-6">
                <img src="{{ asset('public/'.$facility->image ?? 'public/frontend/images/course-1.jpg') }}"
                     alt="{{ $facility->title }}"
                     class="img-fluid border-img">
            </div>

            {{-- Content Section --}}
            <div class="col-lg-6">
                <div class="about-us-content">

                    <div class="section-title">
                        <h3 class="wow fadeInUp">
                            {{ $facility->title }}
                        </h3>

                        @if(!empty($facility->category))
                        <h2 class="text-anime-style-3" data-cursor="-opaque">
                            {{ $facility->category }}
                        </h2>
                        @endif

                        <p class="wow fadeInUp" data-wow-delay="0.2s">
                            {!! html_entity_decode($facility->description) !!}
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@include("frontend.inc.footer")
