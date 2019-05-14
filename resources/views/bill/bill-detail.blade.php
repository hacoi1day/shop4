@extends('layouts.app')

@section('title')
    Chi tiết đơn hàng
@endsection

@section('css')
    <link rel="stylesheet" href="asset/css/bill/bill.css">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-10 offset-1">
                <div class="card">
                    <h5 class="card-header text-center">Chi tiết đơn hàng</h5>
                    <div class="card-body">
                        <div class="nguoinhan mb-2">
                            <h5 class="card-title">Thông tin người nhận</h5>
                            <div class="list-product">
                                <div class="row">
                                    <div class="col-2">
                                        Tên người nhận:
                                    </div>
                                    <div class="col-10">
                                        <strong>{{ $address->name }}</strong>
                                    </div>
                                    <div class="col-2">
                                        Số điện thoại:
                                    </div>
                                    <div class="col-10">
                                        <strong>{{ $address->number }}</strong>
                                    </div>
                                    <div class="col-2">
                                        Địa chỉ:
                                    </div>
                                    <div class="col-10">
                                        {{ $address->address }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="sanpham my-2">
                            <h5 class="card-title my-2">Danh sách sản phẩm</h5>
                            <div class="list-product">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">tên sản phẩm</th>
                                        <th scope="col">đơn giá</th>
                                        <th scope="col">số lượng</th>
                                        <th scope="col">tổng</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($products as $product)
                                        <tr>
                                            <input type="hidden" name="products[]" value="{{ $product['id'] }}">
                                            <th scope="row">{{ $loop->index + 1 }}</th>
                                            <td>{{ $product['name'] }}</td>
                                            <td>{{ $product['price'] }} <sup>đ</sup></td>
                                            <td>{{ $product['quantity'] }}</td>
                                            <td>{{ $product['price'] * $product['quantity'] }} <sup>đ</sup></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <div class="vanchuyen my-2 row">
                            <h5 class="card-title col-4">Hình thức vận chuyển:</h5>
                            <div class="col-8">
                                {{ $transport->transport_name }}
                            </div>
                        </div>
                        <hr>
                        <div class="vanchuyen my-2 row">
                            <h5 class="card-title col-4">Hình thức thanh toán:</h5>
                            <div class="col-8">
                                {{ $pay->pay_name }}
                            </div>
                        </div>
                        <hr>
                        <div class="ket my-2">
                            <h5 class="card-title">Tổng tiền: {{ $total }}<sup>đ</sup></h5>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
