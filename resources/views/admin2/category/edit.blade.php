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
                        <div class="col-8">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Sửa thông tin danh mục</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <form action="{{ route('admin.category.update', ['id' => $category->id]) }}" method="post">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="category_name" class="col-sm-2 col-form-label">tên danh mục</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="category_name" name="category_name" placeholder="tên danh mục" value="{{ $category->category_name }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="category_globals" class="col-sm-2 col-form-label">Loại danh mục</label>
                                            <div class="col-10">
                                                <select multiple class="form-control" id="category_globals" name="category_globals[]">
                                                    @foreach($categoryGloals as $categoryGlobal)
                                                    <option {{ ($category->categoryglobals->contains($categoryGlobal->id)) ? "selected" : "" }} value="{{ $categoryGlobal->id }}">{{ $categoryGlobal->category_global_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary">lưu thông tin</button>
                                    </form>
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