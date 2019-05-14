@extends('layouts.app')

@section('title')
    Trang chủ | Kênh người bán | Thông tin cơ bản
@endsection

@section('css')
    <link rel="stylesheet" href="asset/css/seller/base.css">
@endsection

@section('content')

{{--    @include('seller.components.info-shop')--}}

{{--    @include('seller.components.order-new')--}}

{{--    @include('seller.components.category')--}}

{{--    @include('seller.components.product')--}}

{{--    @include('seller.components.add-product')--}}

    <div class="container">
        <div class="row">
            <div class="col-3">
                @include('seller.components.left-nav')
            </div>
            <div class="col-9">
                <div class="info-shop">
                    <div class="card">
                        <div class="card-header">
                            <h4>Thông tin của hàng</h4>
                            <small>Thông tin của của hàng</small>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('seller.change-info', ['id' => $shop->id]) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label for="shop_name" class="col-sm-2 col-form-label col-form-label-sm">tên shop</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-sm" id="shop_name" name="shop_name" placeholder="tên của hàng" value="{{$shop->shop_name}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="shop_number" class="col-sm-2 col-form-label col-form-label-sm">số điện thoại</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-sm" id="shop_number" name="shop_number" placeholder="số điện thoại" value="{{$shop->shop_number}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="shop_detail" class="col-sm-2 col-form-label col-form-label-sm">mô tả shop</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="shop_detail" name="shop_detail" rows="3">{{$shop->shop_detail}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="shop_avatar" class="col-sm-2 col-form-label col-form-label-sm">logo shop</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control-file form-control-sm" id="shop_avatar" name="shop_avatar">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10 offset-sm-2">
                                        <button type="submit" class="btn btn-primary button-config">cập nhật</button>
                                    </div>
                                </div>
                            </form>
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
