@extends('layouts.app')
<?php
//var_dump($possibleMedServices);die
?>
@section('content')

    <div class="container">
        <div class="col-md-3">
            <ul class="list-group">
                @foreach($possibleMedServices as $medService)
                    <li class="list-group-item">
                        <a href="{{ URL::to('medsmenas/' . $medService->id .'/create') }}">{{ $medService->name }}</a>
                    </li>
                @endforeach    
            </ul>
        </div>
        <div class="col-md-9">
            <table class="table table-stripped table-bordered">
                <thead>
                <tr>
                    <td>@lang('t.med_service')</td>
                    <td>@lang('t.patients_plan')</td>
                    <td>@lang('t.manage')</td>
                </tr>
                </thead>

                <tbody>
                @foreach($openSmenas as $smena)
                <tr>
                    <td>{{ $smena->medService->name }}</td>
                    <td>{{ $smena->patients_plan }}</td>
                    <td>
                        <a href="{{ URL::to('medsmenas/' . $smena->id .'/edit') }}">@lang('t.close')</a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>        
    </div>
    
@endsection