<?php

namespace App\Http\Controllers;

use App\Address;
use App\Bill;
use App\BillDetail;
use App\Category;
use App\CategoryGlobal;
use App\Product;
use App\Shop;
use App\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SellerController extends Controller
{
    protected $user;
    protected $shop;
    protected $categoryGlobal;
    protected $category;
    protected $product;
    protected $bill;
    protected $billDetail;
    protected $address;

    public function __construct(User $user, Shop $shop, CategoryGlobal $categoryGlobal, Category $category, Product $product, Bill $bill, BillDetail $billDetail, Address $address)
    {
        $this->user = $user;
        $this->shop = $shop;
        $this->categoryGlobal = $categoryGlobal;
        $this->category = $category;
        $this->product = $product;
        $this->bill = $bill;
        $this->billDetail = $billDetail;
        $this->address = $address;
    }

    public function index()
    {
        $shop = $this->shop->where('user_id', Auth::id())->first();
        $categoryGloals = $this->categoryGlobal->all();
        $categories = $this->category->where('shop_id', $shop->id)->paginate(10);
        $products = $this->product->orderBy('id', 'desc')->paginate(15);

        return view('seller.index', ['shop' => $shop, 'categoryGloals' => $categoryGloals, 'categories' => $categories, 'products' => $products]);
    }

    public function order()
    {
        $shop = $this->shop->where('user_id', Auth::id())->first();
        $bills = DB::table('bills')
            ->join('users', 'bills.user_id', '=', 'users.id')
            ->join('bill_details', 'bills.id', '=' ,'bill_details.bill_id')
            ->join('products', 'bill_details.product_id', '=', 'products.id')
            ->join('category_product', 'products.id', '=', 'category_product.product_id')
            ->join('categories', 'category_product.category_id', '=', 'categories.id')
            ->where('shop_id', $shop->id)
            ->select('users.name', 'bills.created_at', 'bills.id')
            ->get()->toArray();

        $billsR = [];
        foreach($bills as $bill)
        {
            $billR = [];
            $billR['id'] = $bill->id;
            $billR['name'] = $bill->name;
            $billR['date'] = $bill->created_at;
            $billR['products'] = [];
            $billR['total'] = 0;
            $bill_detail = $this->billDetail->where('bill_id', $bill->id)->get()->toArray();
            foreach($bill_detail as $product)
            {
                $products = DB::table('products')
                    ->join('category_product', 'products.id', '=', 'category_product.product_id')
                    ->join('categories', 'categories.id', '=', 'category_product.category_id')
                    ->where('categories.shop_id', '=', $shop->id)
                    ->where('products.id', '=', $product['product_id'])
                    ->select('products.product_name', 'products.product_price')
                    ->first();

                $product = [
                    'name' => $products->product_name,
                    'price' => $products->product_price,
                    'quantity' => $product['quantity']
                ];
                $billR['total'] += $product['price'] * $product['quantity'];
                array_push($billR['products'], $product);
            }
            array_push($billsR, $billR);
        }
        return view('seller.order', ['bills' => $billsR]);
    }

    public function orderDetail($id)
    {
        $shop = $this->shop->where('user_id', Auth::id())->first();
        $bill = $this->bill->find($id);
        $user = $this->user->find($bill['user_id']);
        $address = $this->address->where('user_id', $user->id)->first();
        $billR = [];
        $billR['id'] = $bill->id;
        $billR['name'] = $user->name;
        $billR['address'] = $address->address;
        $billR['date'] = $bill->created_at;
        $billR['products'] = [];
        $billR['total'] = 0;
        $bill_detail = $this->billDetail->where('bill_id', $bill->id)->get()->toArray();
        foreach($bill_detail as $product)
        {
            $products = DB::table('products')
                ->join('category_product', 'products.id', '=', 'category_product.product_id')
                ->join('categories', 'categories.id', '=', 'category_product.category_id')
                ->where('categories.shop_id', '=', $shop->id)
                ->where('products.id', '=', $product['product_id'])
                ->select('products.product_name', 'products.product_price')
                ->first();

            $product = [
                'name' => $products->product_name,
                'price' => $products->product_price,
                'quantity' => $product['quantity']
            ];
            $billR['total'] += $product['price'] * $product['quantity'];
            array_push($billR['products'], $product);
        }
        return view('seller.order-detail', ['bill' => $billR]);
    }

    public function category()
    {
        $shop = $this->shop->where('user_id', Auth::id())->first();
        $categories = $this->category->where('shop_id', $shop->id)->paginate(10);
        $categoryGloals = $this->categoryGlobal->all();
        return view('seller.category', ['shop' => $shop, 'categoryGloals' => $categoryGloals, 'categories' => $categories]);
    }

    public function product()
    {
        $shop = $this->shop->where('user_id', Auth::id())->first();
        $categories = $this->category->where('shop_id', $shop->id)->pluck('id')->toArray();
        $products = DB::table('categories')
            ->join('category_product', 'categories.id', '=', 'category_product.category_id')
            ->join('products', 'category_product.product_id', '=', 'products.id')
            ->whereIn('categories.id', $categories)
            ->paginate(15);
        return view('seller.product', compact('products'));
    }

    public function addProduct()
    {
        $shop = $this->shop->where('user_id', Auth::id())->first();
        $categories = $this->category->where('shop_id', $shop->id)->paginate(10);
        return view('seller.add-product', ['categories' => $categories]);
    }

    public function listProduct()
    {
        $shop = $this->shop->where('user_id', Auth::id())->first();
        $categoryGloals = $this->categoryGlobal->all();
        $products = $this->product->orderBy('id', 'desc')->paginate(15);
        return view('seller.list-product', ['shop' => $shop, 'categoryGloals' => $categoryGloals, 'products' => $products]);
    }

    public function changeInfo(Request $request, $id)
    {
        // validate
        $params = $request->all();
        $shop_name = $params['shop_name'];
        $shop_number = $params['shop_number'];
        $shop_detail = $params['shop_detail'];

        $shop = $this->shop->find($id)->first();

        if($request->hasFile('shop_avatar'))
        {
            $file = $request->file('shop_avatar');
            $ext = $file->getClientOriginalExtension();
            if($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg')
            {
                exit();
            }
            $nameImage = $file->getClientOriginalName();
            $image = str_random(16) . '_' . $nameImage;
            while (file_exists('uploads/shops/'.$nameImage))
            {
                $image = str_random(16) . '_' . $nameImage;
            }
            $file->move('uploads/shops', $image);
//            if(file_exists('uploads/shops/'.$shop->shop_avatar))
//                unlink('uploads/shops/'.$shop->shop_avatar);
            $shop_avatar = $image;

            // update có ảnh
            $shop->update([
                'shop_name' => $shop_name,
                'shop_detail' => $shop_detail,
                'shop_avatar' => $shop_avatar,
                'shop_number' => $shop_number
            ]);
        }
        else
        {
            // update không ảnh
            $shop->update([
                'shop_name' => $shop_name,
                'shop_detail' => $shop_detail,
                'shop_number' => $shop_number
            ]);
        }
        return redirect()->route('seller.index');
    }
}
