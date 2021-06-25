<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ url('/') }}">{{ __('pages.title') }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ url('/') }}">{{ __('pages.brand') }}</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">{{ __('Menu Utama') }}</li>
            <li class="{{ Request::route()->getName() == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="fas fa-fire"></i><span>{{ __('pages.dashboard') }}</span>
                </a>
            </li>
            {{-- <li class="{{ Request::route()->getName() == 'admin.dashboard' ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}" class="nav-link"><i
                    class="fas fa-fire"></i><span>{{ __('Dashboard') }}</span></a>
            </li>
            <li class="{{ Request::route()->getName() == 'articles.index' ? 'active' : (
                    Request::route()->getName() == 'articles.create' ? 'active' : (
                        Request::route()->getName() == 'articles.edit' ? 'active' : '')) }}">
                <a href="{{ route('articles.index') }}" class="nav-link">
                    <i class="fas fa-file-contract"></i><span>{{ __('Artikel') }}</span>
                </a>
            </li>
            <li class="{{ Request::route()->getName() == 'users.index' ? 'active' : (
                Request::route()->getName() == 'users.create' ? 'active' : (
                    Request::route()->getName() == 'users.edit' ? 'active' : '')) }}">
                <a href="{{ route('users.index') }}" class="nav-link">
                    <i class="fas fa-users"></i><span>{{ __('Pengguna') }}</span>
                </a>
            </li> --}}
        </ul>
    </aside>
</div>