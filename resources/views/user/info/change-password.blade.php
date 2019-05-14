@extends('layouts.app')

@section('title')
    Thông tin người dùng | Thay đổi mật khẩu
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
                        <h3>đổi mật khẩu</h3>
                        <p>đổi mật khẩu đăng nhập ứng dụng</p>
                        <hr>
                    </div>
                    <div class="col-12">
                        <form action="{{ route('info.do-change-password') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="old-password" class="col-sm-2 col-form-label col-form-label-sm">mật khẩu cũ</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control form-control-sm" id="old-password" name="old-password" placeholder="mật khẩu cũ">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="new-password" class="col-sm-2 col-form-label col-form-label-sm">mật khẩu mới</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control form-control-sm" id="new-password" name="new-password" placeholder="mật khẩu mới">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="new-password-c" class="col-sm-2 col-form-label col-form-label-sm">xác nhận mật khẩu</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control form-control-sm" id="new-password-c" name="new-password-c" placeholder="xác nhận mật khẩu">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary button-update">thay đổi</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
