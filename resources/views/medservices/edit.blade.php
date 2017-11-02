@extends('layouts.app')

@section('content')

    <div class="container">

        <nav class="navbar navbar-inverse">
            <ul class="nav navbar-nav">
                <li><a href="{{ URL::to('medservices') }}">@lang('t.med_services_all')</a></li>
            </ul>
        </nav>

        <h1>@lang('t.med_services_update')</h1>

        {{ Form::model($medService, array('route' => array('medservices.update', $medService->id), 'method' => 'PUT')) }}

        <div class="form-group {{ !empty($errors->first('name')) ? 'has-error' : '' }}">
            {{ Form::label('name', Lang::get('t.name')) }}
            {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
            @if (!empty($errors->first('name')))
                <small class="text-danger">
                    {{ $errors->first('name') }}
                </small>
            @endif
        </div>

        <div class="form-group">
            {{ Form::label('group_id', Lang::get('t.group')) }}
            <select class="form-control" name="group_id">
                <option value="{{ $medService->group->id }}">{{ $medService->group->description }}</option>
                @foreach($groups as $group)
                    <option value="{{ $group->id }}">{{ $group->description }}</option>
                @endforeach
            </select>
        </div>

        {{ Form::submit(Lang::get('t.update'), array('class' => 'btn btn-primary')) }}
        {{ Form::close() }}

    </div>

@endsection