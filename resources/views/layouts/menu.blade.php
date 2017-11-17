@can('manage',App\Group::class)
    <nav class="navbar navbar-inverse">
        <ul class="nav navbar-nav">
            <li><a href="{{ URL::to('groups/create') }}">@lang('t.group_create')</a>
            <li><a href="{{ URL::to('groups/manage') }}">@lang('t.manage')</a>
            <li><a href="{{ URL::to('medservices') }}">@lang('t.med_services_all')</a></li>
            <li><a href="{{ URL::to('medservices/create') }}">@lang('t.med_services_create')</a>
        </ul>
    </nav>
@endcan