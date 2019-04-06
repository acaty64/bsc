<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        $users = User::get();
        return response()->json($users, 200);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'lastname1' => $request->lastname1,
            'lastname2' => $request->lastname2,
            'nickname' => $request->nickname,
            'email' => $request->email,
            'password' => bcrypt($request->password),            
        ]);
        return ['success' => true, 'user_id' => $user->id];
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->name = $request->name;
        $user->lastname1 = $request->lastname1;
        $user->lastname2 = $request->lastname2;
        $user->nickname = $request->nickname;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);            

        $user->save();

        return ['success' => true];
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return ['success' => true];
    }
}
