<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Add Role</h3>
                <p class="text-subtitle text-muted">Create New Role</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Add Role</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>

    
    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Add Role</h4>
            </div>
            <div class="card-body">
                <form method="post" id="role_form" class="form-horizontal">
                    <div class="form-group">
                        <label>Role Name : </label>
                        <input type="text" name="role_name" id="role_name" class="form-control" />
                    </div>
                    
                    <button type="submit" class="btn btn-primary float-end mt-2">Save</button>
                </form>
            </div>
        </div>
    </section>

<script type="text/javascript">
  $(document).ready(function(){
        $('#role_form').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                type: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{ route('roles.store') }}",
                data: $(this).serialize(),
                dataType: 'json',
                success: function(data) {
                    $('#role_form')[0].reset();
                    swal.fire("Done!", data.data , "success");
                },
                error: function(data) {
                    var errors = data.responseJSON;
                    console.log(errors);
                }
            });
        });
  });
</script>
</x-app-layout>
