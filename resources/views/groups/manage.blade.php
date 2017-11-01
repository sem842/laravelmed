@extends('layouts.app')

@section('content')

    <div class="container">
        <nav class="navbar navbar-inverse">
            <ul class="nav navbar-nav">
                <li><a href="{{ URL::to('groups') }}">@lang('t.view_all_groups')</a></li>
                <li><a href="{{ URL::to('groups/create') }}">@lang('t.group_create')</a>
                <li><a href="{{ URL::to('groups/manage') }}">@lang('t.manage')</a>
            </ul>
        </nav>

        <h1>@lang('t.user_manage')</h1>
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
                <td>@lang('t.name')</td>
                <td>@lang('t.email')</td>
                <td>@lang('t.group')</td>
            </tr>
            </thead>
            <tbody>
            @foreach($users as  $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>

                    <td>
                        {{ Form::model(array('method' => 'POST')) }}
                        {{ Form::hidden('user_id', $user->id) }}
                        <select onchange="this.form.submit()" name="group_id">
                            <option value="0" {{$user->group_id == 0 ? "selected='selected'" : '' }}>@lang('t.not_set')</option>
                            @foreach($groups as $group)
                                <option value="{{ $group->id }}" {{ $group->id == $user->group_id ? "selected='selected'" : '' }} > {{ $group->description }}</option>
                            @endforeach
                        </select>
                        {{ Form::close() }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>

@endsection