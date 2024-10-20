@extends('frontend.layouts.app-two-columns')

@section('content')
    <h1 class="mx-auto text-5xl font-bold mt-7">{{ $page_title }}</h1>

    <div class="gap-6 columns-1 md:columns-2 lg:columns-2 py-7">
        @if ($search_results->isEmpty())
            <p>Belum ada artikel.</p>
        @else
            @foreach ($search_results as $searchResult)
                <div class="mb-3 overflow-hidden bg-white shadow-sm break-inside-avoid-column dark:bg-gray-800 rounded-xl">
                    <a href="{{ route('front.article.show', $searchResult->slug) }}">
                        <img src="{{ asset('assets/images/article/' . $searchResult->photo_thumbnail) }}"
                            alt="{{ $searchResult->title }}" title="{{ $searchResult->title }}" class="object-cover w-full">
                    </a>
                    <div class="p-6">
                        <h2 class="mb-2 text-2xl font-bold">
                            <a href="{{ route('front.article.show', $searchResult->slug) }}"
                                class="font-bold text-slate-700 dark:text-white hover:text-green-700">
                                {{ $searchResult->title }}
                            </a>
                        </h2>

                        <div class="mb-3 space-y-3">
                            @if ($searchResult->tags->isNotEmpty())
                                @foreach ($searchResult->tags as $tag)
                                    <a href="{{ route('front.article.tags', $tag->slug) }}"
                                        class="inline-block px-3 py-2 text-sm rounded-lg bg-slate-700 text-slate-100 dark:bg-gray-700 dark:text-gray-300">
                                        {{ $tag->name }}
                                    </a>
                                @endforeach
                            @endif
                        </div>

                        <p class="mt-5 mb-5">
                            {{ Str::limit(strip_tags($searchResult->description), 150) }}
                        </p>

                        <a href="{{ route('front.article.show', $searchResult->slug) }}" class="inline-flex items-center px-3 py-2 text-sm text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                            {{ __('Read more') }}
                            <svg class="w-4 h-4 ml-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </a>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
