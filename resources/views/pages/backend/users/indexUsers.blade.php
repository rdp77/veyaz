@extends('layouts.backend.default')
@section('title', __('pages.title').__(' | Master Pengguna'))
@section('titleContent', __('Pengguna'))
@section('breadcrumb', __('Master'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Pengguna') }}</div>
@endsection

@section('content')
@include('layouts.backend.components.notification')
<div class="card">
    <div class="card-header">
        <a href="{{ route('users.create') }}" class="btn btn-icon icon-left btn-primary">
            <i class="far fa-edit"></i>{{ __(' Tambah Pengguna') }}</a>
    </div>
    <div class="card-body">
        <table class="table-striped table" id="tables" width="100%">
            <thead>
                <tr>
                    <th class="text-center">
                        {{ __('NO') }}
                    </th>
                    <th class="text-center">
                        {{ __('Username') }}
                    </th>
                    <th>{{ __('Nama') }}</th>
                    <th>{{ __('Aksi') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $number => $u)
                <tr>
                    <td class="text-center">
                        {{ $number+1 }}
                    </td>
                    <td class="text-center">
                        {{ $u->username }}
                    </td>
                    <td>
                        {{ $u->name }}
                    </td>
                    <td>
                        <div class="btn-group">
                            <form id="reset{{ $u->id }}" action="{{ route('users.reset',$u->id) }}" method="POST"
                                class="d-inline">
                                @csrf
                                <button
                                    data-confirm="Apakah Anda Yakin?|Aksi ini tidak 
                                dapat dikembalikan dan mengubah password menjadi default yaitu '1234567890'. Apakah ingin melanjutkan?"
                                    data-confirm-yes="document.getElementById('reset{{ $u->id }}').submit();"
                                    class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </form>
                            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                data-toggle="dropdown" aria-expanded="false">
                                <span class="sr-only">{{ __('Toggle Dropdown') }}</span>
                            </button>
                            <div class="dropdown-menu" x-placement="bottom-start"
                                style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(120px, 36px, 0px);">
                                <a class="dropdown-item" href="{{ route('users.edit',$u->id) }}">
                                    {{ __('Edit') }}
                                </a>
                                <form id="del-data{{ $u->id }}" action="{{ route('users.destroy',$u->id) }}"
                                    method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <a class="dropdown-item" style="cursor: pointer" data-confirm="Apakah Anda Yakin?|Aksi ini tidak dapat 
                                        dikembalikan. Apakah ingin melanjutkan?"
                                        data-confirm-yes="document.getElementById('del-data{{ $u->id }}').submit();">
                                        {{ __('Hapus') }}
                                    </a>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection