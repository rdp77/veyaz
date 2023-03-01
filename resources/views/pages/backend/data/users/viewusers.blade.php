<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Users</h3>
                <p class="text-subtitle text-muted">This is List Users.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Users</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>

    
    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">List User</h4>
                <div>
                    <button type="submit" class="btn btn-md btn-danger me-1 mb-1" onclick="window.location='{{ route("users.recycle") }}'">
                        View Trash
                    </button>
                    <button type="submit" class="btn btn-md btn-primary me-1 mb-1" onclick="window.location='{{ route("users.create") }}'">
                        Add User
                    </button>
                </div>
            </div>
            
            <div class="card-body">
                <table class="table table-bordered table-striped user_datatable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            @if (Auth::user()->role->role_name == 'Admin')
                                <th>Password</th>
                            @endif
                            <th width="100px">Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </section>
    <div class="modal fade show" id="confirmModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="post" id="delete_form" class="form-horizontal">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalLabel">Confirmation</h5>
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" aria-label="Close">x</button>
                    </div>
                    <div class="modal-body">
                        <h4 align="center" style="margin:0;">Are you sure you want to remove this data?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade show" id="confirmModalReset" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="post" id="delete_form" class="form-horizontal">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalLabel">Confirmation</h5>
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" aria-label="Close">x</button>
                    </div>
                    <div class="modal-body">
                        <h4 align="center" style="margin:0;">Are you sure you want to reset this data?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" name="ok_buttonReset" id="ok_buttonReset" class="btn btn-danger">OK</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script type="text/javascript">
$(document).ready(function(){
    var table = $('.user_datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('users.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'role.role_name', name: 'role_name'},
            @if (Auth::check() && Auth::user()->role->role_name == 'Admin')
                {
                    data: 'password',
                    name: 'password',
                    render: function (data, type, row, meta) {
                         return '******';
                    }
                },
            @endif
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    var user_id;
    //  delete
    $(document).on('click', '.delete', function(){
        user_id = $(this).attr('id');
        $('#confirmModal').modal('show');
    });

    $('#ok_button').click(function(){
        var url = "{{ route('users.destroy', [':id']) }}";
        url = url.replace(':id', user_id);
        $.ajax({
            type: 'delete',
            url: url,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            beforeSend:function(){
                $('#ok_button').text('Deleting...');
            },
            async: false,
            success:function(data)
            {
                setTimeout(function(){
                    $('#confirmModal').modal('hide');
                    $('.user_datatable').DataTable().ajax.reload();
                    swal.fire("Done!", 'User Berhasil Dihapus' , "success");
                    $('#ok_button').text('Delete');
                }, 2000);
            },
           
        })
    });

    //  delete
    $(document).on('click', '.reset', function(){
        user_id = $(this).attr('id');
        $('#confirmModalReset').modal('show');
    });

    $('#ok_buttonReset').click(function(){
        var url = "{{ route('users.reset', [':id']) }}";
        url = url.replace(':id', user_id);
        $.ajax({
            type: 'POST',
            url: url,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            beforeSend:function(){
                $('#ok_buttonReset').text('Reseting...');
            },
            async: false,
            success:function(data)
            {
                setTimeout(function(){
                    $('#confirmModalReset').modal('hide');
                    $('.user_datatable').DataTable().ajax.reload();
                    swal.fire("Done!", data.data , "success");
                    $('#ok_buttonReset').text('Delete');
                }, 2000);
            },
           
        })
    });
});
</script>
</x-app-layout>
