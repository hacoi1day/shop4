<?php

namespace App\Http\Controllers;

use App\Transport;
use Illuminate\Http\Request;

class TransportController extends Controller
{
    protected $transport;

    public function __construct(Transport $transport)
    {
        $this->transport = $transport;
    }

    public function show()
    {
        $transports = $this->transport->all();
        return view('admin2.transport.list', compact('transports'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'transport_name' => 'required'
        ], [
            'transport_name.required' => 'Tên danh mục chưa được điền'
        ]);
        $this->transport->create([
            'transport_name' => $request->transport_name
        ]);
        return redirect()->back();
    }

    public function edit($id)
    {
        $transport = $this->transport->find($id);
        return view('admin2.transport.edit', compact('transport'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'transport_name' => 'required'
        ], [
            'transport_name.required' => 'Tên phương thức chưa được điền'
        ]);
        $transport = $this->transport->find($id);
        $transport->update([
            'transport_name' => $request->transport_name
        ]);
        return redirect()->route('admin.transport.show');
    }

    public function delete($id)
    {
        $transport = $this->transport->find($id);
        $transport->delete();

        return redirect()->back();
    }
}
