@extends('layouts.backend.default')
@section('title', __('pages.title').__(' | ').__('pages.history'))
@section('titleContent', __('pages.history'))
@section('breadcrumb', __('Dashboard'))
@section('morebreadcrumb')
<div class="breadcrumb-item active">{{ __('pages.history') }}</div>
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
                    <th>{{ __('Tanggal') }}</th>
                    <th>{{ __('Keterangan') }}</th>
                    <th>{{ __('URL') }}</th>
                    <th>{{ __('IP') }}</th>
                    <th>{{ __('User Agent') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($log as $number => $l )
                <tr>
                    <td class="text-center">
                        {{ $number + 1 }}
                    </td>
                    <td>
                        {{ date("d-M-Y H:m", strtotime($l->added_at)) }}
                    </td>
                    <td>
                        {{ $l->info }}
                    </td>
                    <td>
                        {{ $l->url }}
                    </td>
                    <td>
                        {{ $l->ip }}
                    </td>
                    <td>
                        {{ $l->user_agent }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection