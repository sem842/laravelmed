<div class="container">

    <nav class="navbar navbar-inverse">
        <ul class="nav navbar-nav">
            <li><a href="{{ URL::to('groups') }}">View All'groups</a></li>
        </ul>
    </nav>

<h1>{{ $formTitle }}</h1>

@if ($formMethod == "PUT")
    {{ Form::model($group, array('route' => array('groups.update', $group->id), 'method' => 'PUT')) }}
@else
    {{ Form::open(array('url' => 'groups')) }}
@endif
{{ Form::open(array('url' => 'groups')) }}

<div class="form-group {{ !empty($errors->first('name')) ? 'has-error' : '' }}">
    {{ Form::label('name', 'Name') }}
    {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
    @if (!empty($errors->first('name')))
        <small class="text-danger">
            {{ $errors->first('name') }}
        </small>
    @endif
</div>

<div class="form-group {{ !empty($errors->first('description')) ? 'has-error' : '' }}">
    {{ Form::label('description', 'Description') }}
    {{ Form::text('description', Input::old('description'), array('class' => 'form-control')) }}
    @if (!empty($errors->first('description')))
        <small class="text-danger">
            {{ $errors->first('description') }}
        </small>
    @endif
</div>

{{ Form::submit($submitTitle, array('class' => 'btn btn-primary')) }}

{{ Form::close() }}