<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Update User</h3>
                <p class="text-subtitle text-muted">Update User</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Update User</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>

    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Update User</h4>
            </div>
            <div class="card-body">
                <form method="post" id="user_form" class="form-horizontal">
                    <input type="hidden" name="csrf_token" value="{{ csrf_token() }}">
                    <input type="hidden" id="user_id" name="user_id" value="{{ $user->id }}">
                    <div class="form-group">
                        <label>Name : </label>
                        <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control" />
                    </div>
                    <div class="form-group">
                        {!! Form::label('role', 'Role') !!}
                        {!! Form::select('role', $roles, $user->role_id, ['class' => 'form-control', 'placeholder' => 'Select a role', 'selected' => $user->role_id]) !!}
                    </div>
                    <div class="form-group">
                        <label>Username : </label>
                        <input type="text" name="username" id="name" value="{{ $user->username }}" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Email : </label>
                        <input type="email" name="email" id="email" value="{{ $user->email }}" class="form-control" />
                    </div>
                    <button type="submit" class="btn btn-primary float-end mt-2">Update</button>
                </form>
            </div>
        </div>
    </section>

<script type="text/javascript">
  $(document).ready(function(){
        var id = document.getElementById("user_id").value;
        var url = "{{ route('users.update', [':id']) }}";
        url = url.replace(':id', id);

      $('#user_form').on('submit', function(event){
          event.preventDefault();
          $.ajax({
                type: 'PUT',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: url,
                data: $(this).serialize(),
                dataType: 'json',
                success: function(data) {
                    $('#user_form')[0].reset();
                    swal.fire("Done!", data.data , "success");
                    window.location='{{ route("users.index") }}';
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
