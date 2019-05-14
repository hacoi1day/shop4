@extends('layouts.app')

@section('title')
    Giỏ hàng
@endsection

@section('css')
    <link rel="stylesheet" href="asset/css/cart/cart.css">
@endsection

@section('content')
    <div class="container giohang">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <h5 class="card-header">Giỏ hàng</h5>
                    <div class="card-body">
                        <form action="{{ route('bill.check') }}" method="post">
                            @csrf
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">tên sản phẩm</th>
                                    <th scope="col">đơn giá</th>
                                    <th scope="col">số lượng</th>
                                    <th scope="col">thao tác</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                <tr>
                                    <th scope="row">
                                        <input type="checkbox" name="products[]" value="{{ $product['id'] }}">
                                    </th>
                                    <td>
                                        <a href="{{ route('product', ['id' => $product['id']]) }}">{{ $product['product_name'] }}</a>
                                    </td>
                                    <td>{{ $product['product_price'] }}</td>
                                    <td class="text-center">{{ $product['quantity'] }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('cart.delete', ['product' => $product['id']]) }}">Xóa</a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-success float-right">Đặt hàng</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
