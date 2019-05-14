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
                                    <h6 class="m-0 font-weight-bold text-primary">Danh sách danh mục</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div>
                                        <table class="table pb-3">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">tên danh mục</th>
                                                <th scope="col">loại danh mục</th>
                                                <th scope="col">tổng sản phẩm</th>
                                                <th scope="col">cửa hàng</th>
                                                <th scope="col">thao tác</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($categories as $category)
                                                <tr>
                                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                                    <td>{{ $category->category_name }}</td>
                                                    <td>
                                                        <ul style="list-style-type: none; padding-left: 0px; margin-left: 0px">
                                                            @foreach($category->categoryglobals as $cg)
                                                            <li>{{ $cg->category_global_name }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </td>
                                                    <td>{{ $category->totalProduct() }}</td>
                                                    <td>{{ $category->shop->shop_name }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.category.edit', ['id' => $category->id]) }}"><i class="fas fa-pencil-alt"></i> sửa</a>
                                                        <a href="{{ route('admin.category.delete', ['id' => $category->id]) }}"><i class="fas fa-trash"></i> xóa</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{ $categories->links() }}
                                    </div>
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