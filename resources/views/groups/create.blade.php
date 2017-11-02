<?php
    $formMethod  = "POST";
    $formTitle   = Lang::get('t.group_create');
    $submitTitle = Lang::get('t.create');
?>

@extends('layouts.app')

@section('content')

    @include('groups.form')

@endsection