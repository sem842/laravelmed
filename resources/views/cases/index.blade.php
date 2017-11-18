@extends('layouts.patients')

@section('content')

    <!-- will be used to show any messages -->
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
    @if (Session::has('error-message'))
        <div class="alert alert-danger">{{ Session::get('error-message') }}</div>
    @endif

    <div class="container">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <td>@lang('t.talon_id')</td>
                <td>@lang('t.name')</td>
                <td>@lang('t.med_service')</td>
                <td>@lang('t.status')</td>
                <td>@lang('t.control')</td>
            </tr>
            </thead>
            <tbody>
            @foreach($allCases as $value)
                <tr>
                    <td>{{ $value->talon_id }}</td>
                    <td>{{ $value->user->name }}</td>
                    <td>{{ $value->medSmena->medService->name }}</td>
                    <td>{{ $value->status }}</td>
                    <td>
                        <a class="btn btn-small btn-info" href="{{ URL::to('cases/' . $value->id) }}">@lang('t.done')</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>