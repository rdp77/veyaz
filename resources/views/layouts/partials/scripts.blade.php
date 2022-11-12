<script src="{{ mix('js/app.js') }}"></script>

{{--<script src="{{ asset('/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>--}}
{{--<script src="{{ asset('/extensions/tinymce/tinymce.min.js') }}"></script>--}}


<script src="{{ asset('/js/bootstrap.js') }}"></script>

@livewireScripts

{{ $script ?? ''}}
