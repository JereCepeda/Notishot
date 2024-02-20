<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function userList()
    {
        $users = User::all();
        return view('user.admin.list', ['users' => $users]);
    }

    public function updatePermissions(Request $request, User $user)
    {
        $user->syncPermissions($request->input('permissions', []));

        return redirect()->back()->with('success', 'Permisos actualizados correctamente');
    }

    public function blockUser(User $user)
    {
        $user->update(['blocked' => true]);

        return redirect()->back()->with('success', 'Usuario bloqueado correctamente');
    }
}
