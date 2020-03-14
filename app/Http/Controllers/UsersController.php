<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\UpdateUserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index(){
        return view('users.index')->with('users', User::all());
    }
    public function edit(){
        // dd("nati");
        return view('users.edit')->with('user', auth()->user());
    }
    public function makeAdmin(User $user){
        $user->role = 'admin';
        $user->save();
        session()->flash('success', 'User successfully become admin');
        return redirect()->back();
    }
    public function update(UpdateUserRequest $request){
        $user = auth()->user();
        $user->update([
            $user->name = $request->name,
            $user->email = $request->email,
            $user->about = $request->about,
            $user->password = Hash::make($request->password)
        ]);
            session()->flash('success', 'profile updated successfully.');
            return redirect()->back();

    }
}
