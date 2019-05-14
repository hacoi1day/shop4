@extends('layouts.app')

@section('title')
    Thông tin người dùng | Thông tin cơ bản
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
                        <h3>thông tin cơ bản</h3>
                        <p>chứa thông tin cơ bản của người dùng như tên, email, số điện thoại, ...</p>
                        <hr>
                    </div>
                    <div class="col-12">
                        <form action="{{ route('info.basic.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label col-form-label-sm">địa chỉ email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control form-control-sm" id="email" name="email" placeholder="email" value="{{ $user->email }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label col-form-label-sm">họ tên</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="họ tên" value="{{ $user->name }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="username" class="col-sm-2 col-form-label col-form-label-sm">tên đăng nhập</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-sm" id="username" name="username" placeholder="tên đăng nhập" value="{{ $user->username }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="number" class="col-sm-2 col-form-label col-form-label-sm">số điện thoại</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-sm" id="number" name="number" placeholder="số điện thoại" value="{{ $user->number }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="birthday" class="col-sm-2 col-form-label">ngày sinh</label>
                                <div class="col-sm-10">
                                    <input class="form-control form-control-sm" type="date" id="birthday" name="birthday" value="{{ $user->birthday }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="avatar" class="col-sm-2 col-form-label">ảnh đại diện</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control-file form-control-sm" id="avatar" name="avatar">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10">
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
