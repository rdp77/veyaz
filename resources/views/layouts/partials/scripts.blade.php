<script src="{{ mix('js/app.js') }}"></script>
{{--<script src="{{ asset('/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>--}}
{{--<script src="{{ asset('/extensions/tinymce/tinymce.min.js') }}"></script>--}}


<script src="{{ asset('/js/bootstrap.js') }}"></script>
@stack('plugin-scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@stack('custom-scripts')

@livewireScripts

{{ $script ?? ''}}
