@extends('layouts.app')

@section('content')
    <div class="container">

        <nav class="navbar navbar-inverse">
            <ul class="nav navbar-nav">
                <li><a href="{{ URL::to('medsmenas') }}">@lang('t.med_smena_view_all')</a></li>
            </ul>
        </nav>

        <h1> @lang('t.med_smena_create') </h1>
        <h4> {{ $medservice->name }} </h4>

        {{ Form::open(array('url' => 'medsmenas')) }}
        <input type="hidden" name="med_service_id" value="{{$medservice->id}}">
        <div class="form-group {{ !empty($errors->first('patients_plan')) ? 'has-error' : ''  }}">
            {{ Form::label('patients_plan', Lang::get('t.patients_plan')) }}
            {{ Form::text('patients_plan', Input::old('patients_plan'), array('class' => 'form-control')) }}
            @if (!empty($errors->first('patients_plan')))
                <small  class="text-danger">
                    {{ $errors->first('patients_plan') }}
                </small>
            @endif
        </div>

        {{ Form::submit(Lang::get('t.med_smena_create') , array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}

    </div>

@endsection