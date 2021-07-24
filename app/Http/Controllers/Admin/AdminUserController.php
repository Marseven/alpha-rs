<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FileController;
use App\Models\SecurityRole;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    //
    public function profil(User $user){
        $user = User::find(Auth::user()->id);
        $user->load(['role']);
        return view('admin.users.profil', [
            'user' =>$user,
        ]);
    }

    public function list(){
        $users = User::all()->where('security_role_id', "<>" , 1);
        $users->load(['role']);
        $roles = SecurityRole::all();
        return view('admin.users.list', [
            'users' =>$users,
            'roles' => $roles,
        ]);
    }

    public function register(){
        Controller::he_can('Users', 'creat');
        $roles = SecurityRole::all();
        return view('admin.users.add',[
            'roles' => $roles,
        ]);
    }

    public function update(Request $request, User $user){
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if($request->file('picture')){
            $picture = FileController::picture($request->file('picture'));
            if($picture['state'] == false){
                return back()->withErrors($picture['message']);
            }

            $user->picture = $picture['url'];
        }

        $user->security_role_id = $request->security_role_id;

        $user->save();
        return redirect('/admin-profil');
    }

    public function updatePassword(Request $request, User $user){
        $user->status = $request->status;
        $user->save();
        return redirect('/admin-profil');
    }
}
