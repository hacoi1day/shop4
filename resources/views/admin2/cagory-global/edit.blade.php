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
                        <div class="col-6">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Sửa danh mục {{ $categoryGlobal->category_global_name }}</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div>
                                        <form action="{{ route('admin.category-global.update', ['id' => $categoryGlobal->id]) }}" method="post">
                                            @csrf
                                            <div class="form-group row">
                                                <label for="category_global_name" class="col-sm-3 col-form-label">tên danh mục</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control {{ $errors->has('category_global_name') ? "is-invalid" : "" }}" name="category_global_name" id="category_global_name" placeholder="tên danh mục" value="{{ $categoryGlobal->category_global_name }}">
                                                    @if($errors->has('category_global_name'))
                                                        <span class="invalid-feedback">{{ $errors->has('category_global_name') ? $errors->first('category_global_name') : "" }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-block btn-primary mt-2">lưu thông tin</button>
                                        </form>
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