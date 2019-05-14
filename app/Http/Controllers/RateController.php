<?php

namespace App\Http\Controllers;

use App\Rate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RateController extends Controller
{
    public $rate;
    public function __construct(Rate $rate)
    {
        $this->rate = $rate;
    }

    public function addRate(Request $request, $id)
    {
        $params = $request->all();
        $product_id = $id;
        $user_id = Auth::id();
        $rate_star = $params['rate_star'];
        $rate_content = $params['rate_content'];

        $rateCreate = $this->rate->create([
            'product_id' => $product_id,
            'user_id' => $user_id,
            'rate_star' => $rate_star,
            'rate_content' => $rate_content,
        ]);
        return redirect()->back();
    }
}
