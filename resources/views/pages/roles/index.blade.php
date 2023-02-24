<x-app-layout>
    @push('plugin-styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.2/sweetalert2.css" integrity="sha512-us/9of/cEp3FrrmLUpCcWUAzm2gE7EOPnfEAWBMwdWR1Lpxw0orMoVvLyyoGSD9iMGAUlEd8XHzt5+SDwmdGLg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        {!! Html::style('css/pages/sweetalert2.css') !!}
        {!! Html::style('https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css') !!}
    @endpush
    <x-slot name="header">
        <div class="row">
            <div class="order-last col-12 col-md-6 order-md-1">
                <h3>Roles</h3>
            </div>
            <div class="order-first col-12 col-md-6 order-md-2">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Roles</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>


    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <h4 class="col-6">Role List</h4>
                    <div class="col-6 text-end">
                        <button type="button" class="btn btn-primary btn-sm" id="addRole">Tambah Role</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="tableRole">
                        <thead>
                            <tr>
                                <th>
                                    <div class="th-content"> {{__('Nama')}}</div>
                                </th>
                                <th width="20%">
                                    <div class="text-center th-content"> {{__('Action')}}</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalRole" tabindex="-1"  role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true">
            {!! Form::open(['url' => route('roles.store'),'id'=> 'formStoreRole']) !!}
            <input type="hidden" name="status" id="status" value="0">
            <input type="hidden" name="roleId" id="roleId" value="">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalRoleTitle"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="las la-times"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2 form-group">
                            <label class="col-form-label" for="name">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nama Role" value="" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> {{__('Cancel')}}</button>
                        <button type="submit" id="save" class="btn btn-primary">{{__('Save')}}</button>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </section>

    @push('plugin-scripts')
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.2/sweetalert2.min.js" integrity="sha512-jSNGQoIZ0qago6DK45skZbDI1JC8bmANSwItgDnMXiAnJm0Lq6QB4yXY8QPKqS68iR3ngZi0pM5+wZvg1kCCKQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {!! Html::script('https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js') !!}

    @endpush

    @push('custom-scripts')
    <script>
        $(document).ready(function (){
            $('#addRole').on('click',function (){
                $('#status').val(0);
                $('#formStoreRole').trigger('reset');
                $('#roleId').val('');
                $('#modalRole').modal('show');
                $('#modalRoleTitle').html('Tambah Role');
            });
            let table = $('#tableRole').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('roles.list') }}",
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'action', name: 'action',class:'text-center', orderable: false, searchable: false},
                ]
            });

            $('#formStoreRole').submit(function (e) {
                $('#save').prop('disabled',true);
                let formData = $(this);
                e.preventDefault();
                let status = $("#status").val();
                let actionUrl = e.currentTarget.action;
                //do your own request an handle the results
                $.ajax({
                    url: actionUrl,
                    type: 'post',
                    data: formData.serialize(),
                    success: function(response) {
                        if (response.status){
                            toastr.success(response.message);
                            table.ajax.reload();
                            $('#modalRole').modal('hide');
                        }else{
                            toastr.error(response.message)
                        }
                        $('#save').prop('disabled',false);
                    },
                    error: function(jqXHR,error, exception)
                    {
                        toastr.error('Gagal simpan data Role ')
                        $('#save').prop('disabled',false);
                    }
                });
            });


        })

        function view(id){
            let route= '{{route('roles.show','RoleId')}}';
            route= route.replace('RoleId',id);
            $.ajax({
                type: "get",
                url: route,
                success: function (response) {
                    if (response.status) {
                        $('#status').val(1);
                        $('#RoleId').val(response.data.id);
                        $('#description').val(response.data.description);
                        $('#start_date').val(response.data.start_date);
                        $('#end_date').val(response.data.end_date);
                        $('#groupId').val(response.data.groupId).prop('selected',true);
                        $('#modalRoleTitle').html('Edit Role');
                        $('#modalRole').modal('show');
                    } else {
                        toastr.error(response.data.message)
                    }
                },
                error: function (data) {
                    toastify.error(response.data.message)
                    $('.save').removeAttr("disabled");
                }
            });
        }

        function remove(id){
            Swal.fire({
                title: 'Konfirmasi!',
                text: "Anda Yakin AKan Menghapus Data!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal',
                padding: '2em'
            }).then(function (result) {
                if (result.value) {
                    $.ajax({
                        type:"post",
                        data: {"RoleId":id,"_token":"{{csrf_token()}}"},
                        url: "{{route('roles.destroy')}}",
                        success: function (response) {
                            if (response.status) {
                                $('#tableRole').DataTable().ajax.reload()
                                toastr.success(response.message);
                            } else {
                                toastr.error(response.message);
                            }
                        },
                        error: function (data) {
                            toastr.error('Gagal Hapus Role ')
                        }
                    });
                }
            });
        }
    </script>
    @endpush
</x-app-layout>
