@extends('layouts.app')

@section('content')

    <div class="container">

        <nav class="navbar navbar-inverse">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ URL::to('groups') }}">Group Alert</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="{{ URL::to('groups') }}">View All'groups</a></li>
                <li><a href="{{ URL::to('groups/create') }}">Create a Group</a>
                <li><a href="{{ URL::to('groups/manage') }}">Manage</a>
            </ul>
        </nav>

        <h1>All the'groups</h1>

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
                <td>Name</td>
                <td>Description</td>
                <td colspan="3">Control</td>
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
                        <a class="btn btn-small btn-success" href="{{ URL::to('groups/' . $value->id) }}">Show this Group</a>
                    </td>
                    <td>
                        <a class="btn btn-small btn-info" href="{{ URL::to('groups/' . $value->id . '/edit') }}">Edit this Group</a>
                    </td>
                    <td>
                        {{ Form::open(array('url' => 'groups/' . $value->id, 'class' => 'pull-left', 'onsubmit' => 'return confirmDelete()')) }}
                            {{ Form::hidden('_method', 'DELETE') }}
                            {{ Form::submit('Delete this Group', array('class' => 'btn btn-warning')) }}
                        {{ Form::close() }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>


@endsection