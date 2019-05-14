<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Permission;

class RoleController extends Controller
{
    protected $role;
    protected $permission;

    public function __construct(Role $role, Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
    }

    public function index()
    {
        $roles = $this->role->all();
        $permissions = $this->permission->all();
        return view('admin2.role.list', ['roles' => $roles, 'permissions' => $permissions]);
    }

    public function store(Request $request)
    {
        $params = $request->all();
        $name = $params['name'];
        $display_name = $params['display_name'];
        $permissions = $params['permissions'];
        // insert vào bảng role
        $roleCreate = $this->role->create([
            'name' => $name,
            'display_name' => $display_name
        ]);
        // insert vào bảng permission_role
        $roleCreate->permissions()->attach($permissions);
        if($roleCreate) {
            return redirect()->back();
        } else {
            return "Error";
        }
    }

    public function edit($id)
    {
        $permissions = $this->permission->all();
        $role = $this->role->findOrFail($id);
        return view('admin2.role.edit', ['role' => $role, 'permissions' => $permissions]);
    }

    public function update(Request $request, $id)
    {
        $params = $request->all();
        $name = $params['name'];
        $display_name = $params['display_name'];
        $permissions = $params['permissions'];

        // update dữ liệu trong bảng role
        $roleUpdate = $this->role->findOrFail($id);
        $roleUpdate->update([
            'name' => $name,
            'display_name' => $display_name,
        ]);
        // update dữ liệu trong bảng permission_role
        $roleUpdate->permissions()->sync($permissions);
        if($roleUpdate) {
            return redirect()->route('role.list');
        } else {
            return abort(404);
        }
    }

    public function delete($id)
    {
        $roleDelete = $this->role->findOrFail($id);
        // xóa bản ghi ở bảng roles
        $roleDelete->delete();
        // xóa bản ghi ở bảng permission_role
        $roleDelete->permissions()->detach();
        return redirect()->back();
    }


}
