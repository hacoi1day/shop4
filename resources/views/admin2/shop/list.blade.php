@extends('admin2.layouts.app')

@section('content')
    <!-- Page Wrapper -->
    <div id="wrapper">
    @include('admin2.layouts.components.slidebar')
    <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
            @include('admin2.layouts.components.topbar')
            <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Danh sách của hàng</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">tên của hàng</th>
                                            <th scope="col">số điện thoại</th>
                                            <th scope="col">người dùng</th>
                                            <th scope="col">thao tác</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($shops as $shop)
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>{{ $shop->shop_name }}</td>
                                            <td>{{ $shop->shop_number }}</td>
                                            <td>{{ $shop->user['name'] }}</td>
                                            <td>
                                                <a href="{{ route('admin.shop.delete', ['id' => $shop->id]) }}"><i class="fas fa-trash"></i> xóa</a>
                                            </td>
                                        </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            @include('admin2.layouts.components.footer')
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
@endsection