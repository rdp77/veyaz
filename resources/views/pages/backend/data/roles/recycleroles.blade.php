<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Roles</h3>
                <p class="text-subtitle text-muted">This is List Roles In Recyle.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Roles</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>

    
    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">List Role In Recyle</h4>
                <div>
                    <button type="submit" class="btn btn-md btn-success me-1 mb-1" onclick="window.location='{{ route("roles.index") }}'">
                        View Role
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped role_datatable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Role Name</th>
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
    var table = $('.role_datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('roles.recycle') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'role_name', name: 'role_name'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    var role_id;
    //  Kembalikan
    $(document).on('click', '.restore', function(){
        role_id = $(this).attr('id');
        $('#confirmModalRestore').modal('show');
    });

    $('#ok_buttonRestore').click(function(){
        $.ajax({
            type: 'GET',
            url: 'roles/restore/'+role_id,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            beforeSend:function(){
                $('#ok_buttonRestore').text('Restoring...');
            },
            async: false,
            success:function(data)
            {
                setTimeout(function(){
                    $('#confirmModalRestore').modal('hide');
                    $('.role_datatable').DataTable().ajax.reload();
                    swal.fire("Done!", 'Role Berhasil Dihapus' , "success");
                    $('#ok_buttonRestore').text('Restore');
                }, 2000);
            },
        })
    });

    //  Delete
    $(document).on('click', '.delRecycle', function(){
        role_id = $(this).attr('id');
        $('#confirmModalDelete').modal('show');
    });

    $('#ok_buttonDelete').click(function(){
        $.ajax({
            type: 'delete',
            url: 'roles/delete/'+role_id,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            beforeSend:function(){
                $('#ok_buttonDelete').text('Deleting...');
            },
            async: false,
            success:function(data)
            {
                setTimeout(function(){
                    $('#confirmModalDelete').modal('hide');
                    $('.role_datatable').DataTable().ajax.reload();
                    swal.fire("Done!", 'Role Berhasil Dihapus' , "success");
                    $('#ok_buttonDelete').text('Delete');
                }, 2000);
            },
        })
    });
});
</script>
</x-app-layout>
