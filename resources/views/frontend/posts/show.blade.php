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
                    <h1>{{ $posts->title }}</h1>
                    <p>
                        <span class="badge text-bg-primary">
                            <i class="fa fa-calendar"></i>
                            {{ \Carbon\Carbon::parse($posts->created_at)->format('d F Y, H:i:s') }}
                        </span>
                        <span class="badge text-bg-warning">
                            <i class="fa fa-tag"></i> {{ $posts->category->name }}
                        </span>
                        @if ($posts->tags->count() > 0)
                            <span class="badge text-bg-success">
                                <i class="fa fa-tags"></i>
                                {{ implode(', ', $posts->tags->pluck('name')->toArray()) }}
                            </span>
                        @endif

                    </p>

                    <article class="blog-post">
                        <p>
                            @if ($posts->featured_image && Storage::exists('public/images/posts/' . $posts->featured_image))
                                <a href="{{ asset('storage/images/posts/' . $posts->featured_image) }}">
                                    <img src="{{ asset('storage/images/posts/' . $posts->featured_image) }}"
                                        class="card-img-top">
                                </a>
                            @else
                                <img src="{{ asset('storage/images/no-image.jpg') }}" width="50%" class="card-img-top">
                            @endif
                        </p>

                        {!! preg_replace(
                            '/<img(.*?)src=("|\')(.*?)("|\')(.*?)>/i',
                            '<a href="$3"><img$1src=$2$3$4$5 class="img-fluid"></a>',
                            $posts->description,
                        ) !!}

                    </article>

                    @include('frontend.posts.related')
                </div>

                <div class="col-lg-4">
                    @include('frontend.layouts.sidebar')
                </div>
            </div>
        </div>
    </section>
@endsection
