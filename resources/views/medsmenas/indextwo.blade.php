@extends('layouts.app')

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
            
        </div>        
    </div>
    
@endsection