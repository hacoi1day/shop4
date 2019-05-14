<?php

// trang chủ
Route::get('/', [
    'as' => 'home',
    'uses' => 'HomeController@index'
]);
// lấy ra sản phẩm danh mực chung
Route::get('category-global/{name}', [
    'as' => 'category-global',
    'uses' => 'CategoryGlobalController@getProductOfCategoryGlobal'
]);
// lấy ra sản phẩm của danh mục
Route::get('category/{name}', [
    'as' => 'category',
    'uses' => 'CategoryController@getProductOfCategory'
]);
// hiển thị thông tin sản phẩm
Route::get('product/{id}', [
    'as' => 'product',
    'uses' => 'ProductController@getProductOfId'
]);
// đăng nhập
Route::get('login', [
    'as' => 'login',
    'uses' => 'UserController@login'
]);
Route::post('do-login', [
    'as' => 'do-login',
    'uses' => 'UserController@doLogin'
]);
// đăng ký
Route::get('register', [
    'as' => 'register',
    'uses' => 'UserController@register'
]);
Route::post('do-register', [
    'as' => 'do-register',
    'uses' => 'UserController@doRegister'
]);
// tìm kiếm
Route::get('search', [
    'as' => 'search',
    'uses' => 'ProductController@search'
]);

// các hàm xử lý khi người dùng đã đăng nhập
Route::group(['middleware' => 'auth'], function () {
    // đăng xuất
    Route::get('logout', [
        'as' => 'logout',
        'uses' => 'UserController@logout'
    ]);
    // chỉnh sửa thông tin người dùng
    Route::group(['prefix' => 'info'], function () {
        // trang thông tin cơ bản
        Route::get('basic', [
            'as' => 'info.basic',
            'uses' => 'UserController@info'
        ]);
        // cập nhật thông tin
        Route::post('update-info', [
            'as' => 'info.basic.update',
            'uses' => 'UserController@update'
        ]);
        // trang đổi mật khẩu
        Route::get('address-password', [
            'as' => 'info.change-password',
            'uses' => 'UserController@changePassword'
        ]);
        // cập nhật mật khẩu
        Route::post('do-change-password', [
            'as' => 'info.do-change-password',
            'uses' => 'UserController@doChangePassword'
        ]);
        // trang địa chỉ
        Route::get('address', [
            'as' => 'info.address',
            'uses' => 'UserController@address'
        ]);
        // cập nhật địa chỉ
        Route::post('change-address', [
            'as' => 'info.address.change',
            'uses' => 'AddressController@doChangeAddress'
        ]);
        // trang quản lý đơn hàng
        Route::get('order', [
            'as' => 'info.order',
            'uses' => 'UserController@order'
        ]);

    });
    // kênh người bán
    Route::group(['prefix' => 'seller'], function () {
        // thông tin cơ bản
        Route::get('/', [
            'as' => 'seller.index',
            'uses' => 'SellerController@index'
        ]);
        // thông tin đơn hàng
        Route::get('order', [
            'as' => 'seller.order',
            'uses' => 'SellerController@order'
        ]);
        // chi tiết từng đơn hàng
        Route::get('order/{id}', [
            'as' => 'seller.order-detail',
            'uses' => 'SellerController@orderDetail'
        ]);
        // danh sách danh mục
        Route::get('category', [
            'as' => 'seller.category',
            'uses' => 'SellerController@category'
        ]);
        // danh sách sản phẩm
        Route::get('product', [
            'as' => 'seller.product',
            'uses' => 'SellerController@product'
        ]);
        // thêm sản phẩm
        Route::get('add-product', [
            'as' => 'seller.add-product',
            'uses' => 'SellerController@addProduct'
        ]);
        // thay đổi thông tin giới thiệu
        Route::post('change-info/{id}', [
            'as' => 'seller.change-info',
            'uses' => 'SellerController@changeInfo'
        ]);
        // danh sách sản phẩm
        Route::get('list', [
            'as' => 'seller.product.list',
            'uses' => 'SellerController@listProduct'
        ]);

        // thao tác với danh mục
        Route::group(['prefix' => 'category'], function () {
            Route::post('store/{shop_id}', [
                'as' => 'category.store',
                'uses' => 'CategoryController@store'
            ]);
            Route::get('edit/{id}', [
                'as' => 'category.edit',
                'uses' => 'CategoryController@edit'
            ]);
            Route::post('update/{id}', [
                'as' => 'category.update',
                'uses' => 'CategoryController@update'
            ]);
            Route::get('delete/{id}', [
                'as' => 'category.delete',
                'uses' => 'CategoryController@delete'
            ]);
        });

        // thao tác với sản phẩm
        Route::group(['prefix' => 'product'], function () {
            Route::post('store', [
                'as' => 'product.store',
                'uses' => 'ProductController@store'
            ]);
            Route::get('edit/{id}', [
                'as' => 'product.edit',
                'uses' => 'ProductController@edit'
            ]);
            Route::post('update/{id}', [
                'as' => 'product.update',
                'uses' => 'ProductController@update'
            ]);
            Route::get('delete/{id}', [
                'as' => 'product.delete',
                'uses' => 'ProductController@delete'
            ]);
        });
    });
    // thao tác với giỏ hàng
    Route::group(['prefix' => 'cart'], function () {
        Route::get('/', [
            'as' => 'cart.list',
            'uses' => 'CartController@index'
        ]);
        // route thêm sản phẩm
        Route::get('add/{product_id}', [
            'as' => 'cart.add',
            'uses' => 'CartController@add'
        ]);
        // route xóa sản phẩm
        Route::get('delete/{product_id}', [
            'as' => 'cart.delete',
            'uses' => 'CartController@delete'
        ]);
    });
    // bình luận về sản phẩm
    Route::group(['prefix' => 'comment'], function () {
        Route::post('add/{id}', [
            'as' => 'comment.add',
            'uses' => 'CommentController@addComment'
        ]);
    });
    Route::group(['prefix' => 'rate'], function () {
        Route::post('add/{id}', [
            'as' => 'rate.add',
            'uses' => 'RateController@addRate'
        ]);
    });
    // check đơn hàng
    Route::post('check-buy', [
        'as' => 'bill.check',
        'uses' => 'BillController@check'
    ]);
    // đặt hàng
    Route::post('buy', [
        'as' => 'bill.buy',
        'uses' => 'BillController@buy',
    ]);
    // chi tiết đơn hàng
    Route::get('order/{id}', [
        'as' => 'order',
        'uses' => 'BillController@billDetail'
    ]);
});
// route admin
Route::group(['prefix' => 'admin'], function () {
    // admin đăng nhập
    Route::get('login', [
        'as' => 'admin.login',
        'uses' => 'AdminController@login'
    ]);
    Route::post('login', [
        'as' => 'admin.do-login',
        'uses' => 'AdminController@doLogin'
    ]);
    // admin đăng xuất
    Route::get('logout', [
        'as' => 'admin.logout',
        'uses' => 'AdminController@logout'
    ]);
    // route quản lý của admin
    Route::group(['middleware' => 'auth:admin'], function () {
        // home
        Route::get('/', [
            'as' => 'admin.home',
            'uses' => 'AdminController@index'
        ]);
        // quản lý danh mục chung
        Route::group(['prefix' => 'category-global'], function () {
            Route::get('/', [
                'as' => 'admin.category-global.list',
                'uses' => 'CategoryGlobalController@index'
            ]);
            Route::post('store', [
                'as' => 'admin.category-global.store',
                'uses' => 'CategoryGlobalController@store'
            ]);
            Route::get('edit/{id}', [
                'as' => 'admin.category-global.edit',
                'uses' => 'CategoryGlobalController@edit'
            ]);
            Route::post('update/{id}', [
                'as' => 'admin.category-global.update',
                'uses' => 'CategoryGlobalController@update'
            ]);
            Route::get('delete/{id}', [
                'as' => 'admin.category-global.delete',
                'uses' => 'CategoryGlobalController@delete'
            ]);
        });
        // quản lý user
        Route::group(['prefix' => 'admin', ], function () {
            Route::get('/', [
                'as' => 'admin.list',
                'uses' => 'AdminController@listUser',
                'middleware' => 'checkacl:admin-list'
            ]);
            Route::get('add', [
                'as' => 'admin.add',
                'uses' => 'AdminController@addUser',
                'middleware' => 'checkacl:admin-add'
            ]);
            // store
            Route::post('store', [
                'as' => 'admin.store',
                'uses' => 'AdminController@storeUser',
                'middleware' => 'checkacl:admin-add'
            ]);
            // route edit
            Route::get('edit/{id}', [
                'as' => 'admin.edit',
                'uses' => 'AdminController@edit',
                'middleware' => 'checkacl:admin-edit'
            ]);
            // route update
            Route::post('update/{id}', [
                'as' => 'admin.update',
                'uses' => 'AdminController@update',
                'middleware' => 'checkacl:admin-edit'
            ]);
            // route delete
            Route::get('delete/{id}', [
                'as' => 'admin.delete',
                'uses' => 'AdminController@delete',
                'middleware' => 'checkacl:admin-delete'
            ]);
        });
        // quản lý role
        Route::group(['prefix' => 'role'], function () {
            Route::get('/', [
                'as' => 'role.list',
                'uses' => 'RoleController@index',
                'middleware' => 'checkacl:role-list'
            ]);
            Route::post('store', [
                'as' => 'role.store',
                'uses' => 'RoleController@store',
                'middleware' => 'checkacl:role-add'
            ]);
            Route::get('edit/{id}', [
                'as' => 'role.edit',
                'uses' => 'RoleController@edit',
                'middleware' => 'checkacl:role-edit'
            ]);
            Route::post('update/{id}', [
                'as' => 'role.update',
                'uses' => 'RoleController@update',
                'middleware' => 'checkacl:role-edit'
            ]);
            Route::get('delete/{id}', [
                'as' => 'role.delete',
                'uses' => 'RoleController@delete',
                'middleware' => 'checkacl:role-delete'
            ]);
        });
        // quản lý người dùng
        Route::group(['prefix' => 'user'], function () {
            // danh sách người dùng
            Route::get('list', [
                'as' => 'admin.user.list',
                'uses' => 'UserController@adminUserList'
            ]);
            // sửa thông tin người dùng
            Route::get('edit/{id}', [
                'as' => 'admin.user.edit',
                'uses' => 'UserController@adminUserEdit'
            ]);
            // cập nhật thông tin người dùng
            Route::post('update/{id}', [
                'as' => 'admin.user.update',
                'uses' => 'UserController@adminUserUpdate'
            ]);
            // xóa người dùng
            Route::get('delete/{id}', [
                'as' => 'admin.user.delete',
                'uses' => 'UserController@adminUserDelete'
            ]);
        });
        // quản lý danh mục
        Route::group(['prefix' => 'category'], function () {
            // danh sách danh mục
            Route::get('list', [
                'as' => 'admin.category.list',
                'uses' => 'CategoryController@adminCategoryList'
            ]);
            // sửa thông tin danh mục
            Route::get('edit/{id}', [
                'as' => 'admin.category.edit',
                'uses' => 'CategoryController@adminCategoryEdit'
            ]);
            // lưu thông tin danh mục
            Route::post('update/{id}', [
                'as' => 'admin.category.update',
                'uses' => 'CategoryController@adminCategoryUpdate'
            ]);
            // xóa danh mục
            Route::get('delete/{id}', [
                'as' => 'admin.category.delete',
                'uses' => 'CategoryController@adminCategoryDelete'
            ]);
        });
        // quản lý sản phẩm
        Route::group(['prefix' => 'product'], function () {
            // danh sách sản phẩm
            Route::get('list', [
                'as' => 'admin.product.list',
                'uses' => 'ProductController@adminProductList'
            ]);
            // xóa sản phẩm
            Route::get('delete/{id}', [
                'as' => 'admin.product.delete',
                'uses' => 'ProductController@adminProductDelete'
            ]);
        });
        // quản lý của hàng
        Route::group(['prefix' => 'shop'], function () {
            // danh sách của hàng
            Route::get('list', [
                'as' => 'admin.shop.list',
                'uses' => 'ShopController@adminShopList'
            ]);
            Route::get('delete/{id}', [
                'as' => 'admin.shop.delete',
                'uses' => 'ShopController@adminShopDelete'
            ]);
        });
        // quản lý phương thức vận chuyển
        Route::group(['prefix' => 'transport'], function () {
            // hiển thị phương thức vận chuyển
            Route::get('/', [
                'as' => 'admin.transport.show',
                'uses' => 'TransportController@show'
            ]);
            // thêm phương thức vận chuyển
            Route::post('store', [
                'as' => 'admin.transport.store',
                'uses' => 'TransportController@store'
            ]);
            // hiển thị form sửa phương thức vận chuyển
            Route::get('edit/{id}', [
                'as' => 'admin.transport.edit',
                'uses' => 'TransportController@edit'
            ]);
            // cập nhật phương thức vận chuyển
            Route::post('update/{id}', [
                'as' => 'admin.transport.update',
                'uses' => 'TransportController@update'
            ]);
            // xóa phương thức vận chuyển
            Route::get('delete/{id}', [
                'as' => 'admin.transport.delete',
                'uses' => 'TransportController@delete'
            ]);
        });
        // quản phương thức thanh toán
        Route::group(['prefix' => 'pay'], function () {
            // hiển thị phương thức vận chuyển
            Route::get('/', [
                'as' => 'admin.pay.show',
                'uses' => 'PayController@show'
            ]);
            // thêm phương thức vận chuyển
            Route::post('store', [
                'as' => 'admin.pay.store',
                'uses' => 'PayController@store'
            ]);
            // hiển thị form sửa phương thức vận chuyển
            Route::get('edit/{id}', [
                'as' => 'admin.pay.edit',
                'uses' => 'PayController@edit'
            ]);
            // cập nhật phương thức vận chuyển
            Route::post('update/{id}', [
                'as' => 'admin.pay.update',
                'uses' => 'PayController@update'
            ]);
            // xóa phương thức vận chuyển
            Route::get('delete/{id}', [
                'as' => 'admin.pay.delete',
                'uses' => 'PayController@delete'
            ]);
        });
    });

});


Route::get('test', function () {
    return view('bill.success');
});