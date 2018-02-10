@extends('layouts.site')<!-- расширяет каркас site.blade.php -->

<!-- Подключаем соответствующие секции -->

@section('header')
<!-- Подключаем соотв. файл шаблона в данную секцию -->
    @include('site.header')

@endsection

@section('content')

    @include('site.content')

@endsection

