<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    protected $cart;
    protected $product;

    public function __construct(Cart $cart, Product $product)
    {
        $this->cart = $cart;
        $this->product = $product;
    }

    public function index()
    {
        $cart = $this->cart->where('user_id', Auth::id())->get();
        $products = [];
        foreach ($cart as $c)
        {
            $product = $this->product->find($c->product_id)->toArray();
            $quantity = $c->quantity;
            $product['quantity'] = $quantity;
            array_push($products, $product);
        }
        return view('cart.list', ['products' => $products]);
    }

    public function add($product_id)
    {
        $user_id = Auth::id();
        // kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
        // nếu có thì thêm số lượng
        // nếu chưa có thì thêm sản phẩm vào giỏ hàng
        // lấy ra giỏ hàng
        $cart = $this->cart->where('user_id', $user_id)->get()->pluck('product_id')->toArray();
        if(in_array($product_id, $cart))
        {
            // sản phẩm đã có --> thêm vào số lượng
            echo "có trong mảng";
            $cart = $this->cart->where('user_id', $user_id)->where('product_id', $product_id)->first();
            $quantity = $cart->quantity;
            $quantity++;
            $cart->update([
                'quantity' => $quantity
            ]);
        }
        else
        {
            // sản phẩm chưa có --> thêm vào giỏ hàng
            $this->cart->create([
                'product_id' => $product_id,
                'user_id' => $user_id,
                'quantity' => 1,
            ]);
        }
        return redirect()->back();
    }

    public function delete($product_id)
    {
        $user_id = Auth::id();
        $cart = $this->cart->where('user_id', $user_id)->where('product_id', $product_id)->first();
        $cart->delete();
        return redirect()->back();
    }
}
