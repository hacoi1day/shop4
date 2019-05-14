<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    protected $user;
    protected $role;
    protected $admin;
    public function __construct(User $user, Role $role, Admin $admin)
    {
        $this->user = $user;
        $this->role = $role;
        $this->admin = $admin;
    }

    public function login()
    {
        return view('admin2.login');
    }

    public function doLogin(Request $request)
    {
        $params = $request->all();
//        dd($params);

        $username = $params['username'];
        $password = $params['password'];

        if(Auth::guard('admin')->attempt(['username' => $username, 'password' => $password]))
        {
            return redirect()->route('admin.home');
        }
        else
            echo 'fail';

    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('home');
    }

    public function index()
    {
        return view('admin2.index');
    }

    public function listUser()
    {
        $users = $this->admin->all();
        return view('admin2.admin.list', ['users' => $users]);
    }

    public function addUser()
    {
        $roles = $this->role->all();
        return view('admin2.admin.add', ['roles' => $roles]);
    }
    public function storeUser(Request $request)
    {
        $params = $request->all();
        $name = $params['name'];
        $username = $params['username'];
        $password = $params['password'];
        $roles = $params['roles'];

        // insert user table
        $adminCreate = $this->admin->create([
            'name' => $name,
            'username' => $username,
            'password' => bcrypt($password),
        ]);
        // insert role_user table
        $adminCreate->roles()->attach($roles);
        return redirect()->route('admin.list');
    }

    public function edit($id)
    {
        $roles = $this->role->all();
        $admin = $this->admin->findOrFail($id);
        $rolesOfUser = $admin->roles;
        return view('admin2.admin.edit', ['admin' => $admin, 'roles' => $roles, 'rolesOfUser' => $rolesOfUser]);
    }

    public function update(Request $request, $id)
    {
        $params = $request->all();
        // lấy dữ liệu từ request
        $name = $params['name'];
        $username = $params['username'];
        $password = $params['password'];
        $roles = $params['roles'];
        // lấy ra user cần update
        $userUpdate = $this->admin->find($id);
        // update dữ liệu trong bảng user
        $userUpdate->update([
            'name' => $name,
            'username' => $username,
            'password' => bcrypt($password),
        ]);
        // update dữ liệu trong bảng role_user
        $userUpdate->roles()->sync($roles);

        return redirect()->route('admin.list');
    }

    public function delete($id)
    {
        // lấy ra user cần xóa
        $userDelete = $this->admin->findOrFail($id);
        // xóa ở trong bảng user
        $userDelete->delete();
        // xóa ở trong bảng role_user
        $userDelete->roles()->detach();
        return redirect()->route('admin.list');
    }
}
