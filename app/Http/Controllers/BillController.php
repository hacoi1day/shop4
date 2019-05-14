<?php

namespace App\Http\Controllers;

use App\Address;
use App\Bill;
use App\BillDetail;
use App\Cart;
use App\Pay;
use App\Product;
use App\Transport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillController extends Controller
{
    protected $bill;
    protected $billDetail;
    protected $product;
    protected $cart;
    protected $pay;
    protected $transport;
    protected $address;

    public function __construct(Bill $bill, BillDetail $billDetail, Product $product, Cart $cart, Pay $pay, Transport $transport, Address $address)
    {
        $this->bill = $bill;
        $this->billDetail = $billDetail;
        $this->product = $product;
        $this->cart = $cart;
        $this->pay = $pay;
        $this->transport = $transport;
        $this->address = $address;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function check(Request $request)
    {
        $params = $request->all();
        $user_id = Auth::id();
        if($request->has('products'))
        {
            $productsID = $params['products'];
            // hiển thị thông tin đơn hàng
            $products = [];
            $totalPrice = 0;
            foreach ($productsID as $product_id)
            {
                $quantity = $this->cart->where('user_id', $user_id)->where('product_id', $product_id)->first()->quantity;
                $product = $this->product->find($product_id)->toArray();
                $product['quantity'] = $quantity;
                $totalPrice += $product['product_price'] * $quantity;
                array_push($products, $product);
            }
            // lấy ra địa chỉ người dùng
            $address = Auth::user()->address;
            $pays = $this->pay->all();
            $transports = $this->transport->all();
            return view('bill.check-buy', ['totalPrice' => $totalPrice, 'products' => $products, 'address' => $address, 'pays' => $pays, 'transports' => $transports]);
        }
        else
        {
            return redirect()->route('cart.list');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function buy(Request $request)
    {
        $params = $request->all();

        $user_id = Auth::id();
        $transport_id = $params['transport'];
        $pay_id = $params['pay'];
        $bill = $this->bill->create([
            'user_id' => $user_id,
            'transport_id' => $transport_id,
            'pay_id' => $pay_id
        ]);

        $productsID = $params['products'];
        foreach($productsID as $productID)
        {
            $cart = $this->cart->where('user_id', $user_id)->where('product_id', $productID)->first();
            $cart->delete();
            $quantity = $cart->quantity;
            $billDetail = $this->billDetail->create([
                'bill_id' => $bill->id,
                'product_id' => $productID,
                'quantity' => $quantity
            ]);
        }
        if($billDetail)
        {
            return view('bill.success', ['idBill' => $bill->id]);
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
    public function billDetail($id)
    {
        $address = $this->address->where('user_id', Auth::id())->first();
        $billDetail = $this->billDetail->where('bill_id', $id)->get();
        $total = 0;
        $products = [];
        foreach($billDetail as $billChil)
        {
            $product = $this->product->find($billChil->product_id);
            $total += $product->product_price * $billChil->quantity;
            $productR = [
                'id' => $product->di,
                'name' => $product->product_name,
                'price' => $product->product_price,
                'quantity' => $billChil->quantity,
            ];
            array_push($products, $productR);
        }
        $bill = $this->bill->find($id);
        $transport = $this->transport->find($bill->transport_id);
        $pay = $this->pay->find($bill->pay_id);
        return view('bill.bill-detail', ['address' => $address, 'products' => $products, 'total' => $total, 'transport' => $transport, 'pay' => $pay]);
    }
}
