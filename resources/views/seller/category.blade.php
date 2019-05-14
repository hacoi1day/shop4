@extends('layouts.app')

@section('title')
    Trang chủ | Kênh người bán | Danh sách danh mục của shop
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
                                    <h4>Danh sách danh mục</h4>
                                    <small>Thông tin về danh sách danh mục đang có mặt tại cửa hàng.</small>
                                </div>
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">tên danh mục</th>
                                            <th scope="col">loại</th>
                                            <th scope="col">chức năng</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($categories as $category)
                                            <tr>
                                                <th scope="row">{{ $loop->index + 1 }}</th>
                                                <td>{{ $category->category_name }}</td>
                                                <td>
                                                    <ul class="list-cb">
                                                        @foreach($category->categoryglobals as $cb)
                                                            <li>{{ $cb->category_global_name }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <a href="{{ route('category.edit', ['id' => $category->id]) }}">Sửa</a>
                                                    <a href="{{ route('category.delete', ['id' => $category->id]) }}">Xóa</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    {{ $categories->appends(Request::all())->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="add-category my-2">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Thêm danh mục</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('category.store', ['shop_id' => $shop->id]) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="category_name" class="col-sm-3 col-form-label col-form-label-sm">tên danh mục</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control form-control-sm" id="category_name" name="category_name" placeholder="tên danh mục">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="category_global" class="col-sm-3 col-form-label col-form-label-sm">loại</label>
                                            <div class="col-sm-9">
                                                <select multiple class="form-control form-control-sm" id="category_global" name="category_globals[]">
                                                    @foreach($categoryGloals as $categoryGloal)
                                                        <option value="{{$categoryGloal->id}}">{{ $categoryGloal->category_global_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-9 offset-sm-3">
                                                <button type="submit" class="btn btn-primary button-config">thêm</button>
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
