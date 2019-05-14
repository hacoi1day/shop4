<?php

namespace App\Http\Controllers;

use App\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    protected $address;

    public function __construct(Address $address)
    {
        $this->address = $address;
    }

    public function doChangeAddress(Request $request)
    {
        $user_id = Auth::id();
        $params = $request->all();
        $name = $params['name'];
        $address = $params['address'];
        $number = $params['number'];

        $addressCreated = $this->address->where('user_id', $user_id)->first();
        if($addressCreated)
        {
            // đã có bản ghi
            $addressCreated->update([
                'name' => $name,
                'address' => $address,
                'number' => $number
            ]);
        }
        else
        {
            // chưa có bản ghi
            $addressCreate = $this->address->create([
                'name' => $name,
                'address' => $address,
                'number' => $number,
                'user_id' => $user_id
            ]);
        }
        return redirect()->route('info.basic');
    }
}
