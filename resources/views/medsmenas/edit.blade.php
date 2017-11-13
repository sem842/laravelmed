@extends('layouts.app')

@section('content')

    <div class="container">

        <nav class="navbar navbar-inverse">
            <ul class="nav navbar-nav">
                <li><a href="{{ URL::to('medsmenas') }}">@lang('t.med_smena_view_all')</a></li>
            </ul>
        </nav>

        <h1>@lang('t.med_smena_close')</h1>

        {{ Form::model($medSmena, array('route' => array('medsmenas.update', $medSmena->id), 'method' => 'PUT')) }}

        <h3>Вы уверены что хотите закрыть смену?</h3>

        <a type="button" class="btn btn-primary" href="{{ URL::to('medsmenas/') }}">@lang('t.cancel')</a>

        {{ Form::submit(Lang::get('t.close'), array('class' => 'btn btn-warning')) }}
        {{ Form::close() }}

    </div>

@endsection