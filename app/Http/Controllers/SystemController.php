<?php

namespace App\Http\Controllers;

use App\Models\System;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $system = System::all();
        return view('admin.pages.sistem', compact('system'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
       //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        System::create([
            'name' => $request->input('name'),
            'description' => $request->input('description')
        ]);

        return redirect()->route('admin.sistem')
            ->with('success_add', 'Sistem berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(System $System)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(System $System)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        System::where('id', $id)->update([
            'name' => $request->input('name'),
            'description' => $request->input('description')
        ]);

        return redirect()->route('admin.sistem')
            ->with('success_edit', 'Sistem berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $system = System::find($id);
        $system->delete();
        return redirect()->route('admin.sistem')
            ->with('success_delete', 'Sistem berhasil Dihapus');
    }
}
