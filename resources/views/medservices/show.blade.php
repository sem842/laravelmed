@extends('layouts.app')

@section('content')

    <div class="container">

        <nav class="navbar navbar-inverse">
            <ul class="nav navbar-nav">
                <li><a href="{{ URL::to('medservices') }}">@lang('t.med_services_all')</a></li>
                <li><a href="{{ URL::to('medservices/create') }}">@lang('t.med_services_create')</a>
            </ul>
        </nav>

        <h1>@lang('t.med_services_all')</h1>

        <!-- will be used to show any messages -->
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        @if (Session::has('error-message'))
            <div class="alert alert-danger">{{ Session::get('error-message') }}</div>
        @endif

        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <td>@lang('t.id')</td>
                <td>@lang('t.name')</td>
                <td>@lang('t.group')</td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{ $medService->id }}</td>
                <td>{{ $medService->name }}</td>
                <td>{{ $medService->group->description }}</td>
            </tbody>
        </table>
    </div>

@endsection