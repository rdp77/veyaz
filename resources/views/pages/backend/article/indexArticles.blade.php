@extends('layouts.backend.default')
@section('title', __('pages.title') . __(' | Artikel'))
@section('titleContent', __('Artikel'))
@section('breadcrumb', __('Menu Utama'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('Artikel') }}</div>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('articles.create') }}" class="btn btn-icon icon-left btn-primary">
            <i class="far fa-edit"></i>{{ __(' Tambah Artikel') }}</a>
    </div>
    <div class="card-body">
        <table class="table-striped table" id="table" width="100%">
            <thead>
                <tr>
                    <th class="text-center">
                        {{ __('NO') }}
                    </th>
                    <th>{{ __('Judul Artikel') }}</th>
                    <th>{{ __('Dibuat Pada') }}</th>
                    <th>{{ __('Diubah Pada') }}</th>
                    <th>{{ __('Kategori') }}</th>
                    <th>{{ __('Aksi') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articles as $number => $a)
                <tr>
                    <td class="text-center">
                        {{ $number + 1 }}
                    </td>
                    <td>{{ $a->title }}</td>
                    <td>{{ $a->created_at }}</td>
                    <td>{{ $a->updated_at }}</td>
                    <td>
                        <span class="badge badge-info">
                            @switch($a->category)
                            @case(1)
                            {{ __('Mobil') }}
                            @break
                            @case(2)
                            {{ __('Wisata Bandung') }}
                            @break
                            @case(3)
                            {{ __('Wisata Banyuwangi') }}
                            @break
                            @case(4)
                            {{ __('Wisata Jogjakarta') }}
                            @break
                            @case(5)
                            {{ __('Wisata Malang') }}
                            @break
                            @case(6)
                            {{ __('Wisata Pacitan') }}
                            @break
                            @case(7)
                            {{ __('Wisata Semarang') }}
                            @break
                            @default
                            {{ __('Tidak Ada') }}
                            @endswitch
                        </span>
                    </td>
                    <td>
                        <form id="del-data{{ $a->id }}" action="{{ route('articles.destroy', $a->id) }}" method="POST"
                            class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-action mb-1 mt-1" data-toggle="tooltip" title="Delete"
                                data-confirm="Apakah Anda Yakin?|Aksi ini tidak dapat dikembalikan. Apakah ingin melanjutkan?"
                                data-confirm-yes="document.getElementById('del-data{{ $a->id }}').submit();"><i
                                    class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('pages/data/division/indexDivision.js') }}"></script>
@endsection