@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h4 class="card-title">Roles</h4>

        <div class="card-actions">
            @if(request()->route()->getName() == 'roles.recycle')
                <a href="javascript:;" class="btn btn-outline-secondary btn-restoreAll">
                    <i class="fa-solid fa-rotate-right me-1"></i>
                    Restore All
                </a>

                <a href="javascript:;" class="btn btn-danger btn-deleteAllPermanent">
                    <i class="fa-solid fa-trash me-1"></i>
                    Clear Trash
                </a>
            @else
                <a href="{{ route('roles.create') }}" class="btn btn-primary">
                    <i class="fa-solid fa-plus me-1"></i>
                    Create New
                </a>
            @endif
        </div>
    </div>
    <div class="card-body">
        <div class="d-block mb-3">
            <a href="{{ route('roles.index') }}" class="{{ request()->route()->getName() == 'roles.index' ? 'text-primary fw-bold' : 'text-muted' }}">All ({{ isset($role_count) ? $role_count : 0 }})</a>
            
            <span class="mx-1 text-light">|</span>

            <a href="{{ route('roles.recycle') }}" class="{{ request()->route()->getName() == 'roles.recycle' ? 'text-primary fw-bold' : 'text-muted'}}">Trash ({{ isset($role_trash_count) ? $role_trash_count : 0 }})</a>
        </div>
        <table class="table datatable"></table>
    </div>
</div>

<form action="" method="POST" id="restore-submit" class="d-none">@csrf</form>
<form action="" method="POST" id="delete-submit" class="d-none">
    @csrf
    @method('delete')
</form>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-bs5/1.13.2/dataTables.bootstrap5.min.css" integrity="sha512-3VQ5YOquRk3XRbF17BuokXD8FKDJNlZmlXN8Ws3oTFRmuw0wLz5Ba4JuKgY2GNzARgTGLW1Bt+Ubzbl4gA5R4w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js" integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-bs5/1.13.2/dataTables.bootstrap5.min.js" integrity="sha512-SfExRKPoCXOgJZjjO5T37PAjzs7EYyLW4iuFpqV4QHp66Hcv/QZtbcD1Mo0WqpJa1gw/G9Mi+AgPkY75rKBjvg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
$(function() {
    $('.datatable').DataTable({
        ajax: {
            url: "{{ request()->route()->getName() == 'roles.recycle' ? route('roles.recycle') : route('roles.index') }}",
            dataSrc: (data) => {
                return data;
            }
        },
        width: "100%",
        processing: true,
        order: [],
        responsive: {
            detail: true,
        },
        displayLength: 10,
        lengthMenu: [5, 10, 25, 50, 75, 100],
        columns: [{
            data: "name",
            title: "Hak Akses"
        }, {
            defaultContent: "",
            orderable: false,
            width: "30px",
            className: "text-end",
            render: (data, type, full, meta) => {
                return (`
                    <div class="d-inline-flex">
                        <a class="pe-1 dropdown-toggle hide-arrow text-primary" data-bs-toggle="dropdown" style="cursor:pointer">
                            <i class="fa-solid fa-ellipsis-vertical"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-end">
                            @if(request()->route()->getName() == 'roles.recycle')
                                @can('role-update')
                                <a href="javascript:;" data-id="${full.id}" class="dropdown-item btn-restore">
                                    <i class="fa-solid fa-rotate-right me-2"></i> Restore
                                </a>
                                @endcan

                                @can('role-delete')
                                <a href="javascript:;" data-id="${full.id}" class="dropdown-item text-danger btn-deletePermanent">
                                    <i class="fa-solid fa-trash me-2"></i> Delete Permanent
                                </a>
                                @endcan
                            @else
                                @can('role-update')
                                <a href="{{ route('roles.index') }}/${full.encryptId}/edit" class="dropdown-item">
                                    <i class="fa-solid fa-pen-to-square me-2"></i> Edit
                                </a>
                                @endcan

                                @can('role-delete')
                                <a href="javascript:;" data-id="${full.id}" class="dropdown-item text-danger btn-delete">
                                    <i class="fa-solid fa-trash me-2"></i> Move to Trash
                                </a>
                                @endcan
                            @endif
                        </div>
                    </div>
                `);
            }
        }]
    });

    $('html,body').on('click', '.btn-delete', function() {
        const id = $(this).data('id');
        confirmAlert({
            title: 'Are you sure?',
            text: 'Data with ID: ' + id + ' will be move to trash!',
            cancelText: 'Cancel',
            confirmText: 'Yes, Move it!',
            then: (result) => {
                if (result.isConfirmed) {
                    $('#delete-submit').attr('action', `{{ route('roles.index') }}/${id}`)
                    $('#delete-submit').submit();
                }
            }
        });
    });

    $('html,body').on('click', '.btn-restore', function() {
        const id = $(this).data('id');
        confirmAlert({
            title: 'Are you sure?',
            text: 'Data with ID: ' + id + ' will be restore!',
            cancelText: 'Cancel',
            confirmText: 'Yes, Restore!',
            then: (result) => {
                if (result.isConfirmed) {
                    $('#restore-submit').attr('action', `{{ url('/temp/roles') }}/${id}/restore`)
                    $('#restore-submit').submit();
                }
            }
        });
    });

    $('html,body').on('click', '.btn-deletePermanent', function() {
        const id = $(this).data('id');
        confirmAlert({
            title: 'Are you sure?',
            text: 'Data with ID: ' + id + ' will be delete permanent!',
            cancelText: 'Cancel',
            confirmText: 'Yes, Delete!',
            then: (result) => {
                if (result.isConfirmed) {
                    $('#delete-submit').attr('action', `{{ url('/temp/roles') }}/${id}/delete-permanent`)
                    $('#delete-submit').submit();
                }
            }
        });
    });

    $('html,body').on('click', '.btn-restoreAll', function() {
        confirmAlert({
            title: 'Are you sure?',
            text: 'You will be restore data.',
            cancelText: 'Cancel',
            confirmText: 'Yes, Restore!',
            then: (result) => {
                if (result.isConfirmed) {
                    $('#restore-submit').attr('action', `{{ route('roles.restoreAll') }}`)
                    $('#restore-submit').submit();
                }
            }
        });
    });

    $('html,body').on('click', '.btn-deleteAllPermanent', function() {
        confirmAlert({
            title: 'Are you sure?',
            text: 'You will delete all permanent',
            cancelText: 'Cancel',
            confirmText: 'Yes, Delete!',
            then: (result) => {
                if (result.isConfirmed) {
                    $('#delete-submit').attr('action', `{{ route('roles.deleteAll') }}`)
                    $('#delete-submit').submit();
                }
            }
        });
    });
});
</script>
@endpush
