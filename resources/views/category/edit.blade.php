@extends('layouts.app')

@section('title')
    Trang chủ | Kênh người bán | Sửa danh mục
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
                                    <h4>Sửa thông tin danh mục</h4>
                                    <small>Tên danh mục.</small>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('category.update', ['id' => $category->id]) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="category_name" class="col-sm-3 col-form-label col-form-label-sm">tên danh mục</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control form-control-sm" id="category_name" name="category_name" placeholder="tên danh mục" value="{{ $category->category_name }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="category_global" class="col-sm-3 col-form-label col-form-label-sm">loại</label>
                                            <div class="col-sm-9">
                                                <select multiple class="form-control form-control-sm" id="category_global" name="category_globals[]">
                                                    @foreach($categoryGloals as $categoryGloal)
                                                        <option {{ ($category->categoryglobals->contains($categoryGloal->id)) ? "selected" : "" }} value="{{$categoryGloal->id}}">{{ $categoryGloal->category_global_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-9 offset-sm-3">
                                                <button type="submit" class="btn btn-primary button-config">sửa</button>
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
    </script>
@endsection
