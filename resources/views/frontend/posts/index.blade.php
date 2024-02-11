@extends('frontend.layouts.app')

@section('content')
    <section id="content">
        <div class="container px-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home.index') }}" class="text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Blog</li>
                </ol>
            </nav>

            <div class="row">
                <div class="col-lg-8">
                    <h2>{{ $page_title }}</h2>
                    <div class="row row-cols-1 row-cols-md-2 g-4 mb-3" data-masonry='{"percentPosition": true }'>
                        @foreach ($latest_posts as $latestPost)
                            <div class="col">
                                <div class="card border-0 bg-light-subtle rounded-3 shadow">
                                    <a href="{{ route('posts.show', ['slug' => $latestPost->slug]) }}">
                                        @if ($latestPost->featured_image && Storage::exists('public/images/posts/' . $latestPost->featured_image))
                                            <img src="{{ asset('storage/images/posts/' . $latestPost->featured_image) }}"
                                                class="card-img-top">
                                        @else
                                            <img src="{{ asset('storage/images/no-image.jpg') }}"
                                                class="card-img-top">
                                        @endif
                                    </a>
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <a href="{{ route('posts.show', ['slug' => $latestPost->slug]) }}"
                                                class="text-decoration-none">
                                                {{ Str::limit($latestPost->title, 60) }}
                                            </a>
                                        </h5>
                                        <p class="card-text mt-3">{!! Str::limit($latestPost->description, rand(10,300)) !!}</p>
                                    </div>
                                    <div class="card-footer border-0">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <i class="fa fa-calendar"></i>
                                                {{ \Carbon\Carbon::parse($latestPost->created_at)->format('d F Y, H:i:s') }}
                                            </div>
                                            <div class="col-lg-4 text-end">
                                                <a href="{{ route('posts.show', ['slug' => $latestPost->slug]) }}"
                                                    class="btn btn-sm btn-primary">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{ $latest_posts->links() }}
                </div>

                <div class="col-lg-4">
                    @include('frontend.layouts.sidebar')
                </div>
            </div>
        </div>
    </section>
@endsection
