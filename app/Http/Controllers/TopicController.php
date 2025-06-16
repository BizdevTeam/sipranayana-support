<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $topic = Topic::all();
        return view('admin.pages.topik', compact('topic'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
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
        ]);

        Topic::create([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('admin.topic')
            ->with('success_add', 'Sistem berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
       //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Topic $topic)
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
        ]);

        Topic::where('id', $id)->update([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('admin.topic')
            ->with('success_edit', 'Sistem berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $topic = Topic::find($id);
        $topic->delete();
        return redirect()->route('admin.topic')
            ->with('success_delete', 'Sistem berhasil Dihapus');
    }
}
