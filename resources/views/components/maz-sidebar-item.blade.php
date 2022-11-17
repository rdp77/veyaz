@props(['icon', 'link', 'name', 'routeName'])
@php
    $isActive = \App\Helpers\SidebarHelper::setActive($routeName);
@endphp

<li @class(['sidebar-item',$isActive])>
    <a href="{{ $link }}" class='sidebar-link'>
        <i class="{{ $icon }}"></i>
        <span>{{ $name }}</span>
    </a>
</li>
