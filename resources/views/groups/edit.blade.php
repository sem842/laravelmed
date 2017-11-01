<?php
    $formMethod  = "PUT";
    $formTitle   = Lang::get('t.updateGroup');
    $submitTitle = Lang::get('t.update');
?>

@extends('layouts.app')

@section('content')

    @include('groups.form')

@endsection