<div class="w-full lg:w-1/3">
    <div class="space-y-6 mt-7">
        {{-- search form --}}
        <form class="max-w-md mx-auto" action="{{ route('front.article.search') }}" method="get">
            <div class="relative">
                <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="search" name="keywords" id="default-search" maxlength="100"
                    class="block w-full p-4 text-sm text-gray-900 border border-gray-300 rounded-lg ps-10 bg-gray-50 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                    requigreen />
                <button type="submit"
                    class="text-white absolute end-2.5 bottom-2.5 bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">{{ __('Search Article') }}</button>
            </div>
        </form>

        <!-- Latest Articles -->
        <div class="p-6 bg-white shadow-lg dark:bg-gray-800 rounded-xl">
            <div class="mb-0 text-2xl font-semibold text-slate-700 dark:text-slate-300">{{ __('Latest Article') }}</div>

            <span class="inline-block w-40 h-1 bg-green-600 rounded-full"></span>
            <span class="inline-block w-3 h-1 ml-1 bg-green-600 rounded-full"></span>
            <span class="inline-block w-1 h-1 ml-1 bg-green-600 rounded-full"></span>

            <div class="mt-5 no-list-style">
                <ul class="space-y-2">
                    @foreach ($sidebar_recent_articles as $recentArticles)
                        <li>
                            <a href="{{ route('front.article.show', $recentArticles->slug) }}"
                                class="text-slate-700 hover:text-green-600 dark:text-slate-400">{{ $recentArticles->title }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Popular Articles -->
        <div class="p-6 bg-white shadow-lg dark:bg-gray-800 rounded-xl">
            <div class="text-2xl font-semibold text-slate-700 dark:text-slate-300">{{ __('Popular Article') }}</div>

            <span class="inline-block w-40 h-1 bg-green-600 rounded-full"></span>
            <span class="inline-block w-3 h-1 ml-1 bg-green-600 rounded-full"></span>
            <span class="inline-block w-1 h-1 ml-1 bg-green-600 rounded-full"></span>

            <div class="mt-5 no-list-style">
                <ul class="space-y-2">
                    @foreach ($sidebar_popular_articles as $popularArticles)
                        <li>
                            <a href="{{ route('front.article.show', $popularArticles->slug) }}"
                                class="text-slate-700 hover:text-green-600 dark:text-slate-400">{{ $popularArticles->title }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Tags -->
        <div class="p-6 space-y-2 bg-white shadow-lg dark:bg-gray-800 rounded-xl">
            <h2 class="text-2xl font-semibold text-slate-700 dark:text-slate-300">Tags</h2>

            <span class="inline-block w-40 h-1 bg-green-600 rounded-full"></span>
            <span class="inline-block w-3 h-1 ml-1 bg-green-600 rounded-full"></span>
            <span class="inline-block w-1 h-1 ml-1 bg-green-600 rounded-full"></span>

            <div class="space-y-3">
                @foreach ($tags as $tagsSidebar)
                    <!-- Pastikan $tag benar-benar ada -->
                    <a href="{{ route('front.article.tags', $tagsSidebar->slug) }}"
                        class="inline-block px-3 py-2 rounded-lg bg-slate-700 text-slate-100 dark:bg-gray-700 dark:text-gray-300">
                        {{ $tagsSidebar->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
