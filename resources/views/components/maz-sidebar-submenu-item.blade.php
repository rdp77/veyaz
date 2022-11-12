@props(['active', 'link', 'name'])

{{--@php--}}
{{--    $classes = ($active ?? false)--}}
{{--                ? 'sidebar-item  active'--}}
{{--                : 'sidebar-item';--}}
{{--@endphp--}}

<li class="submenu-item ">
    <a href="{{ $link }}">{{ $name }}</a>
</li>
