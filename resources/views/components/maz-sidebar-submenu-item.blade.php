@props(['link', 'name'])
@aware(['routeName'])

@php
//    $classes = ($active ?? false)
//                ? 'sidebar-item  active'
//                : 'sidebar-item';\
@endphp

<li class="submenu-item ">
    <a href="{{ $link }}">{{ $name }}</a>
</li>
