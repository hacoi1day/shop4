@extends('layouts.app')

@section('title')
    Trang chủ | Kênh người bán | Thêm sản phẩm
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
                                    <h4>Thêm thông tin sản phẩm</h4>
                                    <small>Thêm thông tin sản phẩm mới vào cửa hàng.</small>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="product_name" class="col-sm-2 col-form-label col-form-label-sm">tên sản phẩm</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control form-control-sm" id="product_name" name="product_name" placeholder="tên sản phẩm">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="product_price" class="col-sm-2 col-form-label col-form-label-sm">giá sản phẩm</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control form-control-sm" id="product_price" name="product_price" placeholder="giá sản phẩm">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="product_image" class="col-sm-2 col-form-label col-form-label-sm">ảnh sản phẩm</label>
                                            <div class="col-sm-10">
                                                <input type="file" class="form-control-file form-control-sm" id="product_image" name="product_image">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="category" class="col-sm-2 col-form-label col-form-label-sm">danh mục</label>
                                            <div class="col-sm-10">
                                                <select multiple class="form-control form-control-sm" id="category" name="categories[]">
                                                    @foreach($categories as $category)
                                                        <option value="{{$category->id}}">{{ $category->category_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="product_detail" class="col-sm-2 col-form-label col-form-label-sm">mô tả sản phẩm</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" id="product_detail" name="product_detail" rows="3"></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-10 offset-sm-2">
                                                <button type="submit" class="btn btn-primary button-config">thêm sản phẩm</button>
                                            </div>
                                        </div>
                                    </form>
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
