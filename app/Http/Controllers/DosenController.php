<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dosen;

class DosenController extends Controller
{
     public function index()
    {
        $data = Dosen::all();
        return view('dosen.index', compact('data'));
    }

    public function store(Request $request)
    {
        Dosen::create($request->only('nid', 'nama','alamat'));
        return redirect()->back();
    }

    // Edit
    public function edit($id)
    {
        $dosen = Dosen::findOrFail($id);
        return view('dosen.edit', compact('dosen'));
    }

    //  Update
    public function update(Request $request, $id)
    {
        $request->validate([
            'nid'  => 'required',
            'nama' => 'required',
            'alamat'  => 'required',
            
        ]);

        $dosen = Dosen::findOrFail($id);
        $dosen->update($request->only('nid', 'nama', 'alamat'));

        return redirect()->route('dosen.index')->with('success', 'Data berhasil diupdate!');
    }

    //  Delete
    public function destroy($id)
    {
        $dosen = Dosen::findOrFail($id);
        $dosen->delete();

        return redirect()->route('dosen.index')->with('success', 'Data berhasil dihapus!');
    }
}
