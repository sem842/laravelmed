<?php
//var_dump($openedSmenas); die;
?>

<ul>
@foreach($openedSmenas as $smena)
    <li><a href="/patients/{{ $smena->id }}">{{ $smena->medService->name }}</a></li>
@endforeach
</ul>
