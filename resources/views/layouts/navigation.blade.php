@php
    use App\Helpers\NavigationHelper;
@endphp

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                @if (auth()->user()->profile_image)
                    <img src="{{ Storage::url('images/users/' . auth()->user()->profile_image) }}"
                        class="user-image img-circle elevation-1" alt="User Image">
                @else
                    <img src="{{ asset('storage/images/default-users.png') }}" class="user-image img-circle elevation-1"
                        alt="User Image">
                @endif
                <div class="d-none d-md-inline position-relative">
                    <span>{{ auth()->user()->name }}</span>
                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <li class="user-header text-bold">
                    <div class="row">
                        <div class="col">
                            @if (auth()->user()->profile_image != null)
                                <img src="{{ Storage::url('images/users/' . auth()->user()->profile_image) }}"
                                    class="img-fluid img-circle elevation-1" style="width:50%" alt="User Image">
                            @else
                                <img src="{{ asset('images/default-users.jpg') }}"
                                    class="img-fluid img-circle elevation-1" style="width:50%" alt="User Image">
                            @endif
                        </div>
                    </div>
                    <p>
                        {{ auth()->user()->name }}
                    </p>
                </li>

                <li class="user-footer">
                    <div class="row">
                        <div class="col-12">
                            <div class="btn-block">
                                <a href="{{ route('profile.edit', auth()->user()->id) }}"
                                    class="btn btn-block btn-warning">
                                    <i class="fas fa-user-edit"></i> Edit Profil
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <form method="POST" style="display:inline;" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" class="nav-link"
                    onclick="event.preventDefault(); this.closest('form').submit();">
                    <i class="mr-2 fas fa-power-off text-danger"></i>
                </a>
            </form>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-info elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard.index') }}" class="brand-link">
        <img src="{{ asset('storage/images/app-logo.png') }}" alt="{{ config('app.name') }}"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2 mb-5">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('home.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-globe"></i>
                        <p>Homepage</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard.index') }}"
                        class="nav-link {{ request()->segment(2) == 'dashboard' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                @foreach (NavigationHelper::getMainMenu() as $mainMenu)
                    @can('index ' . $mainMenu->url)
                        <li
                            class="nav-item {{ request()->segment(2) == Str::after($mainMenu->url, 'admin/') ? 'menu-open' : '' }}">
                            <a href="{{ url('/' . $mainMenu->url) }}"
                                class="nav-link {{ request()->segment(2) == Str::after($mainMenu->url, 'admin/') ? 'active' : '' }}">
                                <i class="nav-icon {{ $mainMenu->icon }}"></i>
                                <p>{{ $mainMenu->name }}</p>

                                @if ($mainMenu->subMenus->isNotEmpty())
                                    <i class="right fas fa-angle-left"></i>
                                @endif
                            </a>

                            @if ($mainMenu->subMenus->isNotEmpty())
                                <ul class="nav nav-treeview">
                                    @foreach ($mainMenu->subMenus as $submenu)
                                        <li class="nav-item">
                                            <a href="{{ url('/' . $submenu->url) }}" class="nav-link {{ url()->current() == url('/' . $submenu->url) ? 'active' : '' }}">
                                                <i class="{{ $submenu->icon }}"></i>
                                                <p>{{ $submenu->name }}</p>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endcan
                @endforeach
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
