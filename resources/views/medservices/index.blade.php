@extends('layouts.app')

@section('content')

    <div class="container">

        @include('layouts.menu')

        <h1>@lang('t.med_services_all')</h1>

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
                <td>@lang('t.id')</td>
                <td>@lang('t.name')</td>
                <td>@lang('t.group')</td>
                <td colspan="3">@lang('t.control')</td>
            </tr>
            </thead>
            <tbody>
            @foreach($allServices as $key => $value)
                <tr>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->group->description }}</td>

                    <!-- we will also add show, edit, and delete buttons -->
                    <td>
                        <a class="btn btn-small btn-success"
                           href="{{ URL::to('medservices/' . $value->id) }}">@lang('t.med_services_show')</a>
                    </td>
                    <td>
                        <a class="btn btn-small btn-info"
                           href="{{ URL::to('medservices/' . $value->id . '/edit') }}">@lang('t.med_services_edit')</a>
                    </td>
                    <td>
                        {{ Form::open(array('url' => 'medservices/' . $value->id, 'class' => 'pull-left', 'onsubmit' => 'return confirmDelete()')) }}
                            {{ Form::hidden('_method', 'DELETE') }}
                            {{ Form::submit(Lang::get('t.med_services_delete'), array('class' => 'btn btn-warning')) }}
                        {{ Form::close() }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection