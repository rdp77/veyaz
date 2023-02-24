@extends('layouts.app')

@section('content')
<div class="card">
    <form action="{{ route('roles.update', encrypt($role->id)) }}" id="form-submit" method="post">
        @csrf
        @method('put')

        <div class="card-header d-flex justify-content-between">
            <h4 class="card-title">
                <span class="text-muted">Roles /</span> Create
            </h4>
        </div>
        <div class="card-body">
            <div class="form-group mb-3" data-field="name">
                <label for="name" class="form-label">Role name</label>
                <input type="text" name="name" id="name" value="{{ $role->name }}" class="form-control" />
            </div>

            <div class="form-group table-responsive-md" data-field="permission">
                <label for="permissions" class="form-label">Choose Permissions</label>

                <table class="table">
                    <tbody>
                        <tr>
                            <td><span class="fw-bold d-block w-200px w-lg-250px w-xxl-300px">Akses Administrator</span></td>
                            <td width="100px" colspan="4">
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" class="form-check-input me-1" id="select-all">
                                    <label class="form-check-label" for="select-all">Pilih semua</label>
                                </div>
                            </td>
                        </tr>

                        @foreach ($permissions as $permission)
                            <tr>
                                <td>
                                    <span class="d-block ms-2">
                                        {{ $permission->label }}
                                    </span>
                                </td>
                                <td>
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" class="form-check-input me-1" name="permission[]" id="read-{{ $permission->id }}" value="{{ $permission->id }}" @if (old('permission') && in_array($permission->id, old('permission'))) checked @endif  @if(in_array($permission->id, $rolePermissions)) checked @endif>
                                        <label class="form-check-label" for="read-{{ $permission->id }}">Read</label>
                                    </div>
                                </td>
                                <td>
                                    @if($permission->create)
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" class="form-check-input me-1" name="permission[]" id="create-{{ $permission->id }}" value="{{ $permission->create->id }}" @if (old('permission') && in_array($permission->create->id, old('permission'))) checked @endif  @if(in_array($permission->id, $rolePermissions)) checked @endif>
                                            <label class="form-check-label" for="create-{{ $permission->id }}">Create</label>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    @if($permission->update)
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" class="form-check-input me-1" name="permission[]" id="update-{{ $permission->id }}" value="{{ $permission->update->id }}" @if (old('permission') && in_array($permission->update->id, old('permission'))) checked @endif  @if(in_array($permission->id, $rolePermissions)) checked @endif>
                                            <label class="form-check-label" for="update-{{ $permission->id }}">Update</label>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    @if($permission->delete)
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" class="form-check-input me-1" name="permission[]" id="delete-{{ $permission->id }}" value="{{ $permission->delete->id }}" @if (old('permission') && in_array($permission->delete->id, old('permission'))) checked @endif  @if(in_array($permission->id, $rolePermissions)) checked @endif>
                                            <label class="form-check-label" for="delete-{{ $permission->id }}">Delete</label>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer text-end">
            <a href="{{ route('roles.index') }}" class="btn btn-light mx-1">Cancel</a>

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
@endsection

@push('styles')
@endpush

@push('scripts')
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
                                window.location.href = `{{ route('roles.create') }}`;
                                break;
                            case 'edit':
                                window.location.reload();
                                break;
                            default:
                                window.location.href = `{{ route('roles.index') }}`;
                                break;
                        }
                    }
                },
                error: function(xhr) { }
            })

            $('#select-all').on('change', function() {
                if ($(this).is(":checked")) {
                    $('#form-submit input[type="checkbox"]').prop('checked', true);
                } else {
                    $('#form-submit input[type="checkbox"]').prop('checked', false);
                }
            });
        });
    </script>
@endpush
