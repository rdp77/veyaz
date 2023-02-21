<script src="{{ mix('js/app.js') }}"></script>

{{--<script src="{{ asset('/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>--}}
{{--<script src="{{ asset('/extensions/tinymce/tinymce.min.js') }}"></script>--}}


<script src="{{ asset('/js/bootstrap.js') }}"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>

@livewireScripts

{{ $script ?? ''}}
