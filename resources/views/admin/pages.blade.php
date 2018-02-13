@extends ('layouts.admin')

<!-- Переопределяем хедер -->
@section('header')

    @include('admin.header');

@endsection

<!-- Переопределяем content -->

@section('content')

    @include('admin.content_pages')

@endsection