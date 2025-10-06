<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Kelas;

class MahasiswaController extends Controller
{
    public function index()
    {
       // $data = Mahasiswa::all();
       // return view('mahasiswa.index', compact('data'));

       $data = Mahasiswa::with('kelas')->get();
       $kelas = Kelas::all();
       return view('mahasiswa.index', compact('data','kelas'));

    }

    public function store(Request $request)
    {
       $request->validate([
        'nama' => 'required|string|max:255',
        'nim' => 'required|string|max:50|unique:mahasiswa,nim',
        'jurusan' => 'required|string|max:255',
        'kelas_id' => 'required|exists:kelas,id',
       ]);

       Mahasiswa::create([
        'nama' => $request->nama,
        'nim' => $request->nim,
        'jurusan' => $request->jurusan,
        'kelas_id' => $request->kelas_id,
       ]);

       return redirect()->back()->with('success', 'Data berhasil ditambahkan!');

    }
    
    // Edit
    public function edit($id)
    {
        $mhs = Mahasiswa::findOrFail($id);
        return view('mahasiswa.edit', compact('mhs'));
    }

    //  Update
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'nim'  => 'required',
            'jurusan'  => 'required',
            
        ]);

        $mhs = Mahasiswa::findOrFail($id);
        $mhs->update($request->only('nama', 'nim', 'jurusan'));

        return redirect()->route('mahasiswa.index')->with('success', 'Data berhasil diupdate!');
    }

    //  Delete
    public function destroy($id)
    {
        $mhs = Mahasiswa::findOrFail($id);
        $mhs->delete();

        return redirect()->route('mahasiswa.index')->with('success', 'Data berhasil dihapus!');
    }

}


