@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <form action="{{ route('users.update', encrypt($user->id)) }}" id="form-submit" method="post">
                @csrf
                @method('put')

                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title">
                        <span class="text-muted">Users /</span> Edit
                    </h4>
                </div>
                <div class="card-body">
                    <div class="form-group mb-2" data-filed="name">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control" value="" />
                    </div>

                    <div class="form-group mb-2" data-filed="email">
                        <label for="email">E-Mail</label>
                        <input type="text" name="email" id="email" value="{{ $user->email }}" class="form-control" value="" />
                    </div>

                    <div class="form-group mb-2" data-filed="username">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" value="{{ $user->username }}" class="form-control" value="" />
                    </div>

                    <div class="form-group mb-2" data-filed="password">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" value="" />
                    </div>

                    <div class="form-group mb-2" data-filed="password_confirmation">
                        <label for="password_confirmation">Password Confirm</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" value="" />
                    </div>

                    <div class="form-group mb-2" data-filed="roles">
                        <label for="roles">Choose Roles:</label>
                        <select name="roles[]" id="roles" class="form-select select2" data-placeholder="" multiple>
                            <option></option>
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}" @if(in_array($role->name, $userRole)) selected @endif>{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="card-footer text-end">
                    <a href="{{ route('users.index') }}" class="btn btn-light mx-1">Cancel</a>

                    <div class="btn-group">
                        <button type="submit" data-redirect="back" class="btn btn-primary">
                            <span>Save and back</span>
                        </button>
                        
                        <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="visually-hidden">Toggle Dropdown</span>
                        </button>

                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="javascript:;" data-redirect="back" id="save_back" class="dropdown-item submit-option d-none">
                                <span>Save and back</span>
                            </a>

                            <a href="javascript:;" data-redirect="edit" id="save_edit" class="dropdown-item submit-option">
                                <span>Save and edit this data</span>
                            </a>

                            <a href="javascript:;" data-redirect="new" id="save_new" class="dropdown-item submit-option">
                                <span>Save and create new</span>
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
    <script type="text/javascript">
        $(function() {

            let redirect = $('button[type="submit"]').data('redirect');
            $('.submit-option').on('click', function() {
                redirect = $(this).data('redirect');
                $('#form-submit').submit();
            });

            new AjaxFormSubmitter({
                form: '#form-submit',
                scrollToError: false,
                success: function(response) {
                    if (response.status == "success") {

                        switch (redirect) {
                            case 'new':
                                window.location.href = `{{ route('users.create') }}`;
                                break;
                            case 'edit':
                                window.location.reload();
                                break;
                            default:
                                window.location.href = `{{ route('users.index') }}`;
                                break;
                        }
                    }
                },
                error: function(xhr) { }
            })

            $('.select2').select2({
                theme: 'bootstrap-5'
            });
        });
    </script>
@endpush
