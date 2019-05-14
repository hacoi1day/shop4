@extends('layouts.app')

@section('title')
    Danh mục
@endsection

@section('css')
    <link rel="stylesheet" href="asset/css/home/base.css">
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="title"><a href="{{ route('category', ['name' => $category->category_name_u]) }}">{{ $category->category_name }}</a></h3>
            </div>
            <div class="col-12">
                <div class="row">
                    @foreach($category->products as $product)
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
            </div>
        </div>
    </div>

@endsection
