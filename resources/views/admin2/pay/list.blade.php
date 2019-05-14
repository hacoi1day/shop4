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
                                    <h6 class="m-0 font-weight-bold text-primary">Danh sách phương thức thanh toán</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div>
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">tên</th>
                                                <th scope="col">chức năng</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($pays as $pay)
                                                <tr>
                                                    <th scope="row">{{ $loop->index+1 }}</th>
                                                    <td>{{ $pay->pay_name }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.pay.edit', ['id' => $pay->id]) }}">Sửa</a>
                                                        <a href="{{ route('admin.pay.delete', ['id' => $pay->id]) }}">Xóa</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Thêm phương thức thanh toán</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div>
                                        <form action="{{ route('admin.pay.store') }}" method="post">
                                            @csrf
                                            <div class="form-group row">
                                                <label for="pay_name" class="col-sm-3 col-form-label">tên phương thức</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control {{ $errors->has('pay_name') ? "is-invalid" : "" }}" name="pay_name" id="pay_name" placeholder="tên phương thức">
                                                    @if($errors->has('pay_name'))
                                                        <span class="invalid-feedback">{{ $errors->has('pay_name') ? $errors->first('pay_name') : "" }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-block btn-primary mt-2">thêm phương thức thanh toán</button>
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