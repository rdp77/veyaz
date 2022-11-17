@props(['icon', 'name', 'routeName'])

@php
//    $routeName = [
//        'users' =>[
//            'users.index',
//            'users.create',
//            'users.edit',
//            'users.show',
//        ],];
//    logger($routeName);
@endphp

<li
    class="sidebar-item has-sub ">
    <a href="javascript:void(0)" class='sidebar-link'>
        <i class="{{ $icon }}"></i>
        <span>{{ $name }}</span>
    </a>
    <ul class="submenu ">
        {{ $slot ?? '' }}
    </ul>
</li>
