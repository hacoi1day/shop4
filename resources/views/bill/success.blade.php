@extends('layouts.app')

@section('title')
    Đặt hàng thành công
@endsection

@section('css')
    <link rel="stylesheet" href="asset/css/bill/bill.css">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-10 offset-1">
                <div class="card text-center">
                    <h5 class="card-header">Đặt hàng thành công</h5>
                    <div class="card-body">
                        <h3 style="color: #398044">Bạn đã đặt hàng thành công !!!</h3>
                        <a href="{{ route('home') }}" class="btn btn-outline-success a-user">Trở lại trang chủ</a>
                        <a href="{{ route('order', ['id' => $idBill]) }}" class="btn btn-outline-info a-user">Theo dõi đơn hàng</a>
                    </div>
                    <div class="card-footer text-muted">
                        Cảm ơn vì đã mua hàng ^^
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
