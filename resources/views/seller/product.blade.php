@extends('layouts.app')

@section('title')
    Trang chủ | Kênh người bán | Danh sách sản phẩm của shop
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
                <div class="row">
                    <div class="col-12">
                        <div class="list-category">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Danh sách sản phẩm</h4>
                                    <small>Thông tin về danh sách sản phẩm đang có mặt tại cửa hàng.</small>
                                </div>
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">ảnh sản phẩm</th>
                                            <th scope="col">tên sản phẩm</th>
                                            <th scope="col">giá sản phẩm</th>
                                            <th scope="col">chức năng</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($products as $product)
                                            <tr>
                                                <th scope="row">{{ $loop->index + 1 }}</th>
                                                <td>
                                                    <img src="{{ $product->product_image }}" alt="ảnh sản phẩm" width="60px" height="60px">
                                                </td>
                                                <td>{{ $product->product_name }}</td>
                                                <td>{{ $product->product_price }}</td>
                                                <td>
                                                    <a href="{{ route('product.edit', ['id' => $product->id]) }}">Sửa</a>
                                                    <a href="{{ route('product.delete', ['id' => $product->id]) }}">Xóa</a>
                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                    {{ $products->links() }}
                                </div>
                            </div>
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
