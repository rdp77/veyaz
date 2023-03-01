<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Users</h3>
                <p class="text-subtitle text-muted">This is List Users In Recyle.</p>
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
                <h4 class="card-title">List User In Recyle</h4>
                <div>
                    <button type="submit" class="btn btn-md btn-success me-1 mb-1" onclick="window.location='{{ route("users.index") }}'">
                        View User
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
                            <th width="100px">Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- restore -->
    <div class="modal fade show" id="confirmModalRestore" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="post" id="delete_form" class="form-horizontal">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalLabel">Confirmation</h5>
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" aria-label="Close">x</button>
                    </div>
                    <div class="modal-body">
                        <h4 align="center" style="margin:0;">Are you sure you want to Restore this data?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" name="ok_buttonRestore" id="ok_buttonRestore" class="btn btn-danger">OK</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- delete -->
    <div class="modal fade show" id="confirmModalDelete" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
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
                        <button type="button" name="ok_buttonDelete" id="ok_buttonDelete" class="btn btn-danger">OK</button>
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
        ajax: "{{ route('users.recycle') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    var user_id;
    //  Kembalikan
    $(document).on('click', '.restore', function(){
        user_id = $(this).attr('id');
        $('#confirmModalRestore').modal('show');
    });

    $('#ok_buttonRestore').click(function(){
        $.ajax({
            type: 'GET',
            url: 'users/restore/'+user_id,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            beforeSend:function(){
                $('#ok_buttonRestore').text('Restoring...');
            },
            async: false,
            success:function(data)
            {
                setTimeout(function(){
                    $('#confirmModalRestore').modal('hide');
                    $('.user_datatable').DataTable().ajax.reload();
                    swal.fire("Done!", 'User Berhasil Dihapus' , "success");
                    $('#ok_buttonRestore').text('Restore');
                }, 2000);
            },
        })
    });

    //  Delete
    $(document).on('click', '.delRecycle', function(){
        user_id = $(this).attr('id');
        $('#confirmModalDelete').modal('show');
    });

    $('#ok_buttonDelete').click(function(){
        $.ajax({
            type: 'delete',
            url: 'users/delete/'+user_id,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            beforeSend:function(){
                $('#ok_buttonDelete').text('Deleting...');
            },
            async: false,
            success:function(data)
            {
                setTimeout(function(){
                    $('#confirmModalDelete').modal('hide');
                    $('.user_datatable').DataTable().ajax.reload();
                    swal.fire("Done!", 'User Berhasil Dihapus' , "success");
                    $('#ok_buttonDelete').text('Delete');
                }, 2000);
            },
        })
    });
});
</script>
</x-app-layout>
