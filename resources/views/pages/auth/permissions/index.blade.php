@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Permissions</h4>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th width="50%">Name</th>
                    <th width="12.5%" class="text-center">Read</th>
                    <th width="12.5%" class="text-center">Create</th>
                    <th width="12.5%" class="text-center">Update</th>
                    <th width="12.5%" class="text-center">Delete</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($permissions as $permission)
                    <tr>
                        <td>
                            <span class="ms-md-2">
                                <i class="fa fa-angle-right"></i>
                                {{ $permission->label }}
                            </span>
                        </td>
                        <td class="text-center"><span data-feather="check"></span></td>
                        <td class="text-center">
                            @if ($permission->create)
                                <span data-feather="check"></span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if ($permission->update)
                                <span data-feather="check"></span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if ($permission->delete)
                                <span data-feather="check"></span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection