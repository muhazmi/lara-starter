<div class="row py-4">
    <h4>Related Post</h4>
    @foreach ($related_posts as $relatedPosts)
        <div class="col-lg-4 mb-3">
            <div class="card bg-light rounded-4 shadow border-0">
                <a href="{{ route('posts.show', ['slug' => $relatedPosts->slug]) }}">
                    @if ($relatedPosts->featured_image && Storage::exists('public/images/posts/' . $relatedPosts->featured_image))
                        <img src="{{ asset('storage/images/posts/' . $relatedPosts->featured_image) }}"
                            class="card-img-top">
                    @else
                        <img src="{{ asset('storage/images/no-image.jpg') }}" class="card-img-top">
                    @endif
                </a>
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="{{ route('posts.show', ['slug' => $relatedPosts->slug]) }}" class=" text-decoration-none">
                            {{ Str::limit($relatedPosts->title, 20) }}
                        </a>
                    </h5>
                    <p class="card-text mt-3">{!! Str::limit($relatedPosts->description, 50) !!}</p>
                </div>
                <div class="card-footer border-0">
                    <a href="{{ route('posts.show', ['slug' => $relatedPosts->slug]) }}"
                        class="btn btn-primary">Read more</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
