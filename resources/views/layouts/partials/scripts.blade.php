<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.all.min.js"></script>

<script src="{{ mix('js/app.js') }}"></script>

{{--<script src="{{ asset('/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>--}}
{{--<script src="{{ asset('/extensions/tinymce/tinymce.min.js') }}"></script>--}}


<script src="{{ asset('/js/bootstrap.js') }}"></script>
<script src="{{ asset('/ajax-form-submitter.js') }}"></script>
<script src="{{ asset('/scripts.js') }}"></script>

@livewireScripts

{{ $script ?? ''}}

@stack('scripts')
