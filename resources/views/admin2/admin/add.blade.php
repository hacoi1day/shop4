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
                        <div class="col-8 offset-2">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Thêm quản trị viên</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div>
                                        <form action="{{ route('admin.store') }}" method="post">
                                            @csrf
                                            <div class="form-group row">
                                                <label for="name" class="col-sm-2 col-form-label">name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="name">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="email" class="col-sm-2 col-form-label">username</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="username" name="username" placeholder="username">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="password" class="col-sm-2 col-form-label">password</label>
                                                <div class="col-sm-10">
                                                    <input type="password" class="form-control" id="password" name="password" placeholder="password">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="roles"class="col-sm-2 col-form-label">roles</label>
                                                <div class="col-sm-10">
                                                    <select multiple class="form-control" id="roles" name="roles[]">
                                                        @foreach($roles as $role)
                                                            <option value="{{ $role->id }}">{{ $role->display_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="offset-4">
                                                    <button type="submit" class="btn btn-block btn-success">thêm admin</button>
                                                </div>
                                            </div>

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