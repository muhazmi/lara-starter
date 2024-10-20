<nav class="sticky top-0 z-50 bg-white dark:bg-black" x-data="{ open: false }">
    <div class="max-w-6xl px-5 py-3 mx-auto sm:px-6 lg:px-3">
        <div class="flex justify-between h-18">
            <!-- Logo dan Menu Kiri -->
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center flex-shrink-0">
                    <a href="{{ route('homepage') }}">
                        <img src="{{ asset('assets/images/company/' . $companyInfo->logo) }}" alt="logo"
                            class="w-12 rounded-full">
                    </a>
                </div>
                <!-- Menu -->
                <div class="hidden sm:ml-6 sm:flex sm:space-x-5 ">
                    <a href="{{ route('homepage') }}"
                        class="inline-flex items-center px-1 pt-1 text-sm font-medium hover:text-green-600  dark:hover:text-green-400 {{ request()->routeIs('homepage') ? 'text-green-600 dark:text-green-400' : 'text-slate-600 dark:text-slate-300' }}">
                        Home
                    </a>
                    <a href="{{ route('front.article') }}"
                        class="inline-flex items-center px-1 pt-1 text-sm font-medium  hover:text-green-600 dark:hover:text-green-400 {{ request()->routeIs('front.page.about') ? 'text-green-600 dark:text-green-400' : 'text-slate-600 dark:text-slate-300' }}">
                        {{ __('Article') }}
                    </a>

                    <!-- Dropdown Tag -->
                    <div x-data="{ openTag: false }" class="relative inline-flex items-center" @mouseenter="openTag = true"
                        @mouseleave="openTag = false">
                        <!-- Submenu Type dan Brand -->
                        <div x-show="openTag" x-cloak
                            class="absolute left-0 z-10 w-40 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 top-full">
                            <div class="py-1">
                                <div class="relative">
                                    @foreach ($tags as $tag)
                                        <a href="{{ route('front.article.tags', $tag->slug) }}"
                                            class="block py-2 pl-3 pr-4 text-base font-medium hover:bg-green-700 hover:text-slate-100 dark:hover:bg-green-700 dark:text-slate-300
                                {{ request()->is('product/type/' . $tag->slug) ? 'text-green-600' : 'text-slate-600' }}">
                                            {{ $tag->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tombol CTA dan Menu Hamburger -->
            <div class="flex items-center">
                {{-- dark mode toggle --}}
                <button id="theme-toggle" type="button"
                    class="mr-2 sm:mr-0 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                    <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                    </svg>
                    <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                            fill-rule="evenodd" clip-rule="evenodd"></path>
                    </svg>
                </button>

                <!-- CTA Desktop -->
                <div class="hidden sm:flex sm:items-center">
                    <a href="{{ route('login') }}" target="_blank"
                        class="inline-flex items-center px-3 py-2 ml-6 text-sm font-medium bg-green-600 rounded-md text-slate-100 hover:bg-green-700">
                        {{ __('Login') }}
                    </a>
                </div>
                <!-- Mobile Menu Button -->
                <div class="flex -mr-2 sm:hidden">
                    <button @click="open = !open" type="button"
                        class="inline-flex items-center justify-center p-2 bg-white rounded-md text-slate-400 hover:text-slate-600 hover:bg-slate-100">
                        <span class="sr-only">Open main menu</span>
                        <!-- Icon saat menu ditutup -->
                        <svg class="w-6 h-6" x-bind:class="{ 'hidden': open }" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <!-- Icon saat menu terbuka -->
                        <svg class="w-6 h-6" x-bind:class="{ 'hidden': !open }" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="open" class="sm:hidden" x-cloak>
        <div class="pt-2 pb-3 space-y-1 dark:bg-slate-700">
            <a href="{{ route('homepage') }}"
                class="block py-2 pl-3 pr-4 text-base font-medium hover:bg-green-700 hover:text-slate-100 dark:hover:bg-green-700 dark:text-slate-300
            {{ request()->routeIs('homepage') ? 'text-green-600' : 'text-slate-600' }}">
                Home
            </a>
            <a href="{{ route('front.page.about') }}"
                class="block py-2 pl-3 pr-4 text-base font-medium hover:bg-green-700 hover:text-slate-100 dark:hover:bg-green-700 dark:text-slate-300
            {{ request()->routeIs('front.page.about') ? 'text-green-600' : 'text-slate-600' }}">
                {{ __('About Us') }}
            </a>
            <!-- Dropdown Tag -->
            <div x-data="{ openTagMobile: false }" class="block">
                <button @click="openTagMobile = !openTagMobile"
                    class="flex items-center justify-between w-full py-2 pl-3 pr-4 text-base font-medium text-left hover:bg-green-700 hover:text-slate-100 dark:hover:bg-green-700 dark:text-slate-300
                {{ request()->routeIs('front.product*') ? 'text-green-600' : 'text-slate-600' }}">
                    {{ __('Tag') }}
                    <!-- Ikon Panah Bawah -->
                    <svg class="w-4 h-4 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path x-show="!openTagMobile" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 9l-7 7-7-7" />
                        <path x-show="openTagMobile" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5l7 7-7 7" />
                    </svg>
                </button>
                <!-- Submenu Type dan Brand -->
                <div x-show="openTagMobile" class="pl-6">
                    @foreach ($tags as $tag)
                        <a href="{{ route('front.article.tags', $tag->slug) }}"
                            class="block py-2 pl-3 pr-4 text-base font-medium hover:bg-green-700 hover:text-slate-100 dark:hover:bg-green-700 dark:text-slate-300
                                {{ request()->is('product/type/' . $tag->slug) ? 'text-green-600' : 'text-slate-600' }}">
                            {{ $tag->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- CTA Mobile -->
        <div class="border-t border-slate-200">
            <a href="{{ route('login') }}"
                class="flex items-center px-4 py-3 text-base font-medium bg-green-600 dark:bg-slate-700 text-slate-100 hover:bg-green-700 dark:hover:bg-green-700">
                {{ __('Login') }}
            </a>
        </div>
    </div>
</nav>
