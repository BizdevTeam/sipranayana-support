<?php

namespace App\Http\Controllers;

use App\Models\AccountType;
use Illuminate\Http\Request;

class AccountTypeController extends Controller
{
    public function index(){
        $AccountType = AccountType::all();
        return view('admin.pages.accountType', compact('AccountType'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required'
        ]);

        AccountType::create([
            'name'=> $request->input('name')
        ]);

        return redirect()->route('admin.accountType')
        ->with('success_add', 'Jenis Akun Berhasil Ditambahkan');
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required'
        ]);

        AccountType::where('id', $id)->update([
            'name' => $request->input('name'),
        ]);
        return redirect()->route('admin.accountType')
        ->with('success_add', 'Jenis Akun Berhasil Diperbarui');
    }

    public function destroy($id){
        $accountType = AccountType::find($id);
        $accountType->delete();
        return redirect()->route('admin.accountType')
        ->with('success_add', 'Jenis Akun Berhasil Dihapus');
    }
}
