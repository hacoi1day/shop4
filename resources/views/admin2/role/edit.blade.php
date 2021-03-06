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
                                    <h6 class="m-0 font-weight-bold text-primary">Sửa quyền {{ $role->display_name }}</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div>
                                        <form action="{{ route('role.update', ['id' => $role->id]) }}" method="post">
                                            @csrf
                                            <div class="form-group row">
                                                <label for="name" class="col-sm-3 col-form-label">tên quyền</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="name" value="{{ $role->name }}" id="name" placeholder="tên quyền">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="display_name" class="col-sm-3 col-form-label">tên hiển thị</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="display_name" value="{{ $role->display_name }}" id="display_name" placeholder="tên hiển thị">
                                                </div>
                                            </div>
                                            @foreach($permissions as $permission)
                                                <div class="form-check row">
                                                    <div class="col-sm-9 offset-sm-3">
                                                        <input type="checkbox" class="form-check-input" {{ ($role->permissions->contains($permission->id)) ? "checked" : "" }} name="permissions[]" id="{{ $permission->name }}" value="{{ $permission->id }}">
                                                        <label class="form-check-label" for="{{ $permission->name }}">{{ $permission->display_name }}</label>
                                                    </div>
                                                </div>
                                            @endforeach

                                            <button type="submit" class="btn btn-block btn-primary mt-2">sửa quyền</button>
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