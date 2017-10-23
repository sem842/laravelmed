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

        <h1>Create a Group</h1>

        <!-- if there are creation errors, they will show here -->
        <div class="alert-danger">
            {{ Html::ul($errors->all()) }}
        </div>

        {{ Form::open(array('url' => 'groups')) }}

        <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('description', 'description') }}
            {{ Form::text('description', Input::old('description'), array('class' => 'form-control')) }}
        </div>

        {{ Form::submit('Create the Group!', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}

    </div>


@endsection