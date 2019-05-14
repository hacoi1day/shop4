@extends('layouts.app')

@section('title')
    Trang chủ | Kênh người bán | Danh sách danh mục
@endsection

@section('css')
    <link rel="stylesheet" href="asset/css/seller/base.css">
@endsection

@section('content')


    @include('seller.components.product')


@endsection

@section('js')

@endsection
