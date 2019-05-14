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
                                    <h6 class="m-0 font-weight-bold text-primary">Sửa phương thức {{ $pay->pay_name }}</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div>
                                        <form action="{{ route('admin.pay.update', ['id' => $pay->id]) }}" method="post">
                                            @csrf
                                            <div class="form-group row">
                                                <label for="pay_name" class="col-sm-3 col-form-label">tên phương thức</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control {{ $errors->has('pay_name') ? "is-invalid" : "" }}" name="pay_name" id="pay_name" placeholder="tên phương thức" value="{{ $pay->pay_name }}">
                                                    @if($errors->has('pay_name'))
                                                        <span class="invalid-feedback">{{ $errors->has('pay_name') ? $errors->first('pay_name') : "" }}</span>
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