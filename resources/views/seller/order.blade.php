@extends('layouts.app')

@section('title')
    Trang chủ | Kênh người bán | Danh sách đơn hàng
@endsection

@section('css')
    <link rel="stylesheet" href="asset/css/seller/base.css">
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-3">
                @include('seller.components.left-nav')
            </div>
            <div class="col-9">
                <div class="info-shop">
                    <div class="card">
                        <div class="card-header">
                            <h4>Danh sách đơn hàng</h4>
                            <small>Thông tin về đơn hàng của của hàng</small>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">ngày mua</th>
                                    <th scope="col">người mua</th>
                                    <th scope="col">tổng tiền</th>
                                    <th scope="col">thao tác</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($bills as $bill)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ $bill['date'] }}</td>
                                    <td>{{ $bill['name'] }}</td>
                                    <td>{{ $bill['total'] }} <sup>đ</sup></td>
                                    <td>
                                        <a href="{{ route('seller.order-detail', ['id' => $bill['id']]) }}">Chi tiết</a>
                                    </td>
                                </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('js')
    <script type="text/javascript">
        CKEDITOR.replace('shop_detail');
        CKEDITOR.replace('product_detail');
    </script>
@endsection
