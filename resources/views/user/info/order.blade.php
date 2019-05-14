@extends('layouts.app')

@section('title')
    Thông tin người dùng
@endsection

@section('css')
    <link rel="stylesheet" href="asset/css/info/base.css">
@endsection

@section('content')
    <div class="container info my-4">
        <div class="row">
            <div class="col-3">
                @include('user.info.components.left-nav')
            </div>
            <div class="col-9 info-basic">
                <div class="row">
                    <div class="col-12">
                        <h3>quản lý đơn hàng</h3>
                        <p>quản lý đơn hàng của người dùng</p>
                        <hr>
                    </div>
                    <div class="col-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">ngày đặt hàng</th>
                                <th scope="col">sản phẩm</th>
                                <th scope="col">tổng tiền</th>
                                <th scope="col">xem</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($billsResult as $bill)
                            <tr>
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                <td>{{ $bill['date'] }}</td>
                                <td>
                                    <ul style="padding-left: 0px; margin-left: 0px; list-style-type: none;">
                                        @foreach($bill['products'] as $product)
                                        <li>{{ $product['name'] }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>{{ $bill['total'] }}</td>
                                <td>
                                    <a href="{{ route('order', ['id' => $bill['id']]) }}">chi tiết</a>
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
@endsection
