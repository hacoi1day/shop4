<ul class="list-group list-s">
    <li class="list-group-item">
        <img src="uploads/shops/{{ $shop_avatar }}" width="200px" height="200px" alt="avatar shop">
    </li>
    <li class="list-group-item">
        <span>
            <i class="fas fa-fw fa-user"></i>
        </span>
        <a href="{{ route('seller.index') }}">thông tin cơ bản</a>
    </li>
    <li class="list-group-item">
        <span>
            <i class="fas fa-fw fa-clipboard-list"></i>
        </span>
        <a href=" {{ route('seller.order') }}">đơn hàng</a>
    </li>
    <li class="list-group-item">
        <span>
            <i class="fas fa-fw fa-list-ul"></i>
        </span>
        <a href="{{ route('seller.category') }}">danh mục</a>
    </li>
    <li class="list-group-item">
        <span>
            <i class="fas fa-fw fa-th-large"></i>
        </span>
        <a href="{{ route('seller.product') }}">sản phẩm</a>
    </li>
    <li class="list-group-item">
        <span>
            <i class="fas fa-fw fa-cart-plus"></i>
        </span>
        <a href="{{ route('seller.add-product') }}">thêm sản phẩm</a>
    </li>
</ul>