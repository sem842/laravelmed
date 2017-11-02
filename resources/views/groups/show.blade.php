@extends('layouts.app')

@section('content')

    <div class="container">

        <nav class="navbar navbar-inverse">
            <ul class="nav navbar-nav">
                <li><a href="{{ URL::to('groups/create') }}">@lang('t.group_create')</a>
                <li><a href="{{ URL::to('groups/manage') }}">@lang('t.manage')</a>
            </ul>
        </nav>

        <h1>@lang('t.groups_all')</h1>

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
                <td>ID</td>
                <td>@lang('t.name')</td>
                <td>@lang('t.description')</td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{ $group->id }}</td>
                <td>{{ $group->name }}</td>
                <td>{{ $group->description }}</td>
            </tr>
            </tbody>
        </table>

    </div>

@endsection