<?php

namespace App\Http\Controllers;

use App\Models\AccountType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        $accountType = AccountType::all();
        return view('admin.pages.users', compact('user','accountType'));
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',   
            'role' => 'required|in:user,admin',
            'status' => 'required'
        ]);

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'role' => $request->input('role'),
            'status' => $request->input('status'),
            'password' => Hash::make($request->input('password')),
        ]);
        return redirect()->route('admin.users')
            ->with('success_add', 'User berhasil Ditambahkan');
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role' => 'required|in:user,admin',
            'status' => 'required'
        ]);

        User::where('id', $id)->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'role' => $request->input('role'),
            'status' => $request->input('status'),
        ]);

        return redirect()->route('admin.users')
            ->with('success_edit', 'User berhasil Diubah');
    }
    public function destroy($id){
        $user = User::find($id);
        $user->delete();
        return redirect()->route('admin.users')
            ->with('success_delete', 'Sistem berhasil Dihapus');
    }
}
