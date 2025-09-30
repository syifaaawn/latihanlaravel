<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruangan;

class RuanganController extends Controller
{
      public function index()
    {
        $data = Ruangan::all();
        return view('ruangan.index', compact('data'));
    }

    public function store(Request $request)
    {
        Ruangan::create($request->only('ruangan', 'kapasitas'));
        return redirect()->back();
    }

     // Edit
    public function edit($id)
    {
        $ruangan = Ruangan::findOrFail($id);
        return view('ruangan.edit', compact('ruangan'));
    }

    //  Update
    public function update(Request $request, $id)
    {
        $request->validate([
            'ruangan' => 'required',
            'kapasitas'  => 'required',
        ]);

        $mhs = Ruangan::findOrFail($id);
        $mhs->update($request->only('ruangan', 'kapasitas'));

        return redirect()->route('ruangan.index')->with('success', 'Data berhasil diupdate!');
    }

    //  Delete
    public function destroy($id)
    {
        $ruangan = Ruangan::findOrFail($id);
        $ruangan->delete();

        return redirect()->route('ruangan.index')->with('success', 'Data berhasil dihapus!');
    }

}
