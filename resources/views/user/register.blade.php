@extends('layouts.app')

@section('title')
    Đăng ký
@endsection

@section('content')
    <div class="container login">
        <div class="row">
            <div class="col-5 offset-1 text-center">
                <h4>đăng ký</h4>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-5 offset-1">
                <form action="{{ route('do-register') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="email">địa chỉ email</label>
                        <input type="email" class="form-control {{ $errors->has('email') ? "is-invalid" : "" }}" id="email" name="email" placeholder="email address" value="{{old('email')}}">
                        @if($errors->has('email'))
                            <span class="invalid-feedback">{{ $errors->has('email') ? $errors->first('email') : "" }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="name">tên người dùng</label>
                        <input type="text" class="form-control {{ $errors->has('name') ? "is-invalid" : "" }}" id="username" name="name" placeholder="name" value="{{ old('name') }}">
                        @if($errors->has('name'))
                            <span class="invalid-feedback">{{ $errors->has('name') ? $errors->first('name') : "" }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="username">tên đăng nhập</label>
                        <input type="text" class="form-control {{ $errors->has('username') ? "is-invalid" : "" }}" id="username" name="username" placeholder="username" value="{{ old('username') }}">
                        @if($errors->has('username'))
                            <span class="invalid-feedback">{{ $errors->has('username') ? $errors->first('username') : "" }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="number">số điện thoại</label>
                        <input type="text" class="form-control {{ $errors->has('number') ? "is-invalid" : "" }}" id="number" name="number" placeholder="number" value="{{ old('number') }}">
                        @if($errors->has('number'))
                            <span class="invalid-feedback">{{ $errors->has('number') ? $errors->first('number') : "" }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="password">mật khẩu</label>
                        <input type="password" class="form-control {{ $errors->has('password') ? "is-invalid" : "" }}" id="password" name="password" placeholder="password">
                        @if($errors->has('password'))
                            <span class="invalid-feedback">{{ $errors->has('password') ? $errors->first('password') : "" }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="passwordC">xác nhận mật khẩu</label>
                        <input type="password" class="form-control {{ $errors->has('passwordC') ? "is-invalid" : "" }}" id="passwordC" name="passwordC" placeholder="password comfirm">
                        @if($errors->has('passwordC'))
                            <span class="invalid-feedback">{{ $errors->has('passwordC') ? $errors->first('passwordC') : "" }}</span>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary">đăng ký</button>
                </form>
            </div>
            <div class="col-5">
                <span>Đã có tài khoản, </span>
                <a href="{{ route('login') }}">đăng nhập</a>
            </div>
        </div>
    </div>
@endsection
