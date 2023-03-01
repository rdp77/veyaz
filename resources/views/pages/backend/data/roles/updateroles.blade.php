<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Update Role</h3>
                <p class="text-subtitle text-muted">Update Role</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Update Role</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>

    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Update Role</h4>
            </div>
            <div class="card-body">
                <form method="post" id="role_form" class="form-horizontal">
                    <input type="hidden" name="csrf_token" value="{{ csrf_token() }}">
                    <input type="hidden" id="role_id" name="role_id" value="{{ $role->id }}">
                    <div class="form-group">
                        <label>Role Name : </label>
                        <input type="text" name="role_name" id="name" value="{{ $role->role_name }}" class="form-control" />
                    </div>
                    <button type="submit" class="btn btn-primary float-end mt-2">Update</button>
                </form>
            </div>
        </div>
    </section>

<script type="text/javascript">
  $(document).ready(function(){
        var id = document.getElementById("role_id").value;
        var url = "{{ route('roles.update', [':id']) }}";
        url = url.replace(':id', id);

      $('#role_form').on('submit', function(event){
          event.preventDefault();
          $.ajax({
                type: 'PUT',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: url,
                data: $(this).serialize(),
                dataType: 'json',
                success: function(data) {
                    $('#role_form')[0].reset();
                    swal.fire("Done!", data.data , "success");
                    window.location='{{ route("roles.index") }}';
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
