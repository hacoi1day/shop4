@extends('layouts.app')

@section('title')
    Trang chủ
@endsection

@section('css')
    <link rel="stylesheet" href="asset/css/home/base.css">
@endsection

@section('content')

{{--    @include('home.components.slides')--}}

    @include('home.components.category')

    @foreach($categories as $category)
        @include('home.components.product',['category' => $category])
    @endforeach

@endsection
