<?php

namespace App\Http\Controllers;

use App\Category;
use App\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function adminShopList()
    {
        $shops = Shop::all();
        return view('admin2.shop.list', ['shops' => $shops]);
    }

    public function adminShopDelete($id)
    {
        $shop = Shop::find($id);
        // xóa các danh mục của shop
        // xóa các sản phẩm của shop
        $categories = $shop->categories;
        foreach($categories as $category)
        {
            $products = $category->products;
            foreach($products as $product)
            {
                $product->delete();
            }
            $category->delete;
        }
        $shop->delete();
        return redirect()->route('admin.shop.list');
    }
}
