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
                            <h4>Chi tiết đơn hàng</h4>
                            <small>Thông tin về đơn hàng</small>
                        </div>
                        <div class="card-body">
                            <strong>Ngày đặt hàng: </strong> <span>{{ $bill['date'] }}</span>
                            <br>
                            <strong>Tên người nhận: </strong> <span>{{ $bill['name'] }}</span>
                            <br>
                            <strong>Địa chỉ: </strong> <span>{{ $bill['address'] }}</span>
                            <hr>

                            <h5>Danh sách sản phẩm</h5>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">tên sản phẩm</th>
                                    <th scope="col">giá</th>
                                    <th scope="col">số lượng</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($bill['products'] as $product)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ $product['name'] }}</td>
                                    <td>{{ $product['price'] }}</td>
                                    <td>{{ $product['quantity'] }}</td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <strong>Tổng tiền: {{ $bill['total'] }}<sup>đ</sup></strong>


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
