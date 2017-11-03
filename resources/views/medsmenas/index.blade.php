@extends('layouts.app')

@section('content')

    <div class="container">

        <nav class="navbar navbar-inverse">
            <ul class="nav navbar-nav">
                <li><a href="{{ URL::to('medsmenas') }}">@lang('t.med_smena_view_all')</a></li>
                <li><a href="{{ URL::to('medsmenas/create') }}">@lang('t.med_smena_create')</a>
            </ul>
        </nav>

        <h1>@lang('t.med_smena_view_all')</h1>

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
                <td>@lang('t.med_service')</td>
                <td>@lang('t.started')</td>
                <td>@lang('t.stopped')</td>
                <td>@lang('t.status')</td>
                <td colspan="2">@lang('t.control')</td>
            </tr>
            </thead>

            <tbody>
            @foreach($allSmenas as $smena)
                <tr>
                    <td>{{ $smena->medService->name }}</td>
                    <td>{{ $smena->started }}</td>
                    <td>{{ $smena->stopped }}</td>
                    <td>{{ $smena->status }}</td>

                    <!-- we will also add show, edit, and delete buttons -->
                    <td>
                        <a class="btn btn-small btn-success"
                           href="{{ URL::to('medsmenas/' . $smena->id) }}">@lang('t.med_smena_show')</a>
                    </td>
                    <td>
                        <a class="btn btn-small btn-info"
                           href="{{ URL::to('medsmenas/' . $smena->id . '/edit') }}">@lang('t.med_smena_edit')</a>
                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>
    </div>
@endsection