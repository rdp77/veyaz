@extends('layouts.backend.default')
@section('title', __('pages.title').__(' | Log Aksi'))
@section('titleContent', __('Log Aksi'))

@section('content')
<div class="card">
    <div class="card-body">
        <table class="table-striped table" id="table" width="100%">
            <thead>
                <tr>
                    <th class="text-center">
                        {{ __('NO') }}
                    </th>
                    <th>{{ __('Tanggal') }}</th>
                    <th>{{ __('Keterangan') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($log as $number => $l )
                <tr>
                    <td class="text-center">
                        {{ $number + 1 }}
                    </td>
                    <td>
                        {{ date("d-M-Y", strtotime($l->datetime)) }}
                    </td>
                    <td>
                        {{ $l->info }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection