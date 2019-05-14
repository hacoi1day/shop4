<div class="row">
    <div class="col-12 text-center">
        <img src="uploads/users/{{ $user->avatar }}" width="150px" height="150px" class="avatar" alt="avatar">
        <p>{{ $user->username }}</p>
    </div>
    <div class="col-12">
        <ul class="list-title">
            <li>
                <a href="{{ route('info.basic') }}"><i class="fas fa-user"></i> Thông tin cơ bản</a>
            </li>
            <li>
                <a href="{{ route('info.address') }}"><i class="fas fa-map-marker-alt"></i> Địa chỉ</a>
            </li>
            <li>
                <a href="{{ route('info.order') }}"><i class="fas fa-clipboard-list"></i> Quản lý đơn hàng</a>
            </li>
            <li>
                <a href="{{ route('info.change-password') }}"><i class="fas fa-key"></i> Đổi mật khẩu</a>
            </li>
        </ul>
    </div>
</div>