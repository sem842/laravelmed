@extends('layouts.app')

@section('content')

    <div class="container">

        <nav class="navbar navbar-inverse">
            <ul class="nav navbar-nav">
                <li><a href="{{ URL::to('groups/create') }}">@lang('t.createGroup')</a>
                <li><a href="{{ URL::to('groups/manage') }}">@lang('t.manage')</a>
            </ul>
        </nav>

        <h1>@lang('t.all_groups')</h1>

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
                <td colspan="3">@lang('t.control')</td>
            </tr>
            </thead>
            <tbody>
            @foreach($groups as $key => $value)
                <tr>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->description }}</td>

                    <!-- we will also add show, edit, and delete buttons -->
                    <td>
                        <a class="btn btn-small btn-success" href="{{ URL::to('groups/' . $value->id) }}">@lang('t.group_show')</a>
                    </td>
                    <td>
                        <a class="btn btn-small btn-info" href="{{ URL::to('groups/' . $value->id . '/edit') }}">@lang('t.group_edit')</a>
                    </td>
                    <td>
                        {{ Form::open(array('url' => 'groups/' . $value->id, 'class' => 'pull-left', 'onsubmit' => 'return confirmDelete()')) }}
                            {{ Form::hidden('_method', 'DELETE') }}
                            {{ Form::submit(Lang::get('t.group_delete'), array('class' => 'btn btn-warning')) }}
                        {{ Form::close() }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>


@endsection