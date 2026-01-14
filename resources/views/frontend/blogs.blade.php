@include("frontend.inc.header")

<div class="page-header bg-section parallaxie">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-header-box">
                    <h1 class="text-anime-style-3" data-cursor="-opaque">Blogs</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-blog">
    <div class="container">
        <div class="row">

            @forelse($blogs as $blog)
            <div class="col-lg-4 col-md-6">
                <div class="post-item wow fadeInUp">
                    <div class="post-featured-image">
                        <a href="{{ url('/post/'.$blog->slog) }}" data-cursor-text="View">
                            <figure class="image-anime">
                                <img src="{{ asset('public/'.$blog->imgs ?? 'public/frontend/images/post-1.jpg') }}"
                                     alt="{{ $blog->title }}">
                            </figure>
                        </a>
                    </div>

                    <div class="post-item-body">
                        <div class="post-item-content">
                            <h2>
                                <a href="{{ url('/post/'.$blog->slog) }}">
                                    {{ $blog->title }}
                                </a>
                            </h2>

                            <p>
                                {{ $blog->shortContent }}
                            </p>
                        </div>

                        <div class="post-item-btn">
                            <a href="{{ url('/post/'.$blog->slog) }}">
                                read more
                                <img src="{{ asset('public/frontend/images/arrow-black.svg') }}" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-lg-12 text-center">
                <p>No blogs found.</p>
            </div>
            @endforelse

            {{-- Pagination --}}
            @if($blogs->hasPages())
            <div class="col-lg-12">
                <div class="page-pagination wow fadeInUp" data-wow-delay="0.5s">
                    {{ $blogs->links('pagination::bootstrap-4') }}
                </div>
            </div>
            @endif

        </div>
    </div>
</div>

@include("frontend.inc.footer")
