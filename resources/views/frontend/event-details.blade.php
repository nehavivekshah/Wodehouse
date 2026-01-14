@include("frontend.inc.header")

<div class="page-header bg-section parallaxie">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-header-box">
                    <h1 class="text-anime-style-3" data-cursor="-opaque">
                        {{ $event->title }}
                    </h1>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-course-single">
    <div class="container">
        <div class="row">

            <!-- SIDEBAR -->
            <div class="col-lg-4">
                <div class="page-single-sidebar">

                    <div class="course-catagery-list wow fadeInUp">
                        <h3>Event Information</h3>
                        <ul>
                            <li>Date:
                                <span>{{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}</span>
                            </li>
                            <li>Time:
                                <span>{{ $event->time }}</span>
                            </li>
                            <li>Venue:
                                <span>{{ $event->venue }}</span>
                            </li>
                            @if(!empty($event->duration))
                            <li>Duration:
                                <span>{{ $event->duration }} Months</span>
                            </li>
                            @endif
                        </ul>
                    </div>

                    <!-- CTA -->
                    <div class="sidebar-cta-box wow fadeInUp" data-wow-delay="0.25s">
                        <div class="sidebar-image-content">
                            <div class="sidebar-cta-image">
                                <figure class="image-anime">
                                    <img src="{{ asset('public/frontend/images/sidebar-cta-image.jpg') }}" alt="">
                                </figure>
                            </div>
                            <div class="sidebar-cta-contact">
                                <div class="sidebar-contact-content">
                                    <h3>Got any questions? Contact us today</h3>
                                </div>
                                <div class="icon-box">
                                    <img src="{{ asset('public/frontend/images/icon-sidebar-phone.svg') }}" alt="">
                                </div>
                            </div>
                        </div>

                        <div class="sidebar-cta-info">
                            <h3>
                                <a href="mailto:support@wodehouse.com">
                                    support@wodehouse.com
                                </a>
                            </h3>
                        </div>
                    </div>

                </div>
            </div>

            <!-- MAIN CONTENT -->
            <div class="col-lg-8">
                <div class="course-single-content">

                    <!-- Event Image -->
                    @if(!empty($event->image))
                    <div class="page-single-image">
                        <figure class="image-anime reeval">
                            <img src="{{ asset('/public/'.$event->image) }}" alt="{{ $event->title }}">
                        </figure>
                    </div>
                    @endif

                    <!-- Event Content -->
                    <div class="course-entry">
                        {!! $event->content !!}
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

@include("frontend.inc.footer")
