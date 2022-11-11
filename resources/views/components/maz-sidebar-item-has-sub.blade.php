@props(['active', 'icon', 'name'])

@php
$classes = ($active ?? false)
            ? 'sidebar-item  active'
            : 'sidebar-item';
@endphp

{{-- <li class="sidebar-item has sub">
    <a href="{{ $link }}" class='sidebar-link'>
        <i class="{{ $icon }}"></i>
        <span>{{ $name }}</span>
    </a> --}}
<li
    class="sidebar-item has-sub">
    <a href="#" class='sidebar-link'>
        <i class="{{ $icon }}"></i>
        <span>{{ $name }}</span>
    </a>
    <ul class="submenu ">
        <li class="submenu-item ">
            <a href="component-alert.html">Alert</a>
        </li>
        <li class="submenu-item ">
            <a href="component-badge.html">Badge</a>
        </li>
        <li class="submenu-item ">
            <a href="component-breadcrumb.html">Breadcrumb</a>
        </li>
        <li class="submenu-item ">
            <a href="component-button.html">Button</a>
        </li>
        <li class="submenu-item ">
            <a href="component-card.html">Card</a>
        </li>
        <li class="submenu-item ">
            <a href="component-carousel.html">Carousel</a>
        </li>
        <li class="submenu-item ">
            <a href="component-collapse.html">Collapse</a>
        </li>
        <li class="submenu-item ">
            <a href="component-dropdown.html">Dropdown</a>
        </li>
        <li class="submenu-item ">
            <a href="component-list-group.html">List Group</a>
        </li>
        <li class="submenu-item ">
            <a href="component-modal.html">Modal</a>
        </li>
        <li class="submenu-item ">
            <a href="component-navs.html">Navs</a>
        </li>
        <li class="submenu-item ">
            <a href="component-pagination.html">Pagination</a>
        </li>
        <li class="submenu-item ">
            <a href="component-progress.html">Progress</a>
        </li>
        <li class="submenu-item ">
            <a href="component-spinner.html">Spinner</a>
        </li>
        <li class="submenu-item ">
            <a href="component-toasts.html">Toasts</a>
        </li>
        <li class="submenu-item ">
            <a href="component-tooltip.html">Tooltip</a>
        </li>
    </ul>
</li>