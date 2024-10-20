<section id="latest-article" class="bg-slate-50 dark:bg-gray-900">
    <div class="py-12 sm:py-3">
        <div class="mx-auto px-7 py-7 max-w-7xl">
            <div class="max-w-2xl p-3 mx-auto lg:text-center">
                <h1 class="text-slate-700 dark:text-gray-300">{{ __('Latest Article') }}</h1>
            </div>

            <!-- Cards Container -->
            <div class="gap-6 columns-1 md:columns-3 lg:columns-3 py-7">
                @foreach ($latest_articles as $allArticles)
                    <div
                        class="mb-3 overflow-hidden bg-white shadow break-inside-avoid-column dark:bg-gray-800 rounded-xl">
                        <div class="p-6">
                            <h2 class="mb-2 text-2xl font-bold">
                                <a href="{{ route('front.article.show', $allArticles->slug) }}"
                                    class="font-bold text-slate-700 dark:text-white">
                                    {{ Str::limit($allArticles->title, 50) }}
                                </a>
                            </h2>

                            <div class="mb-3">
                                @if ($allArticles->tags->isNotEmpty())
                                    @foreach ($allArticles->tags as $tag)
                                        <a href="{{ route('front.article.tags', $tag->slug) }}"
                                            class="inline-block px-3 py-2 mb-3 text-sm rounded-lg bg-slate-100 text-slate-700 dark:bg-gray-700 dark:text-gray-300">
                                            {{ $tag->name }}
                                        </a>
                                    @endforeach
                                @endif
                            </div>

                            <p class="mb-5 text-slate-700 dark:text-gray-300">
                                {{ Str::limit(strip_tags($allArticles->description), 150) }}
                            </p>

                            <a href="{{ route('front.article.show', $allArticles->slug) }}"
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
            </div>

            <!-- Button All Articles -->
            <div class="mt-8 text-center">
                <a href="{{ route('front.article') }}"
                    class="inline-block px-5 py-3 text-white bg-green-600 rounded-lg hover:bg-green-700 focus:outline-none focus:ring-4 focus:ring-green-300 dark:focus:ring-green-800">
                    {{ __('All Articles') }}
                </a>
            </div>
        </div>
    </div>
</section>
