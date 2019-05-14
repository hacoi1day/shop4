@extends('layouts.app')

@section('title')
    Đăng nhập
@endsection

@section('content')
    <div class="container login">
        <div class="row">
            <div class="col-5 offset-1 text-center">
                <h4>đăng nhập</h4>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-5 offset-1">
                <form action="{{ route('do-login') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="email">địa chỉ email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="email address" value="{{old('email')}}">
                    </div>
                    <div class="form-group">
                        <label for="password">mật khẩu</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="password">
                    </div>
                    <button type="submit" class="btn btn-primary">đăng nhập</button>
                </form>
            </div>
            <div class="col-5">
                <span>chưa có tài khoản</span>
                <a href="{{ route('register') }}">đăng ký</a>
            </div>
        </div>
    </div>
@endsection
