@extends('layouts.app')

@section('title')
    Trang chủ | Tìm kiếm
@endsection

@section('css')
    <link rel="stylesheet" href="asset/css/seller/base.css">
    <style>
        /*product*/
        ._1product {
            /*border: 1px solid gray;*/
            padding: 5px;
            width: 100%;
            height: 300px;
            text-align: center;
            position: relative;
        }
        ._1product img {
            width: 200px;
            height: 200px;
            display: inline-block;

        }
        ._1product h6.title > a {
            position: absolute;
            top: 210px;
            left: 25px;
            z-index: 1;
            font-size: 18px;
        }
        ._1product a {
            text-decoration: none;
        }
        ._1product p.price {
            position: absolute;
            top: 230px;
            left: 25px;
            z-index: 1;
            font-size: 16px;
            color: #ff7c26;
            font-weight: bold;
        }
        ._1product .rate {
            position: absolute;
            top: 250px;
            left: 25px;
            z-index: 1;
            color: grey;
            font-size: 14px;
        }
        ._1product a {
            position: absolute;
            top: 235px;
            left: 180px;
            z-index: 1;
            font-size: 25px;
            color: green;
        }
    </style>
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h4>Danh sách sản phẩm</h4>
            </div>
        </div>
        <div class="row">
            @foreach($products as $product)
                <div class="col-3">
                    <div class="_1product">
                        <img src="{{ $product->product_image }}" alt="{{ $product->id }}">
                        <h6 class="title">
                            <a href="{{ route('product', ['id' => $product->id]) }}">
                                @php
                                    $name = $product->product_name;
                                    if(strlen($name) > 21)
                                    {
                                        echo substr($name, 0, 21) . '...';
                                    }
                                    else
                                    {
                                        echo $name;
                                    }
                                @endphp
                            </a>
                        </h6>
                        <p class="price">{{ $product->product_price }} VND</p>
                        <span class="rate">(chưa đánh giá)</span>
                        <a href=""><i class="fas fa-cart-plus"></i></a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            {{ $products->links() }}
        </div>
    </div>

@endsection

@section('js')
    <script type="text/javascript">
        CKEDITOR.replace('shop_detail');
        CKEDITOR.replace('product_detail');
    </script>
@endsection
