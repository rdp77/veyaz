@extends('layouts.backend.default')
@section('title', __('pages.title').__(' | History '))
@section('titleContent', __('History '))
@section('breadcrumb', __('Menu Utama'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('History') }}</div>
@endsection

@section('content')
<div class="card card-primary">
    <div class="card-body">
        <table class="table-striped table" id="tables" width="100%">
            <thead>
                <tr>
                    <th class="text-center">
                        {{ __('NO') }}
                    </th>
                    <th class="text-center">
                        {{ __('Kode Pelajar') }}
                    </th>
                    <th>{{ __('Tanggal') }}</th>
                    <th>{{ __('Status') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($history as $number => $h)
                <tr>
                    <td class="text-center">
                        {{ $number+1 }}
                    </td>
                    <td class="text-center">
                        {{ $h->code }}
                    </td>
                    <td>
                        {{ date("d-M-Y", strtotime($h->datetime)) }}
                    </td>
                    <td>
                        <span class="badge badge-info">
                            @if ($h->info == 'Dipinjam')
                            {{ __('Barang Dipinjam') }}
                            @elseif ($h->info == 'Dikembalikan')
                            {{ __('Barang Dikembalikan') }}
                            @else
                            {{ __('ERROR') }}
                            @endif
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection