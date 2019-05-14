@extends('layouts.app')

@section('title')
    {{ $product->product_name }}
@endsection

@section('css')
    <link rel="stylesheet" href="asset/css/home/base.css">
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="info-product">
                    <img class="product-image" src="{{ $product->product_image }}" alt="ảnh sản phẩm">
                    <div class="info">
                        <h2 class="product-name">{{ $product->product_name }}</h2>
                        <p>Giá sản phẩm: <span class="product-price">{{ $product->product_price }} đ</span></p>
                        <p>Cửa hàng: <span class="shop"><a href="">{{ $product->getShop()->shop_name }}</a></span></p>
                        <a href="{{ route('cart.add', ['product_id' => $product->id]) }}" style="text-decoration: none;" class="btn btn-success">Thêm vào giỏ hàng</a>
                    </div>
                </div>
            </div>
            <div class="col-9 my-4 pt-4">
                <div class="chitiet">
                    <div class="card">
                        <div class="card-header">
                            Chi tiết sản phẩm
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-2">
                                    Danh mục
                                </div>
                                <div class="col-10">
                                    {{ $product->categories->first()->category_name }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-2">
                                    Thương hiệu
                                </div>
                                <div class="col-10">
                                    No brand
                                </div>
                            </div>
{{--                            <div class="row">--}}
{{--                                <div class="col-2">--}}
{{--                                    Kho hàng--}}
{{--                                </div>--}}
{{--                                <div class="col-10">--}}
{{--                                    990--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-2">--}}
{{--                                    Địa chỉ shop--}}
{{--                                </div>--}}
{{--                                <div class="col-10">--}}
{{--                                    Hà Nội--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
                <div class="mota my-4">
                    <div class="card">
                        <div class="card-header">
                            Mô tả sản phẩm
                        </div>
                        <div class="card-body">
                            @php
                                echo $product->product_detail;
                            @endphp
                        </div>
                    </div>
                </div>
                <div class="binhluan my-4">
                    <div class="card">
                        <div class="card-header">
                            Bình luận
                        </div>
                        <div class="card-body">
                            <div class="add-comemnt">
                                <form action="{{ route('comment.add', ['id' => $product->id]) }}" method="post">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="comment" class="col-sm-2 col-form-label col-form-label-sm">Bình luận</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control form-control-sm" id="comment" name="comment" placeholder="nội dung bình luận" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-10 offset-2">
                                            <button class="btn btn-primary btn-sm">Bình luận</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="list-comment">
                                <div class="row">
                                    <div class="col-12">
                                        <h5>Bình luận</h5>
                                    </div>
                                    <div class="col-12">
                                        @foreach($comments as $comment)
                                        <div class="_1comment">
                                            <strong>{{ $comment->user['name'] }}</strong> : {{ $comment->comment_content }}
                                            <hr>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="danhgia my-4">
                    <div class="card">
                        <div class="card-header">
                            Đánh giá
                        </div>
                        <div class="card-body">
                            <div class="add-rate">
                                <form action="{{ route('rate.add', ['id' => $product->id]) }}" method="post">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="rate_content" class="col-sm-2 col-form-label col-form-label-sm">Đánh giá</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control form-control-sm" id="rate_content" name="rate_content" placeholder="nội dung đánh giá">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="rate_star" class="col-sm-2 col-form-label col-form-label-sm">Số sao</label>
                                        <div class="col-sm-10">
                                            <select class="form-control form-control-sm" id="rate_star" name="rate_star">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-10 offset-2">
                                            <button class="btn btn-primary btn-sm">Đánh giá</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="list-rate">
                                <div class="row">
                                    <div class="col-12">
                                        <h5>Đánh giá</h5>
                                    </div>
                                    <div class="col-12">
                                        @foreach($rates as $rate)
                                        <div class="_1rate">
                                            <strong>{{ $rate->user['name'] }}</strong> : {{ $rate->rate_content }} ({{ $rate->rate_star }} <i class="fas fa-star"></i>)
                                            <hr>
                                        </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
