<header class="p-3 mb-3 border-bottom sticky-top bg-white">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a class="navbar-brand" href="{{ route('home.index') }}">{{ config('app.name') }}</a>

            <ul class="nav col-12 col-lg-auto mx-3 me-lg-auto mb-2 justify-content-center mb-md-0">
                <li>
                    <a class="nav-link {{ url()->current() == url('') ? 'link-primary' : 'link-secondary' }} px-2"
                        href="{{ route('home.index') }}">Home</a>
                </li>
                <li>
                    <a class="nav-link {{ request()->segment(1) == 'posts' && request()->segment(2) != 'category' ? 'link-primary' : 'link-secondary' }} px-2"
                        href="{{ route('posts.index') }}">Blog</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->segment(2) == 'category' ? 'link-primary' : 'link-secondary' }}"
                        href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Category
                    </a>
                    <ul class="dropdown-menu">
                        @foreach ($categories as $category)
                            <li>
                                <a class="dropdown-item {{ request()->segment(3) == $category->slug ? 'link-primary' : 'link-secondary' }}"
                                    href="{{ route('posts.category', $category->slug) }}">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>

            </ul>

            <form action="{{ route('posts.search') }}" method="get" class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                @csrf
                <div class="input-group">
                    <input type="text" name="keywords" id="keywords" class="form-control"
                        placeholder="Search post by keywords or description" size="35">
                    <button type="submit" class="btn btn-success btn-md"><i class="fa fa-search"></i> Search</button>
                </div>
            </form>

            @if (Auth::check())
                @if (auth()->user()->hasRole('author'))
                    <div class="dropdown text-end">
                        <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            @if (Storage::exists('public/images/users/' . auth()->user()->profile_image))
                                <img src="{{ Storage::url('images/users/' . auth()->user()->profile_image) }}"
                                    width="32" height="32">
                            @else
                                <img src="{{ asset('storage/images/default-user.png') }}" class="rounded-circle">
                            @endif
                        </a>
                        <ul class="dropdown-menu text-small" style="">
                            <li><a class="dropdown-item" href="{{ route('author.dashboard') }}">Dashboard</a></li>
                            <li><a class="dropdown-item" href="{{ route('author.posts') }}">My Posts</a></li>
                            <li><a class="dropdown-item" href="{{ route('author.profile') }}">Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <form method="POST" style="display:inline;" action="{{ route('logout') }}">
                                @csrf
                                <li>
                                    <a href="{{ route('logout') }}" class="dropdown-item"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        Logout
                                    </a>
                                </li>
                            </form>
                        </ul>
                    </div>
                @elseif(auth()->user()->hasRole('admin'))
                    <div class="text-end">
                        <a href="{{ route('dashboard.index') }}" class="btn btn-primary me-2">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </div>
                @endif
            @else
                <div class="text-end">
                    <a href="{{ route('login') }}" class="btn btn-primary me-2"><i class="fa fa-sign-in"></i> Login</a>
                </div>
            @endif
        </div>
    </div>
</header>
