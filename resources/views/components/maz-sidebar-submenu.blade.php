@props(['active', 'icon', 'name'])

{{--@php--}}
{{--    $classes = ($active ?? false)--}}
{{--                ? 'sidebar-item  active'--}}
{{--                : 'sidebar-item';--}}
{{--@endphp--}}

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
