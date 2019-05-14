<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Product;
use App\Rate;
use App\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    protected $shop;
    protected $category;
    protected $product;
    protected $comment;
    protected $rate;

    /**
     * ProductController constructor.
     * @param Shop $shop
     * @param Product $product
     * @param Category $category
     */
    public function __construct(Shop $shop, Product $product, Category $category, Comment $comment, Rate $rate)
    {
        $this->shop = $shop;
        $this->product = $product;
        $this->category = $category;
        $this->comment = $comment;
        $this->rate = $rate;
    }
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // validate
        $params = $request->all();
        $product_name = $params['product_name'];
        $product_price = $params['product_price'];
        $product_detail = $params['product_detail'];
        $categories = $params['categories'];

        if($request->hasFile('product_image'))
        {
            $file = $request->file('product_image');
            $ext = $file->getClientOriginalExtension();
            if($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg')
            {
                exit();
            }
            $nameImage = $file->getClientOriginalName();
            $image = str_random(16) . '_' . $nameImage;
            while (file_exists('data/images/'.$nameImage))
            {
                $image = str_random(16) . '_' . $nameImage;
            }
            $file->move('data/images', $image);
            $product_image = 'data/images/'.$image;

            $product = $this->product->create([
                'product_name' => $product_name,
                'product_price' => $product_price,
                'product_image' => $product_image,
                'product_detail' => $product_detail,
            ]);
            if(count($categories) > 0)
                $product->categories()->attach($categories);
        }
        else
        {
            $product = $this->product->create([
                'product_name' => $product_name,
                'product_price' => $product_price,
                'product_image' => '',
                'product_detail' => $product_detail,
            ]);
            if(count($categories) > 0)
                $product->categories()->attach($categories);
        }

        return redirect()->route('seller.product');
    }
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $shop = $this->shop->where('user_id', Auth::id())->first();
        $categories = $this->category->where('shop_id', $shop->id)->get();
        $product = $this->product->find($id);
        return view('product.edit', ['categories' => $categories, 'product' => $product]);
    }
    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // validate
        $params = $request->all();
        $product_name = $params['product_name'];
        $product_price = $params['product_price'];
        $product_detail = $params['product_detail'];
        $categories = $params['categories'];

        $product = $this->product->find($id);

        if($request->hasFile('product_image'))
        {
            $file = $request->file('product_image');
            $ext = $file->getClientOriginalExtension();
            if($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg')
            {
                exit();
            }
            $nameImage = $file->getClientOriginalName();
            $image = str_random(16) . '_' . $nameImage;
            while (file_exists('data/images/'.$nameImage))
            {
                $image = str_random(16) . '_' . $nameImage;
            }
            $file->move('data/images', $image);
            if(file_exists('data/images/'.$product->product_image))
                unlink('data/images/'.$product->product_image);
            $product_image = 'data/images/'.$image;

            $product->update([
                'product_name' => $product_name,
                'product_price' => $product_price,
                'product_image' => $product_image,
                'product_detail' => $product_detail,
            ]);
            if(count($categories) > 0)
                $product->categories()->sync($categories);
        }
        else
        {
            $product->update([
                'product_name' => $product_name,
                'product_price' => $product_price,
                'product_detail' => $product_detail,
            ]);
            if(count($categories) > 0)
                $product->categories()->sync($categories);
        }

        return redirect()->route('seller.product');
    }
    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $product = $this->product->find($id);
        $product->delete();
        $product->categories()->detach();
        if($product)
        {
            return redirect()->route('seller.product');
        }
        else
        {
            return abort(404);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getProductOfId($id)
    {
        $product = $this->product->find($id);
        $comments = $this->comment->where('product_id', $id)->get();
        $rates = $this->rate->where('product_id', $id)->get();
        return view('product.show', ['product' => $product, 'comments' => $comments, 'rates' => $rates]);
    }

    // --------------------------------------------------------------------------
    // lấy danh sách sản phẩm
    public function adminProductList()
    {
        $products = $this->product->paginate(20);
        return view('admin2.product.list', ['products' => $products]);
    }
    // xóa sản phẩm
    public function adminProductDelete($id)
    {
        $product = $this->product->find($id);
        $product->delete();
        $product->categories()->detach();
        if($product)
        {
            return redirect()->route('admin.product.list');
        }
        else
        {
            return abort(404);
        }
    }
    // tìm kiếm sản phẩm
    public function search(Request $request)
    {
        $key = $request->key;
        $products = $this->product->where('product_name', 'like', '%'.$key.'%')->paginate(20);
        return view('home.result', ['products' => $products]);
    }
}
