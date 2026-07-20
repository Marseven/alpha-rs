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
        Controller::he_can('Users', 'look');
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
        // The form (register()) was gated but this write endpoint was not:
        // an operator without the Users permission could still POST here and
        // grant any security_role_id, including the admin role.
        Controller::he_can('Users', 'creat');

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'phone' => 'required|string|max:32',
            'security_role_id' => 'required|exists:security_roles,id',
        ]);

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
        if ($request->has('delete')) {
            Controller::he_can('Users', 'del');

            if ($user->delete()) {
                return  back()->with('success', "L'utilisateur a bien été supprimé !");
            } else {
                return back()->with('error', "Une erreur s'est produite.");
            }
        }

        // This endpoint assigns security_role_id: without a permission check any
        // back-office operator could promote themselves (or anyone) to admin.
        Controller::he_can('Users', 'updat');

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:32',
            'security_role_id' => 'required|exists:security_roles,id',
            'picture' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

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

}
