<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.home') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Quản trị</div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin.home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Giao diện
    </div>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Quyền truy cập</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Quyền truy cập</h6>
                <a class="collapse-item" href="{{ route('admin.list') }}">Danh sách quản trị viên</a>
                <a class="collapse-item" href="{{ route('admin.add') }}">Thêm quản trị viên</a>
                <a class="collapse-item" href="{{ route('role.list') }}">Danh sách quyền</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Quản lý giao diện -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Giao diện</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="">Slide</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Người dùng -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#list-user" aria-expanded="true" aria-controls="list-user">
            <i class="fas fa-fw fa-user"></i>
            <span>Người dùng</span>
        </a>
        <div id="list-user" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.user.list') }}">Danh sách</a>
            </div>
        </div>
    </li>

    <!-- Danh mục chung -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#list-category-global" aria-expanded="true" aria-controls="list-category-global">
            <i class="fas fa-fw fa-th-list"></i>
            <span>Danh mục chung</span>
        </a>
        <div id="list-category-global" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.category-global.list') }}">Danh sách</a>
            </div>
        </div>
    </li>

    <!-- Danh mục riêng -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#list-category" aria-expanded="true" aria-controls="list-category">
            <i class="fas fa-fw fa-list"></i>
            <span>Danh mục riêng</span>
        </a>
        <div id="list-category" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.category.list') }}">Danh sách</a>
            </div>
        </div>
    </li>

    <!-- Shop -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#shop" aria-expanded="true" aria-controls="shop">
            <i class="fas fa-fw fa-store-alt"></i>
            <span>Cửa hàng</span>
        </a>
        <div id="shop" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.shop.list') }}">Danh sách</a>
            </div>
        </div>
    </li>

    <!-- Product -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#product" aria-expanded="true" aria-controls="product">
            <i class="fas fa-fw fa-th-large"></i>
            <span>Sản phẩm</span>
        </a>
        <div id="product" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.product.list') }}">Danh sách</a>
            </div>
        </div>
    </li>

    <!-- Transport -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#transport" aria-expanded="true" aria-controls="transport">
            <i class="fas fa-fw fa-dolly"></i>
            <span>Hình thức vận chuyển</span>
        </a>
        <div id="transport" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.transport.show') }}">Danh sách</a>
                <a class="collapse-item" href="">Thêm</a>
            </div>
        </div>
    </li>

    <!-- Pay -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pay" aria-expanded="true" aria-controls="pay">
            <i class="fas fa-fw fa-money-bill-wave-alt"></i>
            <span>Hình thức thanh toán</span>
        </a>
        <div id="pay" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.pay.show') }}">Danh sách</a>
                <a class="collapse-item" href="">Thêm</a>
            </div>
        </div>
    </li>

    <!-- Comment -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#comment" aria-expanded="true" aria-controls="comment">
            <i class="fas fa-fw fa-comment"></i>
            <span>Bình luận</span>
        </a>
        <div id="comment" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="">Danh sách</a>
            </div>
        </div>
    </li>

    <!-- Rate -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#rate" aria-expanded="true" aria-controls="rate">
            <i class="fas fa-fw fa-star-half-alt"></i>
            <span>Đánh giá</span>
        </a>
        <div id="rate" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="">Danh sách</a>
            </div>
        </div>
    </li>

</ul>
<!-- End of Sidebar -->