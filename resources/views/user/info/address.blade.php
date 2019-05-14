@extends('layouts.app')

@section('title')
    Thông tin người dùng | Địa chỉ nhận hàng
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
                        <h3>địa chỉ</h3>
                        <p>là địa chỉ nhận hàng của người dùng</p>
                        <hr>
                    </div>
                    <div class="col-12">
                        <form action="{{ route('info.address.change') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label col-form-label-sm">tên người nhận</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="tên người nhận" value="{{ $address['name'] }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="address" class="col-sm-2 col-form-label col-form-label-sm">địa chỉ</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-sm" id="address" name="address" placeholder="địa chỉ" value="{{ $address['address'] }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="number" class="col-sm-2 col-form-label col-form-label-sm">số điện thoại</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-sm" id="number" name="number" placeholder="số điện thoại" value="{{ $address['number'] }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10 offset-sm-2">
                                    <button type="submit" class="btn btn-primary button-update">cập nhật</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
