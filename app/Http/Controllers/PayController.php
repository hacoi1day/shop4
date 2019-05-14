<?php

namespace App\Http\Controllers;

use App\Pay;
use Illuminate\Http\Request;

class PayController extends Controller
{
    protected $pay;

    public function __construct(Pay $pay)
    {
        $this->pay = $pay;
    }

    public function show()
    {
        $pays = $this->pay->all();
        return view('admin2.pay.list', compact('pays'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'pay_name' => 'required'
        ], [
            'pay_name.required' => 'Tên danh mục chưa được điền'
        ]);
        $this->pay->create([
            'pay_name' => $request->pay_name
        ]);
        return redirect()->back();
    }

    public function edit($id)
    {
        $pay = $this->pay->find($id);
        return view('admin2.pay.edit', compact('pay'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'pay_name' => 'required'
        ], [
            'pay_name.required' => 'Tên phương thức chưa được điền'
        ]);
        $pay = $this->pay->find($id);
        $pay->update([
            'pay_name' => $request->pay_name
        ]);
        return redirect()->route('admin.pay.show');
    }

    public function delete($id)
    {
        $pay = $this->pay->find($id);
        $pay->delete();

        return redirect()->back();
    }
}
