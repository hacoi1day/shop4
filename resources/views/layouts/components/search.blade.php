<div class="search mt-4 mb-2 py-4">
    <div class="container">
        <div class="row">
            <div class="col-10 offset-2">
                <h3>Tìm kiếm sản phẩm</h3>
            </div>
            <div class="col-10 offset-2">
                <form action="{{ route('search') }}" method="get">
                    <div class="form-row">
                        <div class="col-7">
                            <input type="text" class="form-control" name="key" placeholder="tên sản phẩm">
                        </div>
                        <div class="col-1">
                            <button type="submit" class="btn btn-success"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-12">
                <hr>
            </div>
        </div>
    </div>
</div>