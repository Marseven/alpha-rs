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
    public function profil(User $user)
    {
        $user = User::find(Auth::user()->id);
        $user->load(['role']);
        return view('admin.users.profil', [
            'user' => $user,
        ]);
    }

    public function list()
    {
        $users = User::all()->where('security_role_id', "<>", 1);
        $users->load(['role']);
        $roles = SecurityRole::all();
        return view('admin.users.list', [
            'users' => $users,
            'roles' => $roles,
        ]);
    }

    public function register()
    {
        Controller::he_can('Users', 'creat');
        $roles = SecurityRole::all();
        return view('admin.users.add', [
            'roles' => $roles,
        ]);
    }

    public function create(Request $request)
    {
        $user = new User();

        $user->name = $request->name;
        $email_exist = User::where('email', $request->email)->count();
        if ($email_exist > 0) {
            return back()->with('error', "Cette email existe déjà.")->withInput();
        } else {
            $user->email = $request->email;
        }
        if (Controller::formatPhone($request->phone) != false) {
            $user->phone = Controller::formatPhone($request->phone);
        } else {
            return back()->withErrors("Numéro de Téléphone incorrect");
        }
        $user->security_role_id = $request->security_role_id;

        $user->save();
        return redirect('/admin/list-users')->with('success', 'Utilisateur Créée');
    }

    public function update(Request $request, User $user)
    {

        if (isset($_POST['delete'])) {
            if ($user->delete()) {
                return  back()->with('success', "L'utilisateur a bien été supprimé !");
            } else {
                return back()->with('error', "Une erreur s'est produite.");
            }
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if ($request->file('picture')) {
            $picture = FileController::picture($request->file('picture'));
            if ($picture['state'] == false) {
                return back()->withErrors($picture['message']);
            }

            $user->picture = $picture['url'];
        }

        $user->security_role_id = $request->security_role_id;

        if ($user->save()) {
            return  back()->with('success', "L'utilisateur a bien été mis à jour !");
        } else {
            return back()->with('error', "Une erreur s'est produite.");
        }
    }

    public function updatePassword(Request $request, User $user)
    {
        $user->status = $request->status;
        $user->save();
        return redirect('/admin-profil');
    }
}
