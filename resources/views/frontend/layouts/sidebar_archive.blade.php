<h4>Archives</h4>
<ol class="list-unstyled mb-3">
    @if ($monthly_post_archive)
        @foreach ($monthly_post_archive as $postGroup)
            <a href="{{ route('posts.archive', ['month' => $postGroup->month, 'year' => $postGroup->year]) }}">
                {{ date('F Y', mktime(0, 0, 0, $postGroup->month, 1, $postGroup->year)) }}
            </a>
            <br>
        @endforeach
    @endif
</ol>
