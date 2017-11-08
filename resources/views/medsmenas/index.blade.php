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

        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            @foreach($allSmenas as $key => $smena)
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="{{ "heading" . $key }}">
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="{{ "#collapse" . $key }}" aria-expanded="{{ ($key === 0) ? "true" : "false" }}" aria-controls="{{ "collapse" . $key }}">
                            {{ $smena->medService->name }}
                        </a>
                    </h4>
                </div>
                <div id="{{ "collapse" . $key }}" class="panel-collapse collapse {{ ($key === 0) ? "in" : false }}" role="tabpanel" aria-labelledby="{{ "heading" . $key }}">
                    <div class="panel-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <td>@lang('t.started')</td>
                                <td>@lang('t.stopped')</td>
                                <td>@lang('t.status')</td>
                                <td colspan="2">@lang('t.control')</td>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $smena->started }}</td>
                                    <td>{{ $smena->stopped }}</td>
                                    <td>{{ $smena->status }}</td>

                                    <td>
                                        <a class="btn btn-small btn-success"
                                           href="{{ URL::to('medsmenas/' . $smena->id) }}">@lang('t.med_smena_show')</a>
                                    </td>
                                    <td>
                                        <a class="btn btn-small btn-info"
                                           href="{{ URL::to('medsmenas/' . $smena->id . '/edit') }}">@lang('t.med_smena_edit')</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endforeach
    </div>
@endsection