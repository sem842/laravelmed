<?php
//var_dump($medservices);die;
?>

@extends('layouts.app')

@section('content')
    <div class="container">

        <nav class="navbar navbar-inverse">
            <ul class="nav navbar-nav">
                <li><a href="{{ URL::to('medsmenas') }}">@lang('t.med_smena_view_all')</a></li>
                <li><a href="{{ URL::to('medsmenas/create') }}">@lang('t.med_smena_create')</a>
            </ul>
        </nav>

        <h1>@lang('t.med_smena_create')</h1>

        <!-- if there are creation errors, they will show here -->
        {{ Html::ul($errors->all()) }}

        {{ Form::open(array('url' => 'medsmenas')) }}

        <div class="form-group">
            {{--{{ Form::label('', Lang::get('t.med_smena')) }}--}}
            <select name="med_service_id">
                @foreach($medservices as $medservice)
                    <option value="{{ $medservice->id }}"> {{ $medservice->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            {{ Form::label('patients_plan', Lang::get('t.patients_plan')) }}
            {{ Form::text('patients_plan', Input::old('patients_plan'), array('class' => 'form-control')) }}
        </div>

        {{ Form::submit(Lang::get('t.med_smena_create'), array('class' => 'btn btn-primary')) }}
        {{ Form::close() }}

    </div>

@endsection