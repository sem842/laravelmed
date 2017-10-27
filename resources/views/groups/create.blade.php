<?php
    $formMethod = "POST";
    $formTitle = Lang::get('t.createGroup');
    $submitTitle = Lang::get('t.create');
?>

@extends('layouts.app')

@section('content')

    @include('groups.form')

@endsection