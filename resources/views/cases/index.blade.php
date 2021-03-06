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
                <td>@lang('t.id')</td>
                <td>@lang('t.name')</td>
                <td>@lang('t.med_service')</td>
                <td>@lang('t.status')</td>
                <td colspan="2">@lang('t.control')</td>
            </tr>
            </thead>
            <tbody>
            @foreach($allCases as $value)
                <tr>
                    <td>{{ $value->talon->id }}</td>
                    <td>{{ $value->talon->name }}</td>
                    <td>{{ $value->medSmena->medService->name }}</td>
                    <td>{{ $value->status }}</td>
                    <td>
                        <a class="btn btn-small btn-info" href="{{ URL::to('cases/' . $value->id . '/open') }}">@lang('t.open')</a>
                    </td>
                    <td>
                        <a class="btn btn-small btn-success" href="{{ URL::to('cases/' . $value->id . '/close') }}">@lang('t.close')</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>