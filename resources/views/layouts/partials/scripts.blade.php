<script src="{{ mix('js/app.js') }}"></script>

{{--<script src="{{ asset('/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>--}}
{{--<script src="{{ asset('/extensions/tinymce/tinymce.min.js') }}"></script>--}}


<script src="{{ asset('/js/bootstrap.js') }}"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

@livewireScripts

{{ $script ?? ''}}
