@include("frontend.inc.header")

<div class="page-header parallaxie">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <div class="page-header-box">
                    <h1 class="text-anime-style-3" data-cursor="-opaque">
                        {{ $post->title }}
                    </h1>

                    <div class="post-single-meta wow fadeInUp">
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa-regular fa-user"></i>
                                {{ $post->author ?? 'Admin' }}
                            </li>
                            <li>
                                <i class="fa-regular fa-clock"></i>
                                {{ \Carbon\Carbon::parse($post->created_at)->format('d M Y') }}
                            </li>
                        </ol>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="page-single-post">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <!-- Featured Image -->
                @if(!empty($post->imgs))
                <div class="post-image">
                    <figure class="image-anime reveal">
                        <img src="{{ asset('public/'.$post->imgs) }}" alt="{{ $post->title }}">
                    </figure>
                </div>
                @endif

                <!-- Post Content -->
                <div class="post-content">

                    <div class="post-entry">
                        {!! $post->content !!}
                    </div>

                    <!-- Tags + Social -->
                    <div class="post-tag-links">
                        <div class="row align-items-center">

                            <!-- Tags -->
                            <div class="col-lg-8">
                                @if(!empty($post->tags))
                                <div class="post-tags wow fadeInUp" data-wow-delay="0.5s">
                                    <span class="tag-links">
                                        Tags:
                                        @foreach(explode(',', $post->tags) as $tag)
                                            <a href="#">{{ trim($tag) }}</a>
                                        @endforeach
                                    </span>
                                </div>
                                @endif
                            </div>

                            <!-- Social Share -->
                            <div class="col-lg-4">
                                <div class="post-social-sharing wow fadeInUp" data-wow-delay="0.5s">
                                    <ul>
                                        <li>
                                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}"
                                               target="_blank">
                                                <i class="fa-brands fa-facebook-f"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ url()->current() }}"
                                               target="_blank">
                                                <i class="fa-brands fa-linkedin-in"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.instagram.com/"
                                               target="_blank">
                                                <i class="fa-brands fa-instagram"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}"
                                               target="_blank">
                                                <i class="fa-brands fa-x-twitter"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <!-- Post Content End -->

            </div>
        </div>
    </div>
</div>

@include("frontend.inc.footer")
