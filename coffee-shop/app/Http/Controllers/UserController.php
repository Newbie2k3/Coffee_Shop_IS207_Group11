<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function show(){
        $user = User::all();
        return view('admin.user.user',compact('user'));
    }

    public function create(){
        return view('admin.user.user_create');
    }

    public function store(Request $request)
    {
        $user_type = in_array($request->user_type, ['0', '1']) ? $request->user_type : '0';

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => $user_type,
        ]);

        return redirect()->route('user');
    }

    public function edit($id){
        $user = User::find($id);
        return view('admin.user.user_edit',compact('user'));
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
        $user = User::findOrFail($id);

        if (!$user) {
            return response()->json(['message' => 'Tài khoản không tồn tại.'], 404);
        }

        $user->delete();

        $remainingUsers = User::count();

        return response()->json(['message' => 'Tài khoản đã được xóa thành công.', 'remaining' => $remainingUsers], 200);
    }
}
