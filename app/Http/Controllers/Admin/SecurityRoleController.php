<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SecurityObject;
use App\Models\SecurityPermission;
use App\Models\SecurityRole;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Opis\Closure\SecurityProvider;

class SecurityRoleController extends GenericController
{
    public function __construct()
    {
        $this->setModel(new SecurityRole());
    }

    public function index()
    {
        Controller::he_can('Users', 'look');
        $roles = SecurityRole::all();
        $roles->load(['permissions']);
        if ($roles[0]->permissions->count() == 0) {
            for ($i = 1; $i > 6; $i++) {
                $result = DB::table('security_role_permission')->insert([
                    'security_role_id' => 1,
                    'security_permission_id' => $i,
                    'look'  => "on",
                    'creat' => "on",
                    'updat' => "on",
                    'del'   => "on",
                ]);
            }
        }
        $permissions = SecurityPermission::all();
        $objects = SecurityObject::all();
        $rolepermissions = DB::table('security_role_permission')
            ->join('security_permissions', 'security_permissions.id', '=', 'security_role_permission.security_permission_id')
            ->select('security_role_permission.*', 'security_permissions.*')
            ->get();
        return view('admin.security-roles.index', [
            'roles' => $roles,
            'permissions' => $permissions,
            'objects' => $objects,
            'rolepermissions' => $rolepermissions,
        ]);
    }

    public function save(Request $request)
    {
        Controller::he_can('Users', 'creat');

        $role =  new SecurityRole();

        if ($request->get('_id') != 0) $role = SecurityRole::find($request->get('_id'));
        $role->name = $request->get('name');
        $role->security_object_id = $request->get('security_object_id');
        $role->user_id = Auth::user()->id;
        $role->save();

        return redirect()->back()->with('success', 'Operation performed successfully');
    }

    public function permission(Request $request)
    {

        Controller::he_can('Users', 'updat');

        $permissions = SecurityPermission::all();
        foreach ($permissions as $permission) {
            $permission = SecurityPermission::find($request->get($permission->name . '-permission'));
            dd($permission);
            DB::table('security_role_permission')->where([
                'security_role_id' => $request->get('role'),
                'security_permission_id' => $permission->id
            ])->delete();
            DB::table('security_role_permission')->insert([
                'security_role_id' => $request->get('role'),
                'security_permission_id' => $permission->id,
                'look' => $request->get($permission->name . '-view'),
                'creat' => $request->get($permission->name . '-create'),
                'updat' => $request->get($permission->name . '-edit'),
                'del' => $request->get($permission->name . '-delete'),
            ]);
        }

        return redirect()->back()->with('success', 'Operation performed successfully');
    }
}
