<x-maz-sidebar :href="route('dashboard')" :logo="asset('images/logo/logo.svg')">

    <x-maz-sidebar-item name="Dashboard" :link="route('dashboard')" icon="bi bi-grid-fill" routeName="dashboard">
    </x-maz-sidebar-item>
    <!-- Add Sidebar Menu Items Here -->
    <li class="sidebar-title">{{ __('Management') }}</li>

    @canany(['user-read', 'role-read', 'permissions'])
    <x-maz-sidebar-submenu name="Authentication" icon="bi bi-grid-fill">
        @can('user-read')
        <x-maz-sidebar-submenu-item name="Users" :link="route('users.index')"></x-maz-sidebar-submenu-item>
        @endcan

        {{-- <x-maz-sidebar-submenu-item name="Teams" :link="route('dashboard')"></x-maz-sidebar-submenu-item> --}}
        
        @can('role-read')
        <x-maz-sidebar-submenu-item name="Roles" :link="route('roles.index')"></x-maz-sidebar-submenu-item>
        @endcan
        
        @can('permissions')
        <x-maz-sidebar-submenu-item name="Permissions" :link="route('permissions.index')"></x-maz-sidebar-submenu-item>
        @endcan
    </x-maz-sidebar-submenu>
    @endcanany

    <li class="sidebar-title">{{ __('Settings') }}</li>
    <x-maz-sidebar-submenu name="General" icon="bi bi-grid-fill">
        <x-maz-sidebar-submenu-item name="General" :link="route('dashboard')"></x-maz-sidebar-submenu-item>
        <x-maz-sidebar-submenu-item name="Appearance" :link="route('dashboard')"></x-maz-sidebar-submenu-item>
        <x-maz-sidebar-submenu-item name="Localization" :link="route('dashboard')"></x-maz-sidebar-submenu-item>
        <x-maz-sidebar-submenu-item name="Customization" :link="route('dashboard')"></x-maz-sidebar-submenu-item>
        <x-maz-sidebar-submenu-item name="Email" :link="route('dashboard')"></x-maz-sidebar-submenu-item>
        <x-maz-sidebar-submenu-item name="Backup" :link="route('dashboard')"></x-maz-sidebar-submenu-item>
    </x-maz-sidebar-submenu>
</x-maz-sidebar>
