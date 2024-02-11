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
                        @foreach ($search_result as $searchResult)
                            <div class="col">
                                <div class="card border-0 bg-light-subtle rounded-3 shadow">
                                    <a href="{{ route('posts.show', ['slug' => $searchResult->slug]) }}">
                                        @if ($searchResult->featured_image && Storage::exists('public/images/posts/' . $searchResult->featured_image))
                                            <img src="{{ asset('storage/images/posts/' . $searchResult->featured_image) }}"
                                                class="card-img-top">
                                        @else
                                            <img src="{{ asset('storage/images/no-image.jpg') }}"
                                                class="card-img-top">
                                        @endif
                                    </a>
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <a href="{{ route('posts.show', ['slug' => $searchResult->slug]) }}"
                                                class="text-decoration-none">
                                                {{ Str::limit($searchResult->title, 60) }}
                                            </a>
                                        </h5>
                                        <p class="card-text mt-3">{!! Str::limit($searchResult->meta_description, rand(10, 300)) !!}</p>
                                    </div>
                                    <div class="card-footer border-0">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <i class="fa fa-calendar"></i>
                                                {{ \Carbon\Carbon::parse($searchResult->created_at)->format('d F Y, H:i:s') }}
                                            </div>
                                            <div class="col-lg-4 text-end">
                                                <a href="{{ route('posts.show', ['slug' => $searchResult->slug]) }}"
                                                    class="btn btn-sm btn-primary">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{ $search_result->appends(['keywords' => request()->keywords])->links() }}

                </div>

                <div class="col-lg-4">
                    @include('frontend.layouts.sidebar')
                </div>
            </div>
        </div>
    </section>
@endsection
