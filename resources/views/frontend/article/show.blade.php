@extends('frontend.layouts.app-two-columns')

@section('content')
    <h1 class="text-slate-700 dark:text-slate-300">
        {{ $page_title }}
    </h1>

    <div class="mb-5">
        <div class="py-3 space-y-3">
            <span id="meta"
                class="p-3 px-3 py-2 mr-3 text-sm border rounded-lg bg-slate-100 text-slate-700 border-slate-500 dark:bg-gray-700 dark:text-gray-300">
                <i class="mr-1 fa fa-calendar"></i> {{ $detail_article->formatted_created_at }}
            </span>

            @if ($detail_article->tags->isNotEmpty())
                @foreach ($detail_article->tags as $tag)
                    <a id="tags" href="{{ route('front.article.tags', $tag->slug) }}"
                        class="inline-block p-3 px-3 py-2 mb-2 mr-2 text-sm rounded-lg bg-slate-700 text-slate-100 dark:bg-gray-700 dark:text-gray-300">
                        <i class="mr-1 fa fa-tag"></i> {{ $tag->name }}
                    </a>
                @endforeach
            @endif
        </div>

        <div class="mb-6 overflow-hidden bg-white shadow-sm break-inside-avoid-column dark:bg-slate-800 rounded-xl">
            <img src="{{ asset('assets/images/article/' . $detail_article->photo_thumbnail) }}"
                alt="{{ $detail_article->title }}" title="{{ $detail_article->title }}" class="object-cover w-full">

            <div class="p-6">
                <div id="description" class="text-slate-700 dark:text-slate-300">
                    {!! $detail_article->description !!}
                </div>
            </div>
        </div>
    </div>
@endsection
