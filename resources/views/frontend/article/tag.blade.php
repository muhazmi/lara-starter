@extends('frontend.layouts.app-two-columns')

@section('content')
    <h1 class="text-slate-700 dark:text-slate-300">
        {{ $page_title }}
    </h1>

    <span class="inline-block w-40 h-1 bg-green-400 rounded-full"></span>
    <span class="inline-block w-3 h-1 ml-1 bg-green-400 rounded-full"></span>
    <span class="inline-block w-1 h-1 ml-1 bg-green-400 rounded-full"></span>

    <div class="gap-6 py-3 columns-1 md:columns-2 lg:columns-2">
        @if ($article_by_tag->isEmpty())
        <p class="text-slate-700 dark:text-slate-300">{{ __('No Data Yet') }}.</p>
        @else
            @foreach ($article_by_tag as $articleByTag)
                <div class="overflow-hidden bg-white shadow-sm mb-7 break-inside-avoid-column dark:bg-slate-800 rounded-xl">
                    <a href="{{ route('front.article.show', $articleByTag->slug) }}">
                        @if ($articleByTag->photo_thumbnail)
                            <img src="{{ asset('assets/images/article/' . $articleByTag->photo_thumbnail) }}"
                                alt="{{ $articleByTag->title }}" title="{{ $articleByTag->title }}"
                                class="object-cover w-full">
                        @else
                            <img src="{{ asset('assets/images/no-image.jpg') }}" class="object-cover w-full">
                        @endif
                    </a>
                    <div class="p-6">
                        <h2 class="mb-2 text-2xl font-bold">
                            <a href="{{ route('front.article.show', $articleByTag->slug) }}"
                                class="font-bold text-slate-700 dark:text-slate-300 hover:text-green-700">
                                {{ $articleByTag->title }}
                            </a>
                        </h2>

                        @if ($articleByTag->tags->isNotEmpty())
                            @foreach ($articleByTag->tags as $tag)
                                <a href="{{ route('front.article.tags', $tag->slug) }}"
                                    class="inline-block px-3 py-2 text-sm rounded-lg bg-slate-700 text-slate-100 dark:bg-gray-700 dark:text-gray-300">
                                    {{ $tag->name }}
                                </a>
                            @endforeach
                        @endif

                        <p class="py-3 text-slate-700 dark:text-slate-400">
                            {{ Str::limit(strip_tags($articleByTag->description), 150) }}
                        </p>

                        <a href="{{ route('front.article.show', $articleByTag->slug) }}"
                            class="inline-flex items-center px-3 py-2 text-sm text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                            {{ __('Read more') }}
                            <svg class="w-4 h-4 ml-2" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <div class="mb-7">
        {{ $article_by_tag->links() }}
    </div>
@endsection
