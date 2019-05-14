<?php

namespace App\Http\Middleware;

use App\Permission;
use App\Admin;
use DB;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        // lấy tất cả các quyền khi user đăng nhập vào hệ thống
        // 1. lấy tất cả các role của user login vào hệ thống
        /*
        $listRoleOfUser = DB::table('users')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->where('users.id', '=', Auth::id())
            ->select('roles.*')
            ->get()->pluck('id')->toArray();
        */
//        $listRoleOfAdmin = Admin::find(Auth::guard('admin')->id())->roles()->select('roles.id')->pluck('id')->toArray();

        $listRoleOfAdmin = Admin::find(Auth::guard('admin')->id())->roles()->select('roles.id')->pluck('id')->toArray();

//        dd($listRoleOfAdmin);

        // 2. lấy tất cả các quyền khi user login vào hệ thống
        $listRole = DB::table('roles')
            ->join('permission_role', 'roles.id', '=', 'permission_role.role_id')
            ->join('permissions', 'permission_role.permission_id', '=', 'permissions.id')
            ->whereIn('roles.id', $listRoleOfAdmin)
            ->select('permissions.*')
            ->get()->pluck('id')->unique();


        // lấy ra mã màn hình tương ứng để check phần quyền
        $checkPermission = Permission::where('name', $role)->value('id');

        // kiểm tra user có được phép vào màn hình đó không
        if($listRole->contains($checkPermission)) {
            return $next($request);
        } else {
            return abort(401);
        }

        return $next($request);
    }
}
