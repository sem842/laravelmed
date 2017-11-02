<?php
    $formMethod  = "PUT";
    $formTitle   = Lang::get('t.group_update');
    $submitTitle = Lang::get('t.update');
?>

@extends('layouts.app')

@section('content')

    @include('groups.form')

@endsection