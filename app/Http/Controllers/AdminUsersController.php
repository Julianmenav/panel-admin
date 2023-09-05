<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class AdminUsersController extends Controller
{
    /**
     * Show the users table of admin panel.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $usersPag = DB::table('users')->paginate(10);

        
        return view('adminUsers', ['usersPag' => $usersPag]);
    }


    public function edit(Request $request)
    {
        $user = User::find(intval($request->id));
        return json_encode($user);
    }

    public function update(Request $request)
    {
        $user = User::find(intval($request->id));

        // Admin user is not editable
        if($user->name == 'admin' && $user->email == 'admin@admin.com' && $user->role === 'admin') return;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->save();
    }

    public function delete(Request $request)
    {
        $user = User::find($request->id);

        // Admin user is not erasable
        if($user->role === 'admin') return;


        $user->delete();
    }
}
