<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(){
        $user = User::all();
        return view('user',compact('user'));
    }

    public function edit($id){
        $user = User::find($id);
        return view('user_edit',compact('user'));
    }

    public function update(Request $request, $id){
        $user = User::find($id);
        $user->update([
            'name' => $request->input('name'),
            'is_admin' => $request->input('is_admin'),
        ]);
        return redirect()->route('user');
    }
    
    public function destroy($id){
        $user = User::find($id);
        $user->delete();
        return redirect()->route('user');
    }
}
