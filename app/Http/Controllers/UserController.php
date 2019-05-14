<?php

namespace App\Http\Controllers;

use App\Address;
use App\Bill;
use App\BillDetail;
use App\Product;
use App\Shop;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $user;
    protected $shop;
    protected $address;
    protected $bill;
    protected $billDetail;
    protected $product;

    public function __construct(User $user, Shop $shop, Address $address, Bill $bill, BillDetail $billDetail, Product $product)
    {
        $this->user = $user;
        $this->shop = $shop;
        $this->address = $address;
        $this->bill = $bill;
        $this->billDetail = $billDetail;
        $this->product = $product;
    }
    // đăng nhập
    public function login()
    {
        return view('user.login');
    }
    // xử lý đăng nhập
    public function doLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Email chưa được nhập',
            'password.required' => 'Mật khẩu chưa được nhập'
        ]);
        $params = $request->all();
        $email = $params['email'];
        $password = $params['password'];

        if(Auth::attempt(['email' => $email, 'password' => $password]))
        {
            return redirect()->route('home');
        }
        else
        {
            echo 'đăng nhập thất bại';
        }
    }
    // đăng ký
    public function register()
    {
        return view('user.register');
    }
    // xử lý đăng ký
    public function doRegister(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email|unique:users',
            'name' => 'required|min:4',
            'username' => 'required|min:4|unique:users',
            'number' => 'required|unique:users|min:9',
            'password' => 'required|min:6',
            'passwordC' => 'same:password'
        ]);
        $params = $request->all();
        $email = $params['email'];
        $name = $params['name'];
        $username = $params['username'];
        $number = $params['number'];
        $password = $params['password'];

        $user = $this->user->create([
            'email' => $email,
            'name' => $name,
            'username' => $username,
            'number' => $number,
            'password' => bcrypt($password),
            'avatar' => '',
            'birthday' => '2019-04-15',
        ]);
        $shop = $this->shop->create([
            'user_id' => $user->id,
            'shop_name' => $name,
            'shop_detail' => '',
            'shop_avatar' => '',
        ]);
        if($user && $shop)
        {
            return redirect()->route('login')->with('mess', 'Đăng ký thành công');
        }
        else
        {
            return abort(401);
        }
    }
    // đăng xuất
    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
    // hiển thị thông tin người dùng
    public function info()
    {
        $user = Auth::user();
        return view('user.info.basic', ['user' => $user]);
    }
    // cập nhật thông tin người dùng
    public function update(Request $request)
    {
        $params = $request->all();
        $this->validate($request, [
            'name' => 'required|min:4',
            'username' => 'required|min:4',
            'number' => 'required|min:9',
        ]);
        $params = $request->all();
        $name = $params['name'];
        $username = $params['username'];
        $number = $params['number'];
        $birthday = $params['birthday'];
        $user = $this->user->find(Auth::id());
        if($request->hasFile('avatar'))
        {
            $file = $request->file('avatar');
            $ext = $file->getClientOriginalExtension();
            if($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg')
            {
                exit();
            }
            $nameImage = $file->getClientOriginalName();
            $image = str_random(16) . '_' . $nameImage;
            while (file_exists('uploads/users/'.$nameImage))
            {
                $image = str_random(16) . '_' . $nameImage;
            }
            $file->move('uploads/users', $image);
//            if(!file_exists('upload/users/'.$username))
//                unlink('uploads/users/'.$user->avatar);
            $avatar = $image;

            $user->update([
                'name' => $name,
                'username' => $username,
                'number' => $number,
                'avatar' => $avatar,
                'birthday' => $birthday,
            ]);
        }
        else
        {
            $user->update([
                'name' => $name,
                'username' => $username,
                'number' => $number,
                'birthday' => $birthday,
            ]);
        }
        return redirect()->route('info.basic');
    }
    // thay đổi mật khẩu
    public function changePassword()
    {
        $user = Auth::user();
        return view('user.info.change-password', ['user' => $user]);
    }
    // cập nhật mật khẩu
    public function doChangePassword(Request $request)
    {
        $this->validate($request, [
            'old-password' => 'required' ,
            'new-password' => 'required|min:4',
            'new-password-c' => 'required|same:new-password'
        ]);
        $params = $request->all();
        $oldPassword = $params['old-password'];
        $newPassword = $params['new-password'];
        $newPasswordC = $params['new-password-c'];

        // kiểu tra mật khẩu
        if(Auth::attempt(['email' => Auth::user()->email, 'password' => $oldPassword]))
        {
            $user = $this->user->find(Auth::id());
            $user->update([
                'password' => bcrypt($newPassword),
            ]);
        }
        return redirect()->route('info.basic');
    }
    // hiển thị thông tin địa chỉ
    public function address()
    {
        $user = Auth::user();
        $address = $user->address;
        return view('user.info.address', ['user' => $user, 'address' => $address]);
    }
    // hiển thị thông tin đặt hàng
    public function order()
    {
        $user = Auth::user();
        $bills = $this->bill->where('user_id', $user->id)->get();
        $billsResult = [];
        foreach ($bills as $bill)
        {
            $billR = [];
            $billR['id'] = $bill->id;
            $billR['date'] = $bill->created_at;
            $billR['products'] = [];
            $billR['total'] = 0;
            foreach($bill->billDetail as $billDetail)
            {
                $product = $this->product->find($billDetail->product_id);
                $name = $product->product_name;
                $price = $product->product_price;
                $quantity = $billDetail->quantity;
                $billR['total'] += $price * $quantity;
                $productT = [
                    'name' => $name,
                    'price' => $price,
                    'quantity' => $quantity
                ];
                array_push($billR['products'], $productT);
            }
            array_push($billsResult, $billR);
        }
        return view('user.info.order', ['user' => $user, 'billsResult' => $billsResult]);
    }

    // -------------------------------------------------------------
    // hiển thị danh sách người dùng cho admin
    public function adminUserList()
    {
        $users = $this->user->all();
        return view('admin2.user.list', ['users' => $users]);
    }
    // hiển thị form để sửa thông tin người dùng
    public function adminUserEdit($id)
    {
        $user = $this->user->find($id);
        return view('admin2.user.edit', ['user' => $user]);
    }
    // cập nhật thông tin người dùng
    public function adminUserUpdate(Request $request, $id)
    {
        $user = $this->user->find($id);
        $update = $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'number' => $request->number
        ]);
        if($update)
            return redirect()->route('admin.user.list');
        else
            return abort(404);

    }
    // xóa thông tin người dùng
    public function adminUserDelete($id)
    {
        $user = $this->user->find($id);
        $del = $user->delete();
        if($del)
            return redirect()->route('admin.user.list');
        else
            return abort(404);
    }
}
