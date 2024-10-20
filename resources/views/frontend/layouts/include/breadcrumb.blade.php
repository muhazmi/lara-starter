<section id="breadcrumb" class="py-3">
    <div class="max-w-screen-xl py-5 mx-auto px-7 lg:px-24">
        <!-- Breadcrumb -->
        <div id="breadcrumb">
            <a href="{{ route('homepage') }}" class="text-slate-600 dark:text-slate-200">
                <i class="fa fa-home"></i>
            </a>

            @if ($module)
                <span class="mx-5 text-slate-500 dark:text-slate-300">
                    /
                </span>
                <span class="text-slate-700 dark:text-slate-400">
                    {{ $module }}
                </span>
            @endif

            @if ($module != $page_title)
                <span class="mx-5 text-slate-500 dark:text-slate-300">
                    /
                </span>

                <a href="{{ url()->full() }}" class="text-blue-700 dark:text-blue-400 hover:underline">
                    {{ $page_title }}
                </a>
            @endif

        </div>
    </div>
</section>
